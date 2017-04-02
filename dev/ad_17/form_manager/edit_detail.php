<?php 
session_start();
require_once('../../lib/config.php');

$db = new db;

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

/**
 * If question id for update is not set in session, redirect to index
 */
if(!isset($_SESSION['question_id']) && $_SESSION['question_id'] == '') {
	$_SESSION['message'] = 'Question is not set for update in the server';
	header('Location: index.php');
}

$id = $db->escape(trim($_SESSION['question_id']));
$question_text = $db->escape(trim($_REQUEST['questionText']));
$question_type = $db->escape(trim($_REQUEST['questionType']));
$question_bg_color = $db->escape(trim($_REQUEST['questionBgColor']));
$question_class = $db->escape(trim($_POST['questionClass']));


$date=date("Y-m-d H:i:s");

//Table
$table_name = 'tbl_questions';  

$userIP = get_client_ip();

$exist = $db->in_table($table_name, "id = '$id'");

if(!$exist) {
	$_SESSION['message'] = "Not existed";
	header('Location: index.php');
	exit;
}


$field_values = "question_text = '$question_text', ".
				"question_class = '$question_class', ".
				"question_bg_color='$question_bg_color', ".
				"question_type = '$question_type', ".
				"modified_at = '$date'";

$where = "id = '$id'";

$result = $db->update($table_name, $field_values, $where);	

$_SESSION['message'] = ($result) ? 'Updated successfully' : 'Not updated - unsuccessful';	

header('Location: index.php?show=edit&id='.$id);
exit;


?>