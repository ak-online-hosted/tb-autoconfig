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

    <incomingServer type="imap">
      <hostname>debs.ak-online.be</hostname>
      <port>143</port>
      <socketType>STARTTLS</socketType>
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

    <outgoingServer type="smtp">
      <hostname>debs.ak-online.be</hostname>
      <port>587</port>
      <socketType>STARTTLS</socketType>
      <authentication>password-cleartext</authentication>
      <username>%EMAILLOCALPART%</username>
    </outgoingServer>

    <documentation url="http://ak-online.be/">
      <descr lang="de">Homepage besuchen</descr>
      <descr lang="en">Visit homepage</descr>
    </documentation>
  </emailProvider>
</clientConfig>
	*/
?>
