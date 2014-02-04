<?php
 
$whitelist = elgg_get_plugin_setting("whitelist_domains", "pleio_official_validator");

if (!empty($whitelist)) {
	$whitelist = string_to_tag_array($whitelist);
} else {
	$whitelist = array();
}

echo elgg_view("pleio_official_validator/forms/whitelist", array("whitelist" => $whitelist));
