<?php

/**
 * Adds menu items to the user hover menu
 *
 * @param unknown_type $hook
 * @param unknown_type $entity
 * @param unknown_type $return_value
 * @param unknown_type $params
 *
 * @return Ambigous <ElggMenuItem, NULL>
 */
function pleio_official_validator_user_hover_menu($hook, $entity, $return_value, $params) {
	$user = elgg_extract("entity", $params);

	if ($user->validated_official) {
		$menu_options = array(
			"name" => "official_validator_remove",
			"text" => elgg_echo("pleio_official_validator:profile:adminlinks:remove_status"),
			"href" => "action/official_validator/remove_status?user_guid=" . $user->getGUID(),
			"confirm" => elgg_echo("question:areyousure"),
			"section" => "admin"
		);
		$return_value[] = ElggMenuItem::factory($menu_options);
	}

	return $return_value;
}

/**
 * register shutdown function when user crops his avatar
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 */
function pleio_official_validator_pre_profile_icon_crop($hook, $entity_type, $returnvalue, $params) {
	$guid = get_input("guid");
	if (!empty($guid)) {
		$user = get_user($guid);
		if ($user) {
			if (!empty($user->validated_official)) {
				register_shutdown_function("pleio_official_validator_update_profile_icon", $user, array(), true);
			}
		}
	}
}

/**
 * Provides a default profile icon for validated users
 *
 * @param unknown_type $hook
 * @param unknown_type $entity_type
 * @param unknown_type $returnvalue
 * @param unknown_type $params
 *
 * @return Ambigous <string, mixed, NULL>|Ambigous <string, unknown>
 */
function pleio_official_validator_usericon_hook($hook, $entity_type, $returnvalue, $params) {
	$result = $returnvalue;

	if (($hook == 'entity:icon:url') && ($params['entity'] instanceof ElggUser)) {

		$user = $params['entity'];
			
		if (empty($user->icontime) && !empty($user->validated_official)) {
			$size = $params['size'];

			if ($user->isBanned()) {
				return elgg_view('icon/user/default/'.$size);
			}
			$stamp_location = "pleio_official_validator/_graphics/default_profile_icon/$size.jpg";

			if (file_exists(elgg_get_plugins_path() . $stamp_location)) {
				$result = elgg_get_site_url() . "mod/" . $stamp_location;
			}
		}
	}

	return $result;
}

/**
 * Extend the public pages range
 *
 * @param unknown_type $hook
 * @param unknown_type $handler
 * @param unknown_type $return
 * @param unknown_type $params
 *
 * @return string
 */
function pleio_official_validator_public($hook, $handler, $return, $params) {
	$return[] = 'official_validator';
	
	return $return;
}
	