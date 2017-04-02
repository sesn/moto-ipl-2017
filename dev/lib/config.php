<?php
require_once('header-settings.php');
require_once('messages.php');
require_once('function.php');
require_once('db_lib.php');

//General Information settings
define('DOMAIN', 'MOTO');
define('POWERED_BY', 'MOTO');
define('SITE_NAME', 'MOTO FORMS MICROSITE');
define('MAIL_SERVER_DOMAIN', '');

// MySQL time zone setting to normalize dates
define('TIME_ZONE','Asia/Kolkata');
date_default_timezone_set(TIME_ZONE);

define('INFO_TO_MAIL','sesankar11@gmail.com');

define('DB_FALSE', '0');
define('DB_TRUE', '1');

//Encryption SECURE_AUTH_SALT
$salt = "admin_17";

//Inital pagination settings
$num_record_per_page = 10;

$host = $_SERVER['HTTP_HOST'];

//Check whether the url is secure protocol or not
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
	$http_protocol = "https";
} else { 
    $http_protocol = "http";
}

switch($host) {
	case 'localhost':
	case '127.0.0.1':
		$site_url = $http_protocol."://".$host."/project/client/moto/ipl-2017/dev";
		require_once('local.settings.php');
		break;
	default:
		$site_url = $http_protocol."://".$host;
		require_once('dev.settings.php');
		break;
}

// $site_url = "https://www.oyorooms.com/fool-proof";

$admin_path = $site_url."/ad_17" ;
$main_path = $site_url."/";
$media_path = $site_url."/media/";


//Open the database connection
$db = new db;



?>