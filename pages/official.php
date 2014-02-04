<?php

gatekeeper();

elgg_set_context("settings");
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

// build page elements
$title_text = elgg_echo("pleio_official_validator:menu:official");

$body = elgg_view("pleio_official_validator/forms/official");

// draw page
echo elgg_view_page($title_text, elgg_view_layout("one_sidebar", array("title" => $title_text, "content" => $body)));
