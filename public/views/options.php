<?php
	$formId = get_the_ID();
	$options = JTHContactForm::getOptionsById($formId);
?>
<div class="wrap">
	<div class="row">
		<div class="col-md-3">
			<p>
				<?php _e('Notify to', JTHCF_TEXT_DOMAIN); ?>:
			</p>
		</div>
		<div class="col-md-5">
			<input class="form-control" type="email" name="jthcf-notify-to-email" value="<?php echo (isset($options['jthcf-notify-to-email'])) ? $options['jthcf-notify-to-email'] : get_option('admin_email'); ?>">
		</div>
	</div>
</div>
