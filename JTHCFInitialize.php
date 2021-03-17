<?php

class JTHCFInitialize
{
	private static $instance = null;
	private $actions;
	private $filters;

	private function __construct()
	{
		$this->init();
	}

	private function __clone()
	{

	}

	public static function getInstance()
	{
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function init()
	{
		$this->includeData();
		$this->actions();
		$this->filters();
	}

	private function includeData()
	{
		require_once(JTHCF_HELPERS_PATH.'JTHCFHelper.php');
		require_once(JTHCF_CLASSES_PATH.'JTHContactForm.php');
		require_once(JTHCF_CLASSES_PATH.'Filters.php');
		require_once(JTHCF_CLASSES_PATH.'Actions.php');
		require_once(JTHCF_CLASSES_PATH.'Ajax.php');
	}

	public function actions()
	{
		$this->actions = new Actions();
	}

	public function filters()
	{
		$this->filters = new Filters();
	}
}

JTHCFInitialize::getInstance();
