<?php 
session_start();
require_once('../../lib/config.php');

$db = new db;

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);


$question_text = $db->escape(trim($_POST['questionText']));
$question_type = $db->escape(trim($_POST['questionType']));
$question_bg_color = $db->escape(trim($_POST['questionBgColor']));
$question_class = $db->escape(trim($_POST['questionClass']));

$date=date("Y-m-d H:i:s");

//Table
$table_name = 'tbl_questions';  

$userIP = get_client_ip();

$exist = $db->in_table($table_name, "question_text = '$question_text'");

if($exist) {
	$_SESSION['message'] = "Already exist";
	header('Location: index.php');
	exit;
}

$field_values = "question_text = '$question_text', ".
	"question_class = '$question_class', ".
	"question_bg_color='$question_bg_color', ".
	"question_type = '$question_type', ".
	"created_at = '$date', ".
	"modified_at = '$date'";

$result = $db->insert($table_name, $field_values);			


$_SESSION['message'] = ($result) ? 'Added successfully' : 'Not added - unsuccessful';

header('Location: index.php');
exit;

?>