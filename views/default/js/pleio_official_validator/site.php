<?php ?>
//<script>
elgg.provide("elgg.pleio_official_validator");

elgg.pleio_official_validator = function() {
	$('#pleio_official_validator_official_add_form input[name="email"]').focus(function(){
		if($(this).val() == elgg.echo("pleio_official_validator:official:forms:add:email")){
			$(this).val("");
		}
	}).blur(function(){
		if($(this).val() == ""){
			$(this).val(elgg.echo("pleio_official_validator:official:forms:add:email"));
		}
	});

	$('#pleio_official_validator_official_add_form').submit(function(){
		var result = false;
		var email = $(this).find('input[name="email"]').val();

		if(email != "" && email != null && pleio_official_validator_validate_email(email)){
			result = true;
		}
		
		return result;
	});

}

function pleio_official_validator_validate_email(email) {
	var reg = /^([A-Za-z0-9_\-\.])+@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
	return reg.test(email);
}

function pleio_official_validator_official_change(){
	$('#pleio_official_validator_official_pending_actions').hide();
	$('#pleio_official_validator_official_pending').show();
}

function pleio_official_validator_official_revalidate(){
	$('#pleio_official_validator_official_add_form').attr('action', '<?php echo elgg_get_site_url(); ?>action/official_validator/revalidate');
	$('#pleio_official_validator_official_add_form').submit();
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.pleio_official_validator.init);