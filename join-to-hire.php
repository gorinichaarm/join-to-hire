<?php
/**
* Plugin Name: JointoHire Contact form
* Plugin URI: https://jointohire.com
* Description: This is contact form plugin created for JointoHire team.
* Version: 1.0
* Author: Gor Knyazyan
* Author URI: https://jointohire.com
* License: GPLv2
* Text Domain:  join-to-hire
*/

if (!defined('WPINC')) {
	die;
}

if (!defined('JTHCF_FILE_NAME')) {
	define('JTHCF_FILE_NAME', plugin_basename(__FILE__));
}

if (!defined('JTHCF_FOLDER_NAME')) {
	define('JTHCF_FOLDER_NAME', plugin_basename(dirname(__FILE__)));
}

require_once(dirname(__FILE__).'/com/config.php');
require_once(plugin_dir_path(__FILE__).'JTHCFInitialize.php');
