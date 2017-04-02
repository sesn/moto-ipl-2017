<?php 
	session_start();
	require_once("../lib/config.php");

	$userIP = get_client_ip();

	$db = new db;

	/*IP CHECK*/
	$where = "IP_addr = '$userIP' AND status = 'Y'";
	$allowedIpOrNot = $db->in_table('tbl_allowed_IP',$where);


	//IP Restriction removal
	$allowedIpOrNot = 1;

	if($allowedIpOrNot == 0) { 
		header('Location:index.php?err=2');
		exit;
	}

	$user_name = $db->escape(trim($_POST['Username']));
	$password = $db->escape(trim($_POST['Password']));


	/*MAIN ADMIN CHECK*/
	$where = "adminname = '$user_name' and adminpassword = '$password' ";
	$main_admin_check = $db->in_table("tbl_admin", $where);


	//Check whether user is main admin otherwise check with users
	if($main_admin_check) {
		$_SESSION['admin_logged_in'] = true;
		$_SESSION['admin_type'] = 'admin';
		$_SESSION['admin_permission'] = 'write';

		//Redirection to admin_area 
		header('Location: admin_area.php');
		exit;

	} else {
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$fetch_admin = $db->select("SELECT * FROM tbl_users WHERE user = '$user_name'");
		$result_admin = $fetch_admin->fetch_assoc();

		$check_password = password_verify($password, $result_admin['pass']);

		if($check_password) {
			$_SESSION['admin_logged_in'] = true;

			if($result_admin['type'] == 'sadmin') {
				$_SESSION['admin_type'] = 'admin';
				$_SESSION['admin_permission'] = 'write';
			} elseif($result_admin['type'] == 'admin') {
				$_SESSION['admin_type'] = 'editor';
				$_SESSION['admin_permission'] = 'read';
			}

			//Redirection to admin_area 
			header('Location: admin_area.php');
			exit;

		} else {
			//Redirection to login 
			header('Location: index.php?err=1');
			exit;
		}

	}
	
?>	
