<?php

	// always required doctype
	$DOCTYPE = '<?xml version="1.0" encoding="UTF-8"?>';
	$result = $DOCTYPE."\n";

	// config section

	/*
		a few assumptions are made here:
			* a domain has always the same server for IMAP and SMTP (this might need to be changed some day)
			* if smtp_port and imap_port are not defined use 993 for IMAP and 25 for SMTP
			* if smtp_ssl and imap_ssl are not defined use SSL for IMAP and TLS for SMTP
			* if username_format is undefined use only localpart
	*/

	$domains["ak-online.be"]["server"] = "debs.ak-online.be";

	// do matching and output correct config-file

	if ( preg_match ( "/autoconfig.(.*)$/" , $_SERVER["SERVER_NAME"] , $matches ) > 0 ) {
		$domain = $matches[1];

		$result .= "<clientConfig version=\"1.1\">\n";
		$result .= "  <emailProvider id=\"ak-online.be\">\n";
		$result .= "    <domain>ak-online.be</domain>\n";
		$result .= "    <displayName>AK-ONLINE Mail</displayName>\n";
		$result .= "    <displayShortName>ak-online.be</displayShortName>\n";
		$result .= "\n";
		$result .= "    <incomingServer type=\"imap\">\n";
		$result .= "      <hostname>debs.ak-online.be</hostname>\n";
		$result .= "      <port>993</port>\n";
		$result .= "      <socketType>SSL</socketType>\n";
		$result .= "      <authentication>password-cleartext</authentication>\n";
		$result .= "      <username>%EMAILLOCALPART%</username>\n";
		$result .= "    </incomingServer>\n";
		$result .= "\n";
		$result .= "    <outgoingServer type=\"smtp\">\n";
		$result .= "      <hostname>debs.ak-online.be</hostname>\n";
		$result .= "      <port>465</port>\n";
		$result .= "      <socketType>SSL</socketType>\n";
		$result .= "      <authentication>password-cleartext</authentication>\n";
		$result .= "      <username>%EMAILLOCALPART%</username>\n";
		$result .= "    </outgoingServer>\n";
		$result .= "\n";
		$result .= "  </emailProvider>\n";
		$result .= "</clientConfig>\n";

		echo $result;

	} else {
		header("HTTP/1.0 404 Not Found", 404 );
		exit;
	}
	/*
<clientConfig version="1.1">
  <emailProvider id="ak-online.be">
    <domain>ak-online.be</domain>
    <displayName>AK-ONLINE Mail</displayName>
    <displayShortName>ak-online.be</displayShortName>

    <incomingServer type="imap">
      <hostname>debs.ak-online.be</hostname>
      <port>993</port>
      <socketType>SSL</socketType>
      <authentication>password-cleartext</authentication>
      <username>%EMAILLOCALPART%</username>
    </incomingServer>

    <outgoingServer type="smtp">
      <hostname>debs.ak-online.be</hostname>
      <port>465</port>
      <socketType>SSL</socketType>
      <authentication>password-cleartext</authentication>
      <username>%EMAILLOCALPART%</username>
    </outgoingServer>

  </emailProvider>
</clientConfig>
	*/
?>
