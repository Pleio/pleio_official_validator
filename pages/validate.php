<?php 

	gatekeeper();

	$user_guid = (int) get_input("user_guid");
	$code = get_input("code");
	
	if(!empty($user_guid) && !empty($code)){
		if($user = get_user($user_guid)){
			$user_code = $user->getPrivateSetting("pleio_official_validator_code");
			
			if(!empty($user_code) && ($user_code == $code)){
				$user->removePrivateSetting("pleio_official_validator_code");
				$user->validated_official = true;
				
				if($user->save()){
					// make new profile icon
					pleio_official_validator_update_profile_icon($user);
				
					system_message(elgg_echo("pleio_official_validator:procedures:validate:success"));
				} else {
					register_error(elgg_echo("pleio_official_validator:procedures:validate:error:save"));
				}
			} else {
				register_error(elgg_echo("pleio_official_validator:procedures:validate:error:code"));
			}
		} else {
			register_error(elgg_echo("pleio_official_validator:procedures:validate:error:user"));
		}
	} else {
		register_error(elgg_echo("pleio_official_validator:procedures:validate:error:input"));
	}

	forward();
