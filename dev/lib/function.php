<?php 
function checkLogin($val, $redirect) {
  if(!(isset($val) && $val)) {
    header('Location: '.$redirect);
  }
}

//Test input
function test_input($input){
  $input = trim($nput);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

//Parsing the tweets for links if present
function linkify($text) {

	// Linkify URLs
  $text = preg_replace("/[[:alpha:]]+:\/\/[^<>[:space:]]+[[:alnum:]\/]/i",
  	"<a href=\"\\0\" target=\"_blank\">\\0</a>", $text); 
		    	
	// Linkify @mentions
  $text = preg_replace("/\B@(\w+(?!\/))\b/i", 
  	'<a href="https://twitter.com/\\1" title="' .
  	USER_MENTION_TITLE . '\\1">@\\1</a>', $text); 
    	
	// Linkify #hashtags
  $text = preg_replace("/\B(?<![=\/])#([\w]+[a-z]+([0-9]+)?)/i", 
  	'<a href="https://twitter.com/search?q=%23\\1" title="' .
  	HASHTAG_TITLE . '\\1">#\\1</a>', $text); 
    	
  return $text;
}

// Convert a tweet creation date into Twitter format
function twitter_time($time) {

  // Get the number of seconds elapsed since this date
  $delta = time() - strtotime($time);
  if ($delta < 60) {
    return 'less than a minute ago';
  } else if ($delta < 120) {
    return 'about a minute ago';
  } else if ($delta < (60 * 60)) {
    return floor($delta / 60) . ' minutes ago';
  } else if ($delta < (120 * 60)) {
    return 'about an hour ago';
  } else if ($delta < (24 * 60 * 60)) {
    return floor($delta / 3600) . ' hours ago';
  } else if ($delta < (48 * 60 * 60)) {
    return '1 day ago';
  } else {
    return number_format(floor($delta / 86400)) . ' days ago';
  } 
}

function getRandString()
{
	$length = 5;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}
function getExtention($filename)
{
	$arr = explode(".",$filename);
	$first = $arr[0];
	$second = $arr[1];
	return $ext = strtolower($second);
}


function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


function curlSend($url, $postData, $method) {

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);

  if($method == 'POST') {
     curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Content-Length:' . strlen($postData)
     ));
  }
  else {
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json'
     ));
  }

  curl_setopt($ch, CURLOPT_TIMEOUT,5);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;

  }


########## funtion to send MAIL to admin@info #######################
class pro_mail
{
	public static function Mail_process($to, $from1,$subject, $mailBodyText_new)
	{ 

	$from='info@'.$_SERVER['HTTP_HOST'];
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '. $from . "\r\n";
	$mailBodyText="<!DOCTYPE HTML PUBLIC>";//W3C//DTD HTML 4.01 Transitional//EN">			
	$mailBodyText.="<html>";
	$mailBodyText.="<head>";
	$mailBodyText.="<meta http-equiv='Content-Type' content='text/html;charset=utf-8'>";
	$mailBodyText.="</head>";
	$mailBodyText.="<body>";
	$mailBodyText=$mailBodyText_new;
	$mailBodyText.="<p>";
	$mailBodyText.="</p></body></html>";
//echo 	"to  ".$to. BR;
//echo "subj : ".$subject. BR; 	
//echo 	"body: ".$mailBodyText. BR;
//echo "header: ".$headers. BR; die;
    return	$send = mail($to,$subject,$mailBodyText,$headers);   
	unset($mailBodyText);			
	}
}

 ?>  