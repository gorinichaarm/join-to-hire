function JTHContactForm(){
	this.init();
};

JTHContactForm.prototype.init = function()
{
	this.submitContactForm();
};

JTHContactForm.prototype.submitContactForm = function()
{
	var that = this;
	jQuery('.jthcf-submit-js').bind('click', function() {
		var formId = jQuery(this).attr('data-id');
		var contactForm = jQuery('.jthcf-form-' + formId);
		var formData = contactForm.serialize();

		var ajaxData = {
			action: "jthcf_form_submission",
			nonce: JTHCF_AJAX_DATA.nonce,
			beforeSend: function () {
				jQuery(this).attr('disabled', 'disabled');
			},
			formData: formData,
			formId: formId
		};

		jQuery.post(JTHCF_AJAX_DATA.url, ajaxData, function (response) {
			if (response) {
				contactForm.html('<div class="alert alert-success" role="alert">Successfully submitted.</div>');
			}
			else {
				contactForm.prepend('<div class="alert alert-alert" role="alert">Something wrong, please, try again.</div>');	
			}
		});
	});
};

jQuery(document).ready(function(e) {
	setTimeout(function() {
		new JTHContactForm();
	}, 200);
});