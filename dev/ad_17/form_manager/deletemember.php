<?php
session_start();
require_once('../../lib/config.php');

//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

$date=date("Y-m-d H:i:s");

//Table
$table_name = 'tbl_form_entry';

if($_POST["ID"] == "" && trim($_GET["status"])=="" ) {
	$_SESSION['message'] = 'Question is not selected';
	header('Location: index.php');
}

$db = new db;

foreach($_POST['ID'] as $id) {
	$id = $db->escape(trim($id));

	$where = "id = '$id'";

	$result = $db->delete($table_name, $where);

}
$_SESSION['message'] = ($result) ? 'Deleted successfully' : 'Not Deleted - unsuccessful';

header('Location: index.php');
exit;
?>