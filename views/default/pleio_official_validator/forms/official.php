<?php 

	$user = elgg_get_logged_in_user_entity();
	
	$email = $user->getPrivateSetting("pleio_official_validator_email");
	$user_email = $user->email;
	$validated = !empty($user->validated_official);
	
	if ($validated && empty($email)) {
		$email = $user->email;
	}
	
	if (empty($validated)) {
		
		if (empty($email)) {
			// add form
			$add_formbody = "<div>" . elgg_echo("pleio_official_validator:official:forms:add:description") . "</div>";
			$add_formbody .= elgg_view("input/email", array("name" => "email", "value" => elgg_echo("pleio_official_validator:official:forms:add:email")));
			$add_formbody .= elgg_view("input/submit", array("value" => elgg_echo("submit")));
			
			$form = elgg_view("input/form", array("id" => "pleio_official_validator_official_add_form", "body" => $add_formbody, "action" => "action/official_validator/official"));
		} else {
			// make revalidation possible
			$pending_formbody = "<div>" . elgg_echo("pleio_official_validator:official:forms:pending:description", array($email)) . "</div>";
			$pending_formbody .= "<div id='pleio_official_validator_official_pending' class='hidden'>";
			$pending_formbody .= elgg_view("input/email", array("name" => "email", "value" => $email));
			$pending_formbody .= elgg_view("input/submit", array("value" => elgg_echo("submit")));
			$pending_formbody .= "</div>";
			$pending_formbody .= "<div id='pleio_official_validator_official_pending_actions'>";
			$pending_formbody .= elgg_view("input/button", array("value" => elgg_echo("pleio_official_validator:official:forms:pending:revalidate"), "oncilck" => "pleio_official_validator_official_revalidate();"));
			$pending_formbody .= "&nbsp;";
			$pending_formbody .= elgg_view("input/button", array("value" => elgg_echo("pleio_official_validator:official:forms:pending:change"), "onclick" => "pleio_official_validator_official_change();"));
			$pending_formbody .= "</div>";
						
			$form = elgg_view("input/form", array("id" => "pleio_official_validator_official_add_form", "body" => $pending_formbody, "action" => "action/official_validator/official"));
		}
		
		echo $form; 
	} else {
		if ($user_email == $email) {
			$text = elgg_echo("pleio_official_validator:official:validated:user_email", array($user_email));
		} else {
			$link = elgg_add_action_tokens_to_url("action/official_validator/remove_status");
			
			$text = elgg_echo("pleio_official_validator:official:validated", array($email));
			$text .= "<br />";
			$text .= elgg_echo("pleio_official_validator:official_validated:cancel", array($link));
		}
		
		echo $text; 
	}