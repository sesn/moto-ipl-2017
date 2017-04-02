<?php include("../includes/cofigdb.php");
 ?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<LINK REL="SHORTCUT ICON" HREF="../images/admin.ico"> 
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/styles_ie.css">

<link rel="stylesheet" type="text/css" href="css/styles_ie.css">
<title>Control Panel - <?=SITE_NAME?></title>
<script language="javascript">
//Validation of login form
	function validate(){
		x = document.frmLogin
		if ((x.Username.value) == "")	{
			alert("Please specify a valid User ID.")
			x.Username.focus();
			return false;			
		}
		if (x.Password.value==""){
			alert("please specify valid password.")
			x.Password.focus();
			return false;
		}
		return true;
	}
</script>
</head>
<body onLoad="document.all.Password.focus();">
<br>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="670"><p class="h1">Control Panel - <?=SITE_NAME?></p></td>
		<td width="63" height="39" valign="middle" align="center"  style="padding-left:5px;background:url('images/nav04_logout.gif') no-repeat right;">
					<a class="topwhitelinks"><strong>Welcome</strong></a></td>
  </tr>
</table>

<table width="740" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr> 
   <p class="lighth5"> <td height="25" bgcolor="#B5CCFB" style="padding-left:8px;"> <a href="../index.php" class="topwhitelinks">&nbsp;<b>Home</b></a></td>
  </tr>
	<tr><td height="1"></td></tr>
  <tr> 
    <td height="55" bgcolor="#7DC83A" style="padding-left:10px"><p class="text2"><font face="Arial" style="font-size: 14pt" color="#FFFFFF"> 
				Welcome to Control Panel of <?=SITE_NAME?></font></td>
  </tr>
	<tr><td height="1"></td></tr>
  <tr>
    <td bgcolor="#B5CCFB"><span class="smalltext"><font color="#7DC83A">.</font></span></td>
  </tr>
	<tr><td height="1"></td></tr>
</table>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
  <tr>
    <td align="center"><br>
      <br>
      <table width="400" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
				<IMG alt=" Please Login" border=0 height=26 src="images/hd_login.gif" vspace=5 width=70> <br>
        <?php
									if(isset($_GET['err']))
									  {
										$err = $_GET['err'];
										if ($err == 1 )	
										 {
		?>
		&nbsp;&nbsp;  <font face="arial" color="red"><span style="font-size: 8pt"><b>Make sure that your login ID and password are correct.</b></span></font>
								<?php
										}
									}
								?></td>
        </tr>
      </table> 
      <TABLE align=center bgColor="#B5CCFB" border=0 cellPadding=0 cellSpacing=0 
      width=400>
        <TBODY>
          <TR> 
            <TD align=left vAlign=top width=36><IMG border=0 height=8 
            src="images/cornerUL.gif" width=8></TD>
            <TD width="323"><IMG alt="" border=0 height=1 
            src="images\spacer(1).gif" 
            width=1></TD>
            <TD align=right vAlign=top width=41><IMG border=0 height=8 
            src="images/cornerUR.gif" width=8></TD>
          </TR>
          <TR> 
            <TD align=left width=36>&nbsp;</TD>
            <TD>  
                <P class=head>Please Log In</P>
								<form name="frmLogin" method="POST" action="check_adminlogin.php" onSubmit="return validate()">
                <table width="95%" border="0" align="center" cellpadding="4" cellspacing="0">
                  <tr> 
                    <td class="head_small">User ID:</td>
                    <td><INPUT class="textbox" maxLength=50 name=Username size="20" value="administrator"></td>
                  </tr>
                  <tr> 
                    <td class="head_small">Password:</td>
                    <td><INPUT class="textbox" maxLength=12 name=Password 
                        type=password size="20" value=""></td>
                  </tr>
                  <tr> 
                    <td>&nbsp;</td>
                    <td><INPUT type=image cache name=login src="images/fmbtn_login.gif" ></td>
                  </tr>
                </table>
              </FORM>
              
              
            </TD>
            <TD align=left width=41>&nbsp;</TD>
          </TR>
          <TR> 
            <TD align=left vAlign=top width=36><IMG border=0 height=8 
            src="images/cornerBL.gif" width=8></TD>
            <TD><IMG alt="" border=0 height=1 
            src="images\spacer(1).gif" 
            width=1></TD>
            <TD align=right vAlign=top width=41><IMG border=0 height=8 
            src="images/cornerBR.gif" width=8></TD>
          </TR>
        </TBODY>
      </TABLE>
      <br>
      <br>
    </td>
  </tr>
</table>
<?php
require('footer.php');
?>
</body>
</html>