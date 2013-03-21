<?php 

	// jQuery action to manage the whitelist
	
	$whitelist = get_input("domains");
	$filter = "";
	
	if(!empty($whitelist)){
		$filter = array();
		
		foreach($whitelist as $domain){
			//url validation
			if (preg_match ("/^([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/i", $domain)) {
				// valid domain format
				if(!in_array($domain, $filter)){
					$filter[] = $domain;
				}
			}
		}
		
		$filter = implode(",", $filter);
	}
	
	elgg_set_plugin_setting("whitelist_domains", $filter, "pleio_official_validator");
