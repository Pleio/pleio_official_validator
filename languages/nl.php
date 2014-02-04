<?php

	$dutch = array(
		
		// (sub)menus
		'admin:settings:official_validator_whitelist' => "Beheer ambtenaar domeinen",
		'pleio_official_validator:menu:official' => "Ambtenaar validatie",
		
		// profile - adminlinks
		'pleio_official_validator:profile:adminlinks:remove_status' => "Verwijder ambtenaar status",
		
		// views
		// whitelist
		'pleio_official_validator:whitelist:title' => "Beheer ambtenaar domeinen",
		
		'pleio_official_validator:whitelist:forms:add:description' => "Hier kun je een domein toevoegen aan de whitelist. Dit maakt het mogelijk voor gebruikers om zich te valideren als een ambtenaar.<br />Geef alles op <b>achter</b> het @-teken (bijvoorbeeld: pleio.nl). Duplicaten worden automatisch gefilterd alsmede ongeldige domeinnamen.",
		'pleio_official_validator:whitelist:forms:add:domain' => "Geef een domein naam op",
		
		'pleio_official_validator:whitelist:forms:domains:description' => "Deze domeinen staan reeds op de whitelist. Om een domein te verwijderen, klik erop.",
		'pleio_official_validator:whitelist:forms:domains:no_domains' => "Geen domeinen op de whitelist. Voer een aantal domeinen in.",
		
		// official email
		'pleio_official_validator:official:forms:add:description' => "Vul een ambtenaar e-mail adres in om het validatie proces te starten. Het e-mail adres is niet publiekelijk beschikbaar en zal nooit gebruikt worden voor communicatie, behalve 1 validatie mail.",
		'pleio_official_validator:official:forms:add:email' => "Geef hier een ambtenaar e-mail addres op",
		
		'pleio_official_validator:official:validate:error:email' => "Het opgegeven e-mail adres is geen geldig e-mail adres",
		'pleio_official_validator:official:validate:error:email_domain' => "Het opgegeven e-mail domein staat niet op de lijst met goedgekeurde domeinen. Je kunt niet worden gevalideerd met dit e-mail adres",
		
		'pleio_official_validator:official:forms:pending:description' => "Je hebt reeds een validatie aangevraagd op het e-mail adres: <b>%s</b>. Dit verzoek wacht op bevestiging. Controleer je inbox (of de spam map) voor het verzoek tot bevestiging. Klik op de link in het bericht om je e-mail adres te bevestigen.<br /> Je kunt het validatie bericht nogmaals laten versturen, of je kunt het e-mail adres aanpassen waarop je gevalideerd wordt.",
		'pleio_official_validator:official:forms:pending:revalidate' => "Herzend validatie bericht",
		'pleio_official_validator:official:forms:pending:change' => "Wijzig e-mail adres",
		
		// validation message
		'pleio_official_validator:validate:subject' => "Pleio ambtenaar e-mail validatie",
		'pleio_official_validator:validate:message' => "Beste %s,
Je hebt een verzoek ingedient om dit e-mail adres te valideren om toegang te krijgen tot ambtenaar content.

Klik op onderstaande link om dit e-mail adres te valideren:
%s

Dit is een geautomatiseerd bericht, aub niet antwoorden op dit bericht",
		
		// validated text
		'pleio_official_validator:official:validated:user_email' => "Je bent succesvol gevalideerd als ambtenaar. De validatie is gedaan op je hoofd e-mail adres <b>%s</b>. Aangezien dit onderdeel is van een geautomatiseerd proces kunt je de validatie niet ongedaan maken totdat je je hoofd e-mail adres wijzigd.",
		'pleio_official_validator:official:validated' => "Je bent succesvol gevalideerd als ambtenaar. Je gebruikte <b>%s</b> als het adres op je status te valideren.",
		'pleio_official_validator:official_validated:cancel' => "Om je ambtenaar status te verwijderen klik op <a href='%s'>deze link</a>",
		
		// actions
		// official
		'pleio_official_validator:action:official:error:input' => "Onjuiste invoer om de validatie te verwerken",
		'pleio_official_validator:action:official:error:domain' => "Ongeldig domein voor validatie",
		'pleio_official_validator:action:official:error:code' => "Fout tijdens het aanmaken van de validatie code, probeer het nogmaals",
		'pleio_official_validator:action:official:error:save' => "Er is een onbekende fout opgetreden, probeer het nogmaals",
		'pleio_official_validator:action:official:success' => "Validatie e-mail succesvol verstuurd. Controleer je e-mail",
		
		// revalidate
		'pleio_official_validator:action:revalidate:error:input' => "Onvoldoende informatie om de validatie e-mail opnieuw te versturen. Wijzig aub je validatie e-mail adres om het probleem op te lossen",
		'pleio_official_validator:action:revalidate:error:save' => "Er is een onbekende fout opgetreden, probeer het nogmaals",
		'pleio_official_validator:action:revalidate:success' => "Validatie e-mail is succesvol opnieuw verzonden",
		
		// remove status
		'pleio_official_validator:action:remove_status:error:user' => "Er kon geen gebruiker worden gevonden",
		'pleio_official_validator:action:remove_status:error:save' => "Er is een onbekende fout opgetreden tijdens het verwijderen van de ambtenaar status, probeer het nogmals",
		'pleio_official_validator:action:remove_status:success' => "Je ambtenaar status is succesvol verwijderd, je kunt altijd opnieuw een verzoek indienen voor validatie",
		
		// procedures
		// validate
		'pleio_official_validator:procedures:validate:error:input' => "Onjuiste invoer om een e-mail adres te valideren",
		'pleio_official_validator:procedures:validate:error:user' => "De opgegeven GUID is geen gebruiker",
		'pleio_official_validator:procedures:validate:error:code' => "Onjuiste validatie code. Je kunt een nieuwe validatie link aanvragen door te gaan naar Instellingen -> Ambtenaar validatie.",
		'pleio_official_validator:procedures:validate:error:save' => "Er is een onbekende fout opgetreden, probeer het nogmaals",
		'pleio_official_validator:procedures:validate:success' => "Het e-mail adres is succesvol gevalideerd",
		
	);
	
	add_translation("nl", $dutch);
