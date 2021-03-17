<?php

class Actions
{
	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		add_action('init', array($this, 'jthcfPostTypeRegister'));
		add_action('add_meta_boxes', array($this, 'contactFormOptions'));
		add_shortcode('jthcf_form', array($this, 'contactFormShortcodeInit'));
		add_action('save_post', array($this, 'saveForm'), 100, 3);
		add_action('manage_'.JTHCF_POST_TYPE.'_posts_custom_column' , array($this, 'formsTableColumns'), 10, 2);
		add_action('wp_enqueue_scripts', array($this, 'jthcfLoadFrontScriptsAndStyles'));
		add_action('admin_enqueue_scripts', array($this, 'jthcfLoadAdminScriptsAndStyles'), 10, 1);
		new Ajax();
	}

	public function jthcfPostTypeRegister()
	{
		register_post_type(JTHCF_POST_TYPE,
			array(
				'labels'      => array(
					'name'          => __('Contact Forms', JTHCF_TEXT_DOMAIN),
					'singular_name' => __('Form', JTHCF_TEXT_DOMAIN),
				),
					'public'      => true,
					'has_archive' => true,
					'menu_icon' => 'dashicons-email-alt',
					'supports'            => array('title')
			)
		);
	}

	public function contactFormOptions()
	{
		add_meta_box(
			'contactFormOptions',
			__('Options', JTHCF_TEXT_DOMAIN),
			array($this, 'contactFormOptionsView'),
			JTHCF_POST_TYPE,
			'normal',
			'high'
		);
	}

	public function contactFormOptionsView()
	{
		require_once(JTHCF_VIEWS_PATH.'options.php');
	}

	public function contactFormShortcodeInit($args, $content)
	{
		$contactFormId = (int)$args['id'];

		$shortcodeContent =  JTHContactForm::renderContactForm($contactFormId);

		return do_shortcode($shortcodeContent);
	}

	public function saveForm($formId = 0, $post = array(), $update = false)
	{
		if ($post->post_type == JTHCF_POST_TYPE) {
			$options = JTHCFHelper::filterPostDataBeforeSaving($_POST);
			update_post_meta($formId, 'jthcf_options', $options);
		}
	}

	public function formsTableColumns($column, $postId)
	{
		$postId = (int)$postId;// Convert to int for security reasons
		global $post_type;
		
		$form = JTHContactForm::getOptionsById($postId);

		if (empty($form) && $post_type == JTHCF_POST_TYPE) {
			return false;
		}

		if ($column == 'shortcode') {
			echo '<input type="text" onfocus="this.select();" readonly value="[jthcf_form id='.$postId.']" class="code">';
		}
	}

	public function jthcfLoadFrontScriptsAndStyles()
	{
		wp_enqueue_style('jthcf-main',  JTHCF_CSS_URL.'main.css');
		wp_enqueue_style('jthcf-main-bootstrap',  JTHCF_CSS_URL.'bootstrap.min.css');
		wp_enqueue_script( 'jthcf-contact-form', JTHCF_JS_URL.'JTHContactForm.js', array('jquery'));
		wp_enqueue_script( 'jthcf-contact-form-bootstrap', JTHCF_JS_URL.'bootstrap.min.js', array('jquery'));
		wp_localize_script('jthcf-contact-form', 'JTHCF_AJAX_DATA', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
	}

	public function jthcfLoadAdminScriptsAndStyles($hook)
	{
		$postType = JTHCFHelper::getCurrentPostType();

		if ('post.php' != $hook && $postType != JTHCF_POST_TYPE) {
			return;
		}

		wp_enqueue_style('jthcf-main-bootstrap',  JTHCF_CSS_URL.'bootstrap.min.css');
	}
}
