<?php
	ini_set("session.cookie_httponly", "True");
	ini_set('session.use_only_cookies',"True");
	// ini_set('session.cookie_secure', "True");

	//Cache
	$seconds_to_cache = 3600;
	$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
	header("Expires: $ts");
	header("Pragma: cache");
	header("Cache-Control: max-age=$seconds_to_cache");

	//X-XSS-Protection
	header("X-XSS-Protection: 1; mode=block");
?>
