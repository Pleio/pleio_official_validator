<?php

/**
 * Update profile icon (if needed) after login
 *
 * @param unknown_type $event
 * @param unknown_type $object_type
 * @param unknown_type $object
 * @return boolean
 */
function pleio_official_validator_login_handler($event, $object_type, $object) {
		
	if (!empty($object) && ($object instanceof ElggUser)) {
		
		$email = $object->getPrivateSetting("pleio_official_validator_email");
		$code = $object->getPrivateSetting("pleio_official_validator_code");
		
		if (!empty($object->validated_official)) {
			// validated, check if still valid
			
			if (!pleio_official_validator_check_email_domain($email)) {
				// domain is no longer valid
				$object->removePrivateSetting("pleio_official_validator_email");
				$object->removePrivateSetting("pleio_official_validator_code");
				unset($object->validated_official);
				
				// revert profile icon to original image
				pleio_official_validator_revert_profile_icon($object);
				
				$object->save();
			}
		} else {
			// not validated, check if can be validated
			if (empty($code)) {
				// not in the process of being validated
				$email = $object->email;
				
				if (pleio_official_validator_check_email_domain($email)) {
					$object->setPrivateSetting("pleio_official_validator_email", $email);
					$object->validated_official = true;
					
					// make new profile icon
					pleio_official_validator_update_profile_icon($object);
					
					$object->save();
				}
			}
		}
	}
	
	return true;
}

/**
 * Trigger profile icon update if user uploads a new icon
 *
 * @param unknown_type $event
 * @param unknown_type $object_type
 * @param unknown_type $object
 */
function pleio_official_validator_profile_icon_upload_handler($event, $object_type, $object) {
	
	if (!empty($object) && ($object instanceof ElggUser)) {
		if (!empty($object->validated_official)) {
			// make new profile icon
			pleio_official_validator_update_profile_icon($object);
		}
	}
	
	return true;
}
