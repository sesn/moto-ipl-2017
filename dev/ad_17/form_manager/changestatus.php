<?php
session_start();
require_once('../../lib/config.php');

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

$date=date("Y-m-d H:i:s");

//Table
$table_name = 'tbl_questions';

if($_POST["ID"] == "" && trim($_GET["status"])=="" ) {
	$_SESSION['message'] = 'Question is not selected';
	header('Location: index.php');
}

$db = new db;

foreach($_POST['ID'] as $id) {
	$id = $db->escape($id);

	$where = "id = '$id'";

	if($db->escape(trim($_REQUEST['status'])) == 'Inactivate') {

		$field_values = "status = 'N', ".
				"modified_at = '$date'";

	} else {

		$field_values = "status = 'Y', ".
				"modified_at = '$date'";

	}

	$result = $db->update($table_name, $field_values, $where);

}

header('Location: index.php');
exit;
?>