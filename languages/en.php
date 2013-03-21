<?php 

	$english = array(
		
		// (sub)menus
		'admin:settings:official_validator_whitelist' => "Manage domain whitelist",
		'pleio_official_validator:menu:official' => "Request official validation",
		
		// profile - adminlinks
		'pleio_official_validator:profile:adminlinks:remove_status' => "Remove official status",
		
		// views
		// whitelist
		'pleio_official_validator:whitelist:title' => "Manage domain whitelist",
		
		'pleio_official_validator:whitelist:forms:add:description' => "Here you can add a domain to the whitelist. This will allow an user to be validated as a (goverment) official.<br />Please fill in everything <b>after</b> the @-sign (example: pleio.nl). Duplicate domains are automatically filtered as are invalid domain names.",
		'pleio_official_validator:whitelist:forms:add:domain' => "Fill in a domain name",
		
		'pleio_official_validator:whitelist:forms:domains:description' => "These are the domain already on the whitelist. To remove a domain click on it.",
		'pleio_official_validator:whitelist:forms:domains:no_domains' => "No domains on the whitelist yet! Add some.",
		
		// official email
		'pleio_official_validator:official:forms:add:description' => "Fill in an official e-mail address below to begin the validation process. The e-mail addresses will not be publicly available and you'll never receive any communication on this e-mail address other than 1 verification e-mail.",
		'pleio_official_validator:official:forms:add:email' => "Enter an official e-mail address here",
		
		'pleio_official_validator:official:validate:error:email' => "The supplied e-mail address is not a valid e-mail address",
		'pleio_official_validator:official:validate:error:email_domain' => "The e-mail domain is not on the allowed domain list. You can't be validated with this e-mail address",
		
		'pleio_official_validator:official:forms:pending:description' => "You already requested validation on the e-mail address: <b>%s</b>. This request is awaiting your confirmation. Please check your inbox (or the spam folder) to find a message requesting confirmation. Click on the link in this e-mail to validate your e-mail address.<br /> You can also request that the validation e-mail be resend, or you can change the e-mail address to which to send the validation e-mail.",
		'pleio_official_validator:official:forms:pending:revalidate' => "Resend validation mail",
		'pleio_official_validator:official:forms:pending:change' => "Change e-mail address",
		
		// validation message
		'pleio_official_validator:validate:subject' => "Pleio official e-mail address validation",
		'pleio_official_validator:validate:message' => "Dear %s,
You requested that this e-mail address be validated to allow access to official content.

Please click on the link below to validate this e-mail address:
%s

This is an automated message please don't reply",
		
		// validated text
		'pleio_official_validator:official:validated:user_email' => "You have successfully been validated as an official. The validation was made on your main e-mail address <b>%s</b>. As this is part of an automated process you can't cancel your status until you change your main e-mail address.",
		'pleio_official_validator:official:validated' => "You have successfully been validated as an official. You used <b>%s</b> as the e-mail address to validated your status.",
		'pleio_official_validator:official_validated:cancel' => "To cancel your official status click on <a href='%s'>this link</a>",
		
		// actions
		// official 		
		'pleio_official_validator:action:official:error:input' => "Incorrect input to process the validation request",
		'pleio_official_validator:action:official:error:domain' => "Incorrect domain for the e-mail address",
		'pleio_official_validator:action:official:error:code' => "Unable to create a validation code, please try again",
		'pleio_official_validator:action:official:error:save' => "There was an unknown error, please try again",
		'pleio_official_validator:action:official:success' => "Validation mail send out successfully. Please check your mail",
		
		// revalidate
		'pleio_official_validator:action:revalidate:error:input' => "Insufficient data to resend the validation mail, please change your e-mail address to correct the problem",
		'pleio_official_validator:action:revalidate:error:save' => "There was an unknown error, please try again",
		'pleio_official_validator:action:revalidate:success' => "Validation mail was resend successfully",
		
		// remove status
		'pleio_official_validator:action:remove_status:error:user' => "No user could be found",
		'pleio_official_validator:action:remove_status:error:save' => "An unknown error occured while removing your official status, please try again",
		'pleio_official_validator:action:remove_status:success' => "Your official status has been removed successfully, you can always request te be re-validated as an official",
		
		// procedures
		// validate
		'pleio_official_validator:procedures:validate:error:input' => "Incorrect input to validate an e-mail address",
		'pleio_official_validator:procedures:validate:error:user' => "The supplied GUID is not an User",
		'pleio_official_validator:procedures:validate:error:code' => "Invalid validation code. You can request a new validation link by navigating to Settings -> Request official validation.",
		'pleio_official_validator:procedures:validate:error:save' => "There was an unknown error, please try again",
		'pleio_official_validator:procedures:validate:success' => "The e-mail address was validated successfully",
		
	);
	
	add_translation("en", $english);
