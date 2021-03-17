<?php

class JTHContactForm
{
	public static function getOptionsById($formId)
	{
		return get_post_meta($formId, 'jthcf_options', true);
	}


	public static function renderContactForm($formId)
	{
		ob_start();
		?>
		<form class="jthcf-main-form jthcf-form-<?php echo $formId; ?>">
			<input type="hidden" id="jthcf-hidden-checker" name="jthcf-hidden-checker">
			<div class="form-group">
				<label for="jthcf-name"><?php _e('Name', JTHCF_TEXT_DOMAIN); ?></label>
				<input type="text" class="form-control" id="jthcf-name" placeholder="Enter your name" name="jthcf-name" required>
			</div>
			<div class="form-group">
				<label for="jthcf-gender"><?php _e('Gender', JTHCF_TEXT_DOMAIN); ?></label>
				<select id="jthcf-gender" name="jthcf-gender">
					<option><?php _e('Male', JTHCF_TEXT_DOMAIN); ?></option>
					<option><?php _e('Female', JTHCF_TEXT_DOMAIN); ?></option>
				</select>
				
			</div>
			<input type="button" class="btn btn-success jthcf-submit-js" data-id="<?php echo $formId; ?>" value="<?php _e('Submit', JTHCF_TEXT_DOMAIN); ?>">
		</form>

		<?php 
		$shortcodeContent = ob_get_contents();
		ob_get_clean();

		return $shortcodeContent;
	}
}
