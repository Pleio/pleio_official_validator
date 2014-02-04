<?php

require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");
require_once(dirname(__FILE__) . "/lib/events.php");

/**
 * Init function
 */
function pleio_official_validator_init() {
	// extend css
	elgg_extend_view("css/admin", "css/pleio_official_validator/admin");
	elgg_extend_view("js/admin", "js/pleio_official_validator/admin");
	elgg_extend_view("js/elgg", "js/pleio_official_validator/site");
	
	// register pagehandler for nice URL's
	elgg_register_page_handler("official_validator", "pleio_official_validator_page_handler");
	
	// Register public external pages
	elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'pleio_official_validator_public');
					
	// replace icon
	elgg_register_plugin_hook_handler('entity:icon:url', 'user', 'pleio_official_validator_usericon_hook');
	
	// hook on user hover menu
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'pleio_official_validator_user_hover_menu');
}

/**
 * Function that runs on page setup
 */
function pleio_official_validator_pagesetup() {
	// add admin menu for whitelist management
	elgg_register_admin_menu_item("configure", "official_validator_whitelist", "settings");
			
	// add user menu for requesting a validation mail
	elgg_register_menu_item("page", array(
				"name" => "official_validator",
				"href" => "official_validator/official",
				"text" => elgg_echo("pleio_official_validator:menu:official"),
				"context" => "settings"
			));
}

/**
 * Handles the pages of this plugin
 *
 * @param array $page
 * @return boolean (optional)
 */
function pleio_official_validator_page_handler($page) {
	switch($page[0]){
		case "official":
			include(dirname(__FILE__) . "/pages/official.php");
			return true;
		case "validate":
			include(dirname(__FILE__) . "/pages/validate.php");
			return true;
	}
}

// register default Elgg events
elgg_register_event_handler("init", "system", "pleio_official_validator_init");
elgg_register_event_handler("pagesetup", "system", "pleio_official_validator_pagesetup");

elgg_register_event_handler("login", "user", "pleio_official_validator_login_handler");
elgg_register_event_handler("profileiconupdate", "user", "pleio_official_validator_profile_icon_upload_handler");

// plugin hooks
elgg_register_plugin_hook_handler("action", "profile/cropicon", "pleio_official_validator_pre_profile_icon_crop");

// register actions
elgg_register_action("official_validator/whitelist", dirname(__FILE__) . "/actions/whitelist.php", "admin");
elgg_register_action("official_validator/official", dirname(__FILE__) . "/actions/official.php");
elgg_register_action("official_validator/revalidate", dirname(__FILE__) . "/actions/revalidate.php");
elgg_register_action("official_validator/remove_status", dirname(__FILE__) . "/actions/remove_status.php");
	