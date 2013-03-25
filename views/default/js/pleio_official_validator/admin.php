<?php ?>
//<script>
elgg.pleio_official_validator_admin.init = function() {
	$('#pleio_official_validator_whitelist_add_form input[name="domain"]').focus(function(){
		if($(this).val() == elgg.echo("pleio_official_validator:whitelist:forms:add:domain")){
			$(this).val("");
		}
	}).blur(function(){
		if($(this).val() == ""){
			$(this).val(elgg.echo("pleio_official_validator:whitelist:forms:add:domain"));
		}
	});

	$('#pleio_official_validator_whitelist_domains_form').submit(function(){
		var action = $(this).attr("action");
		var values = $(this).serialize();

		$.post(action, values, function(data){
			// no actions as of yet
		});
		
		return false;
	});

	$('#pleio_official_validator_whitelist_domain_wrapper .pleio_official_validator_whitelist_domain').live("click", function(){
		if(confirm(elgg.echo("deleteconfirm"))){
			$(this).remove();
			$('#pleio_official_validator_whitelist_domains_form').submit();
		}
	});
}

function pleio_official_validator_add_domain(){
	var $domain = $('#pleio_official_validator_whitelist_add_form input[name="domain"]');

	if(pleio_official_validator_validate_domain($domain.val())){
		var add_html = "<div class='pleio_official_validator_whitelist_domain'>";
		add_html += "<input type='hidden' name='domains[]' value='" + $domain.val() + "' />";
		add_html += $domain.val();
		add_html += "</div>";

		$('#pleio_official_validator_whitelist_domain_wrapper .pleio_official_validator_whitelist_no_domains').remove();
		$('#pleio_official_validator_whitelist_domain_wrapper').append(add_html);

		$('#pleio_official_validator_whitelist_domains_form').submit();
	}

	$domain.val("");
}

function pleio_official_validator_validate_domain(domain) {
	var result = false;
	var reg = /^([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

	if(reg.test(domain)) {
		result = true;
	}

	return result;
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.pleio_official_validator_admin.init);