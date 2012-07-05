<?php

	$DOCTYPE = '<?xml version="1.0" encoding="UTF-8"?>';

	$result = $DOCTYPE."\n";

	if ( preg_match ( "/autoconfig.(.*)$/" , $_SERVER["SERVER_NAME"] , $matches ) > 0 ) {
		$domain = $matches[1];

		echo $result;

	} else {
		header("HTTP/1.0 404 Not Found", 404 );
		exit;
	}
?>
