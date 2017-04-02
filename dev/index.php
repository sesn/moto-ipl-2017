<?php 
require_once('lib/config.php');
session_start();

//Generating token to prevent CSRF
if(empty($_SESSION['token'])) {
	if(function_exists('mcrypt_create_iv')) {
		$_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	} else {
		$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	}
}

$token = $_SESSION['token'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MOTO Form</title>
</head>
<body>
	<h1>Moto IPL Forms</h1>
    <h2><?php echo $token; ?></h2>
    <form method="POST" name="mainForm" id="mainForm">
        <input type="text" name="token" id="token" placeholder="FULL NAME" />   
        <h4>Applicant details</h4>
        
        <div><input type="text" name="applicantName" id="applicantName" placeholder="FULL NAME" /></div>
        
        <div>
        <select name="gender" id="gender">
            <option>male</option>
            <option>Female</option>
        </select>
        </div>
        
        <div><input type="text" name="dob" id="dob" placeholder="Date of birth"/></div>
        
        <div><textarea name="childChance" id="childChance"></textarea></div>

        <div><textarea name="puneDifferent" id="puneDifferent"></textarea></div>

        <h4>Parent/Guardian Details</h4>

        <div><input type="text" name="parentName" id="parentName" placeholder="FULL NAME" /></div>

        <div><input type="text" name="parentMobile" id="parentMobile" placeholder="CONTACT NAME" /></div>

        <div><input type="email" name="parentEmail" id="parentEmail" placeholder="E-MAIL ADDRESS" /></div>

        <div>
            <input type="radio" name="homeMatch" id="homeMatch" value="1">
            <label for="homeMatch">Rising Giant</label>
        </div>

        <div>
            <input type="radio" name="homeMatch" id="homeMatch" value="2">
            <label for="homeMatch">RCB</label>
        </div>

        <div><input type="text" name="conditionAccept"></div>

    </form>

</body>
</html>