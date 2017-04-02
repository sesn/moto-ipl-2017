<?php
	
$admin_level = "../../"; 
include_once("../../../includes/cofigdb.php"); 

if (isset($_GET['t_parent_ctg_id'])) 
{
		$v_parent_ctg_id = trim($_GET['t_parent_ctg_id']);
}
else{
		$v_parent_ctg_id = 0;
	}

$page_heading="Admin Settings";
  
if (isset($_POST['Submit']) && $_POST['Submit']=="Update")
	{

		$sql_admin = "update tbl_admin set 
					   adminname = '" . $_POST['uname'] . "',
					   adminpassword = '" . $_POST['password'] . "',
					   Email  =	'" . $_POST['Admin_Email'] . "',
					   ContactUsEmail='" . $_POST['contact_email'] . "' where adminid  = 1"; 
					   
		$query = mysql_query($sql_admin);
		
		if  ($query>0)
		{
 		$_SESSION['Message']="<font color=green>Admin Details Updated Successfully.</font>";
		}
		else
		{
		$_SESSION['Message']="<font color=red>There is Some Problem with updation.</font>";
		}
	}
?>


<html>
<head>
<!--<link rel="stylesheet" type="text/css" href="../../css/index.css">
<link rel="stylesheet" type="text/css" href="../../css/styles_ie.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">-->
<link rel="stylesheet" type="text/css" href="../../css/normalize.css">
<link rel="stylesheet" type="text/css" href="../../css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="../../css/main.css">
<title>CMS - Option Manager - Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
		 <!-- HEADER NAVIGATION MENU STARTS-->
	    <?php include("../../header.php"); ?>
	    <!-- HEADER NAVIGATION MENU ENDS-->

	    <!--SITE OWNER SETTINGS ENDS -->

	    <div class="col s6 offset-s3">
	    	<?php
			    $QuerySettings = "select * from tbl_admin where adminid  = 1 "; 
				$ResultSettings = mysql_query($QuerySettings);
		        $RecordSettings = mysql_fetch_assoc($ResultSettings);
			?>

			<!-- ADMIN FORM WRAPPER STARTS -->
          <div class="col s6 card-panel adminFormWrapper siteOwnerSettings">
            
            <div class="col s12 card-panel center-align formHead">SITE OWNER SETTINGS</div>

            <!-- LOGIN FORM STARTS -->
            <form name="form1" method="post" action="index.php" onSubmit="return validation();" class="siteForm">
        		<div class="row">
					<div class="col s4 siteCaptions">User name</div>
					<div class="input-field col s8">
						<input name="uname" placeholder="Placeholder" type="text" class="textbox" id="uname" value="<?=$RecordSettings['adminname']?>"   readonly>
						<label for="uname"></label>
					</div>
				</div>

				<div class="row">
					<div class="col s4 siteCaptions">Password</div>
					<div class="input-field col s8">
						<input name="password" type="password" class="textbox" id="password" value="<?=$RecordSettings['adminpassword']?>">
						<label for="password"></label>
					</div>
				</div>

				<div class="row">
					<div class="col s4 siteCaptions">Admin mail</div>
					<div class="input-field col s8">
						<input name="Admin_Email" type="text" class="textbox" id="Admin_Email" value="<?=$RecordSettings['Email']?>">
						<label for="Admin_Email"></label>
					</div>
				</div>

				<div class="row">
					<div class="col s4 siteCaptions">Contact email</div>
					<div class="input-field col s8">
						<input name="contact_email" type="text" class="textbox" id="contact_email" value="<?=$RecordSettings['ContactUsEmail']?>">
						<label for="contact_email"></label>
					</div>
				</div>		
				
				<div class="row">
                    <div class=""></div>
                    <div class="col s3 offset-s5" style="margin-top: 30px">
                    <input type="submit" name="Submit" value="Update" class="waves-effect waves-light btn text-center col s12 small customPrimaryBtn">
                    </div>
				</div>

            </form>
            <!-- LOGIN FORM ENDS-->
          </div>
          <!-- ADMIN FORM WRAPPER ENDS -->
			
		 <div class="statusMessage">
	    	<?php
			 if (isset($_SESSION['Message']) && $_SESSION['Message'] !=""){
								print $_SESSION['Message'];
							   $_SESSION['Message'] = "";
			 }
			?>
	    </div>	
	    	
	    </div>

	   

	    <!-- SITE OWNER SETTINGS ENDS -->

	    <!-- FOOTER STARTS-->
	    <div class="">
	    <?php require('../../footer.php'); ?>
	    </div>
	    <!-- FOOTER ENDS-->
		</div>
	</div>

<script language="javascript">
function validation()
{
	if(document.form1.password.value=="")
	{
		alert("Password cannot be blank");
		document.form1.password.focus();
		return false;
	}
	else if(document.form1.Admin_Email.value=="")
	{
		alert("Enter Your Admin E-mail Address.");
		document.form1.Admin_Email.focus();
		return false;
	}
		
	else if(document.form1.Admin_Email.value!="")
	{
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(document.form1.Admin_Email.value)))
		{
			alert('Please Enter a Valid Admin Email Address!');
			document.form1.Admin_Email.focus();
			return false;
		}
		else
			document.form1.submit();
	}
	else
	document.form1.submit();
}

</script>

<?php
require('../../footer.php');
?>
</body>
</html>
