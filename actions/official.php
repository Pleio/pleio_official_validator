<?php 

	$email = get_input("email");

	if(!empty($email)){
		if(pleio_official_validator_check_email_domain($email)){
			if($code = pleio_official_validator_create_code($email)){
				if(pleio_official_validator_send_validation_mail($email, $code)){
					system_message(elgg_echo("pleio_official_validator:action:official:success"));
				} else {
					register_error(elgg_echo("pleio_official_validator:action:official:error:save"));
				}
			} else {
				register_error(elgg_echo("pleio_official_validator:action:official:error:code"));
			}
		} else {
			register_error(elgg_echo("pleio_official_validator:action:official:error:domain"));
		}
	} else {
		register_error(elgg_echo("pleio_official_validator:action:official:error:input"));
	}
	
	forward($_SERVER["HTTP_REFERER"]);