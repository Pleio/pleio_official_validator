<?php 
	
	$user_guid = (int) get_input("user_guid", elgg_get_logged_in_user_guid());
	
	if($user = get_user($user_guid)){
		$user->removePrivateSetting("pleio_official_validator_email");
		$user->removePrivateSetting("pleio_official_validator_code");
		unset($user->validated_official);
		
		if($user->save()){
			// revert profile icon to original image
			pleio_official_validator_revert_profile_icon($user);
			
			system_message(elgg_echo("pleio_official_validator:action:remove_status:success"));
		} else {
			register_error(elgg_echo("pleio_official_validator:action:remove_status:error:save"));
		}
	} else {
		register_error(elgg_echo("pleio_official_validator:action:remove_status:error:user"));
	}

	forward(REFERER);