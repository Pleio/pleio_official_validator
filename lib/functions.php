<?php

/**
 * Checks if emailaddress matches a domain on the whitelist
 *
 * @param string $email
 * @return boolean
 */
function pleio_official_validator_check_email_domain($email) {
	$result = false;
	
	if (!empty($email) && validate_email_address($email)) {
		list(, $u_domain) = explode("@", $email);
		$domains = elgg_get_plugin_setting("whitelist_domains", "pleio_official_validator");
		
		if ($domains) {
			$domains = explode(",", $domains);
			
			if (!is_array($domains)) {
				$domains = array($domains);
			}
			
			if (in_array($u_domain, $domains)) {
				$result = true;
			} else {
				foreach ($domains as $domain) {
					$domain = trim($domain);
					
					if (substr($domain, 0, 1) == ".") {
						$len = strlen($domain);
						
						if (substr($u_domain, -$len) == $domain) {
							$result = true;
							break;
						}
					}
				}
			}
		}
	}
	
	return $result;
}

/**
 * Generates a code to use in validation mails
 *
 * @param string $email
 * @param int $user_guid (optional) defaults to logged in user
 */
function pleio_official_validator_create_code($email, $user_guid = 0) {
	$result = false;
	
	if (empty($user_guid)) {
		$user_guid = elgg_get_logged_in_user_guid();
	}
	
	if (!empty($email) && !empty($user_guid)) {
		$result = md5($user_guid . $email . get_site_secret());
	}
	
	return $result;
}

/**
 * Generates new icons
 *
 * @param unknown_type $user
 * @param unknown_type $skip_sizes
 */
function pleio_official_validator_update_profile_icon($user, $skip_sizes = array()) {
	
	if (!empty($user->icontime)) {
		
		if (!is_array($skip_sizes)) {
			$skip_sizes = array($skip_sizes);
		}
		
		// resize existing avatars or create new avatars if none are existing
		$white_space = 2;
		$sizes = array("large" => 3, "medium" => 3, "small" => 2, "tiny" => 1);
		
		foreach ($sizes as $size => $border_width) {
			
			if (!in_array($size, $skip_sizes)) {
				
				// load original
				$filehandler = new ElggFile();
				$filehandler->owner_guid = $user->getGUID();
				$filehandler->setFilename("profile/" . $user->getGUID() . $size . ".jpg");
				
				if ($filehandler->exists()) {
					// create backup
					$backupfile = new ElggFile();
					$backupfile->owner_guid = $user->getGUID();
					$backupfile->setFilename("profile/backup_" . $user->getGUID() . $size . ".jpg");
					
					$backupfile->open("write");
					$backupfile->write($filehandler->grabFile());
					$backupfile->close();
					
					// create new icon
					$original_image = ImageCreateFromJpeg($filehandler->getFilenameOnFilestore());
					$original_width = ImageSx($original_image);
					$original_height = ImageSy($original_image);
					
					// create new image
					$new_image = imagecreatetruecolor($original_width, $original_height);
					
					// sets bordercolor to blue (RGB)
					$border_color = imagecolorallocate($new_image, 1, 151, 212);
					imagefilledrectangle($new_image, 0, 0, $original_width, $original_height, $border_color);
					
					// white
					$white = imagecolorallocate($new_image, 255, 255, 255);
					imagefilledrectangle($new_image, $border_width, $border_width, $original_width - $border_width - 1, $original_height - $border_width - 1, $white);
					
					// fill with resized original
					$border_thickness = $border_width + $white_space;
					imagecopyresized($new_image, $original_image, $border_thickness, $border_thickness, 0, 0, $original_width - (2 * $border_thickness), $original_height - (2 * $border_thickness), $original_width, $original_height);
					
					// optionally add stamp
					$selected_stamp = false;
					$prefix = elgg_get_plugins_path() . "pleio_official_validator/_graphics/official_stamp_";
					$stamps = array(10 => $prefix . "10.png", 20 => $prefix . "20.png", 30 => $prefix . "30.png");
					
					foreach ($stamps as $stamp_size => $file) {
						$min_size = 3 * $stamp_size;
						
						if (($min_size < $original_width - (2 * $border_thickness)) && ($min_size < $original_height - (2 * $border_thickness))) {
							$selected_stamp = $file;
						} else {
							// no need to continue
							break;
						}
					}
					
					if ($selected_stamp) {
						// add a stamp
						$stamp = imagecreatefrompng($selected_stamp);
						imagealphablending($stamp, true);
						
						$stamp_width = ImageSx($stamp);
						$stamp_height = ImageSy($stamp);
						
						imagecopy($new_image, $stamp, $original_width - $border_thickness - $stamp_width - 2, $original_height - $border_thickness - $stamp_height - 2, 0, 0, $stamp_width, $stamp_height);
					}
					
					// save
					imagejpeg($new_image, $filehandler->getFilenameOnFilestore());
				}
			}
		}
		
		// update icon time
		$user->icontime = time();
	}
}

/**
 * Reverts profile icon to normal (unvalidated) state
 *
 * @param ElggUser $user
 */
function pleio_official_validator_revert_profile_icon(ElggUser $user) {
	// if backups are available restore and reset icontime else remove icontime

	// remove backups
	$sizes = array("large", "medium", "small", "tiny");
	$update_icontime = false;
	
	foreach ($sizes as $size) {
		$current_file = new ElggFile();
		$current_file->owner_guid = $user->getGUID();
		$current_file->setFilename("profile/" . $user->getGUID() . $size . ".jpg");
		
		$current_file->delete();
		
		$backupfile = new ElggFile();
		$backupfile->owner_guid = $user->getGUID();
		$backupfile->setFilename("profile/backup_" . $user->getGUID() . $size . ".jpg");
		
		if (!$backupfile->exists()) {
			// backwards compatibility 15-12-2011
			$backupfile->setFilename("profile/backup_" . $user->username . $size . ".jpg");
		}
		
		if ($backupfile->exists()) {
			$update_icontime = true;
			
			$restored_file = new ElggFile();
			$restored_file->owner_guid = $user->getGUID();
			$restored_file->setFilename("profile/" . $user->getGUID() . $size . ".jpg");
			$restored_file->open("write");
			$restored_file->write($backupfile->grabFile());
			$restored_file->close();
			
			$backupfile->delete();
		}
	}
	
	if ($update_icontime) {
		$user->icontime = time();
	} else {
		unset($user->icontime);
	}
}

/**
 * Functions thats sends out official validator emails
 *
 * @param string $email
 * @param string $code
 * @param int $user_guid
 * @param boolean $revalidate
 *
 * @return Ambigous <boolean, mixed, NULL>
 */
function pleio_official_validator_send_validation_mail($email, $code, $user_guid = 0, $revalidate = false) {
	$result = false;
	
	if (empty($user_guid)) {
		$user_guid = elgg_get_logged_in_user_guid();
	}
	
	$user = get_user($user_guid);
	
	if (!empty($email) && !empty($code) && $user) {
		$link = elgg_get_site_url() . "official_validator/validate?user_guid=" . $user_guid . "&code=" . $code;
		
		$subject = elgg_echo("pleio_official_validator:validate:subject");
		$body = elgg_echo("pleio_official_validator:validate:message", array($user->name, $link));
		
		$site = elgg_get_site_entity();
		// make site email
		if (!empty($site->email)) {
			if (!empty($site->name)) {
				$site_from = $site->name . " <" . $site->email . ">";
			} else {
				$site_from = $site->email;
			}
		} else {
			// no site email, so make one up
			if (!empty($site->name)) {
				$site_from = $site->name . " <noreply@" . get_site_domain($site->getGUID()) . ">";
			} else {
				$site_from = "noreply@" . get_site_domain($site->getGUID());
			}
		}
		
		$email_from = $user->name . " <" . $email . ">";
		
		$result = elgg_send_email($site_from, $email_from, $subject, $body);
		
		if (!$revalidate) {
			$user->setPrivateSetting("pleio_official_validator_email", $email);
			$user->setPrivateSetting("pleio_official_validator_code", $code);
			$user->validated_official = false;
		}
	}
	
	return $result;
}
	