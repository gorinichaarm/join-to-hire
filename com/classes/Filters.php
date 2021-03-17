<?php

class Filters
{
	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		add_filter('manage_'.JTHCF_POST_TYPE.'_posts_columns', array($this, 'formsTableColumns'));
	}

	public function formsTableColumns($columns)
	{
		$columns['shortcode'] = __('Shortcode', JTHCF_TEXT_DOMAIN);

		return $columns;
	}
}
