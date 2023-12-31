<?php

	// always required doctype
	$DOCTYPE = '<?xml version="1.0" encoding="UTF-8"?>';
	$result = $DOCTYPE."\n";

	// config section

	/* some assumptions are made here:
		* a domain has always the same server for IMAP and SMTP (this might need to be changed some day)
		* if smtp_port and imap_port are not defined use 993 for IMAP and 25 for SMTP
		* if smtp_ssl and imap_ssl are not defined use SSL for IMAP and TLS for SMTP
		* if username_format is undefined use only localpart (%EMAILLOCALPART%)
	*/

	$domains["ak-online.be"]["server"]	= "debs.ak-online.be";
	$domains["ak-online.net"]["server"]	= "debs.ak-online.be";

	$domains["barf4all.de"]["server"]	= "mia.ak-online.be";
	$domains["barf4all.de"]["username_format"]	= "%EMAILADDRESS%";

	$domains["brauerschranksysteme.de"]["server"]	= "mia.ak-online.be";
	$domains["brauerschranksysteme.de"]["username_format"]	= "%EMAILADDRESS%";

	$domains["feinkost-heyn.de"]["server"]	= "mia.ak-online.be";
	$domains["feinkost-heyn.de"]["username_format"]	= "%EMAILADDRESS%";

	$domains["hsh-online.com"]["server"]	= "katja.ak-online.be";

	$domains["janine-grosse.de"]["server"]	= "mia.ak-online.be";
	$domains["janine-grosse.de"]["username_format"]	= "%EMAILADDRESS%";

	$domains["mia.ak-online.be"]["server"]	= "mia.ak-online.be";
	$domains["mia.ak-online.be"]["username_format"]	= "%EMAILADDRESS%";

	$domains["pokemonis.net"]["server"]	= "mia.ak-online.be";
	$domains["pokemonis.net"]["username_format"]	= "%EMAILADDRESS%";

	$domains["saori-chan.de"]["server"]	= "mia.ak-online.be";
	$domains["saori-chan.de"]["username_format"]	= "%EMAILADDRESS%";

	$domains["vadaru.com"]["server"]	= "mia.ak-online.be";
	$domains["vadaru.com"]["username_format"]	= "%EMAILADDRESS%";


	// do matching and output correct config-file

	if ( preg_match ( "/autoconfig.(.*)$/" , $_SERVER["SERVER_NAME"] , $matches ) > 0 ) {
		$domain = $matches[1];

		if ( is_array( $domains[$domain] ) ) {
			$server = isset( $domains[$domain]["server"] ) ? $domains[$domain]["server"] : NULL;
			if ( $server === NULL ) {
				echo "domain ".$domain." was not found\n";
				exit;
			}

			$imap_port = isset( $domains[$domain]["imap_port"] ) ? $domains[$domain]["imap_port"] : "993";
			$imap_ssl = isset( $domains[$domain]["imap_ssl"] ) ? $domains[$domain]["imap_ssl"] : "SSL";

			$smtp_port = isset( $domains[$domain]["smtp_port"] ) ? $domains[$domain]["smtp_port"] : "25";
			$smtp_ssl = isset( $domains[$domain]["smtp_ssl"] ) ? $domains[$domain]["smtp_ssl"] : "STARTTLS";

			$username_format = isset( $domains[$domain]["username_format"] ) ? $domains[$domain]["username_format"] : "%EMAILLOCALPART%";

			$result .= "<clientConfig version=\"1.1\">\n";
			$result .= "  <emailProvider id=\"".$domain."\">\n";
			$result .= "    <domain>".$domain."</domain>\n";
			$result .= "\n";
			$result .= "    <incomingServer type=\"imap\">\n";
			$result .= "      <hostname>".$server."</hostname>\n";
			$result .= "      <port>".$imap_port."</port>\n";
			$result .= "      <socketType>".$imap_ssl."</socketType>\n";
			$result .= "      <authentication>password-cleartext</authentication>\n";
			$result .= "      <username>".$username_format."</username>\n";
			$result .= "    </incomingServer>\n";
			$result .= "\n";
			$result .= "    <outgoingServer type=\"smtp\">\n";
			$result .= "      <hostname>".$server."</hostname>\n";
			$result .= "      <port>".$smtp_port."</port>\n";
			$result .= "      <socketType>".$smtp_ssl."</socketType>\n";
			$result .= "      <authentication>password-cleartext</authentication>\n";
			$result .= "      <username>".$username_format."</username>\n";
			$result .= "    </outgoingServer>\n";
			$result .= "\n";
			$result .= "  </emailProvider>\n";
			$result .= "</clientConfig>\n";

			header ( "Content-Type: text/xml" );
			echo $result;
		}
	} else {
		header("HTTP/1.0 404 Not Found", 404 );
		exit;
	}
?>
