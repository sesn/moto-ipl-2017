<?php 
// require_once('lib/config.php');
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
    <form method="POST" name="mainForm" id="mainForm">
        <input type="hidden" name="token" id="token" value="<?php echo $token; ?>" />   
        <h4>Applicant details</h4>
        
        <div><input type="text" name="applicantName" id="applicantName" placeholder="FULL NAME" value="demo"/></div>
        
        <div>
        <select name="gender" id="gender">
            <option>male</option>
            <option>Female</option>
        </select>
        </div>
        
        <div><input type="text" name="dob" id="dob" placeholder="Date of birth" value="09/12/1991"/></div>

        <div>
        <select name="shirtSize" id="shirtSize">
            <option>m</option>
            <option>asd</option>
        </select>
        </div>
        
        <div><textarea name="childChance" id="childChance" >fsdf</textarea></div>

        <div><textarea name="puneDifferent" id="puneDifferent">adas</textarea></div>

        <h4>Parent/Guardian Details</h4>

        <div><input type="text" name="parentName" id="parentName" placeholder="FULL NAME" value="demo"/></div>

        <div><input type="text" name="parentMobile" id="parentMobile" placeholder="CONTACT NAME" value="demo"/></div>

        <div><input type="email" name="parentEmail" id="parentEmail" placeholder="E-MAIL ADDRESS" value="demo@adf.com"/></div>

        <div><textarea name="parentAddress" id="parentAddress">asd</textarea></div>
        
        <div>
            <input type="radio" name="homeMatch" id="homeMatch" value="1" checked>
            <label for="homeMatch">Rising Giant</label>
        </div>

        <div>
            <input type="radio" name="homeMatch" id="homeMatch" value="2">
            <label for="homeMatch">RCB</label>
        </div>

        <div><input type="text" name="conditionAccept" value='1'></div>

        <div id="submit">Submit</div>
        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
        <script type="text/javascript" src="js/script.js"></script>

    </form>

</body>
</html>