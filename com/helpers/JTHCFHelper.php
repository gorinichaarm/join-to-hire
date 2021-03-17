<?php

class JTHCFHelper
{
	public static function filterPostDataBeforeSaving($postData)
	{
		$filteredData = array();

		// we need to only get values from fields with names started from our prefix "jthcf"
		foreach ($postData as $key => $value) {
			if (strpos($key, 'jthcf') === 0) {
				$filteredData[$key] = $value;
			}
		}

		return $filteredData;
	}

	public static function getCurrentPostType()
	{
		global $post_type;
		global $post;
		$currentPostType = '';

		if (is_object($post)) {
			$currentPostType = $post->post_type;
		}

		// in some themes global $post returns null
		if (empty($currentPostType)) {
			$currentPostType = $post_type;
		}

		if (empty($currentPostType) && !empty($_GET['post'])) {
			$currentPostType = get_post_type($_GET['post']);
		}

		return $currentPostType;
	}

	public static function getFieldLabelByName($name = '')
	{
		$fieldLabels = array(
			'jthcf-name' => 'Name',
			'jthcf-gender' => 'Gender'
		);

		if (!isset($fieldLabels)) {
			return '';
		}

		return $fieldLabels[$name];
	}

	public static function getEmailHeader($fromEmail, $args = array())
	{
		$contentType = 'text/html';
		$charset = 'UTF-8';
		$blogInfo = get_bloginfo();

		if (!empty($args['contentType'])) {
			$contentType = $args['contentType'];
		}
		if (!empty($args['charset'])) {
			$charset = $args['charset'];
		}

		$headers  = 'MIME-Version: 1.0'."\r\n";
		$headers  .= 'From: "'.$blogInfo.'" <'.$fromEmail.'>'."\r\n";
		$headers .= 'Content-type: '.$contentType.'; charset='.$charset.''."\r\n"; //set UTF-8

		return $headers;
	}
}
