<?php

class Ajax
{
	public function __construct()
	{
		$this->actions();
	}

	public function actions()
	{

        add_action('wp_ajax_jthcf_form_submission', array($this, 'formSubmission'));
		add_action('wp_ajax_nopriv_jthcf_form_submission', array($this, 'formSubmission'));
	}

	public function formSubmission()
	{
		check_ajax_referer('ajax-nonce', 'nonce');
		parse_str($_POST['formData'], $formData);
		$formId = (int)$_POST['formId'];
		$contactFormOptions = JTHContactForm::getOptionsById($formId);
		$email = $contactFormOptions['jthcf-notify-to-email'];

		$hiddenChecker = sanitize_text_field($formData['jthcf-hidden-checker']);
		if (!empty($hiddenChecker)) {
			wp_die('Bot');
		}

		$to = $email;
		$subject = 'New user submitted the form';
		$body = 'User details below:';
		foreach ($formData as $name) {
			$label = JTHCFHelper::getFieldLabelByName($name);
			$fieldValue = $formData[$name];
			$body .= $label.': '.$fieldValue."\r\n";
		}

		$headers = JTHCFHelper::getEmailHeader($email);

		wp_mail($to, $subject, $body, $headers);
		wp_die(1);
	}
}
