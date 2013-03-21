<?php 

	$whitelist = $vars["whitelist"];
	
	// add form
	$add_formbody .= "<div>" . elgg_echo("pleio_official_validator:whitelist:forms:add:description") . "</div>\n";
	$add_formbody .= "<div>\n";
	$add_formbody .= elgg_view("input/text", array("name" => "domain", "value" => elgg_echo("pleio_official_validator:whitelist:forms:add:domain")));
	$add_formbody .= elgg_view("input/submit", array("value" => elgg_echo("save")));
	$add_formbody .= "</div>\n";
	
	$add_form = elgg_view("input/form", array("id" => "pleio_official_validator_whitelist_add_form",
												"body" => $add_formbody,
												"action" => "javascript:pleio_official_validator_add_domain();"));

	// domains form
	$domains_formbody .= "<div>" . elgg_echo("pleio_official_validator:whitelist:forms:domains:description") . "</div>\n";
	$domains_formbody .= "<div id='pleio_official_validator_whitelist_domain_wrapper'>\n";
	
	if(!empty($whitelist)){
		sort($whitelist);
		
		foreach($whitelist as $domain){
			$domains_formbody .= "<div class='pleio_official_validator_whitelist_domain'>\n";
			$domains_formbody .= elgg_view("input/hidden", array("name" => "domains[]", "value" => $domain)) . "\n";
			$domains_formbody .= $domain;
			$domains_formbody .= "</div>\n";
		}
	} else {
		$domains_formbody .= "<div class='pleio_official_validator_whitelist_no_domains'>" . elgg_echo("pleio_official_validator:whitelist:forms:domains:no_domains") . "</div>\n";
	}
	
	$domains_formbody .= "</div>\n";
	
	$domains_form = elgg_view("input/form", array("id" => "pleio_official_validator_whitelist_domains_form", "body" => $domains_formbody, "action" => "action/official_validator/whitelist"));

	echo $add_form; 
	echo $domains_form; 