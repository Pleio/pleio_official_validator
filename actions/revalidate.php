<?php

$user = elgg_get_logged_in_user_entity();

$email = $user->getPrivateSetting("pleio_official_validator_email");
$code = $user->getPrivateSetting("pleio_official_validator_code");

if (!empty($email) && !empty($code)) {
	if (pleio_official_validator_send_validation_mail($email, $code, get_loggedin_userid(), true)) {
		system_message(elgg_echo("pleio_official_validator:action:revalidate:success"));
	} else {
		register_error(elgg_echo("pleio_official_validator:action:revalidate:error:save"));
	}
} else {
	register_error(elgg_echo("pleio_official_validator:action:revalidate:error:input"));
}

forward(REFERER);
