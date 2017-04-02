<?php
	
	$admin_level = "../"; 
	require_once('../../../db.php');

	$MembersVisibility = "Hide";
	 
 /*	if($_SESSION["UserType"] !="Administrator")
	{
		header("location:../index.php");
	}
*/

	
 ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
<title>CMS - Option Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="js/main.js"></script>
<script>
function ShowHideCategories(CategoryName,Action)
	{
		
		if(Action=="Hide")
		{
			//alert(CategoryName + " " +Action )
			eval(CategoryName+"LayerHidden.style.display=''");
			eval(CategoryName+"Layer.style.display='none'");
			//setCookie(CategoryName+"Visibility", Action);
		}
		else
		{
			//alert(CategoryName + " " +Action )
			eval(CategoryName+"LayerHidden.style.display='none'");
			eval(CategoryName+"Layer.style.display=''");
			//setCookie(CategoryName+"Visibility", Action);
		}
	}

function ShowHideProduct(CategoryName,Action)
	{
		
		if(Action=="Hide")
		{
			//alert(CategoryName + " " +Action )
			eval(CategoryName+"LayerHidden.style.display=''");
			eval(CategoryName+"Layer.style.display='none'");
			//setCookie(CategoryName+"Visibility", Action);
		}
		else
		{
			//alert(CategoryName + " " +Action )
			eval(CategoryName+"LayerHidden.style.display='none'");
			eval(CategoryName+"Layer.style.display=''");
			//setCookie(CategoryName+"Visibility", Action);
		}
	}

</script>
</head>

<body topmargin="16">
<br>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="630" valign="top"><p class="h1">Conference Collectables Control Panel 1.0</p></td>
    <td width="110" rowspan="2" valign="bottom"><a href="<?php print $admin_level; ?>logout.php"><IMG alt=welcome 
                  border=0 height=39 
                  src="images/nav04_logout.gif" 
                  width=64></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="740" border="0" align="center" cellpadding="1" cellspacing="0" style="border-left:1px solid #999999; border-right:1px solid #999999;">
  <tr> 
    <td height="20" bgcolor="#B5CCFB" style="border-top:1px solid #669900; border-left:1px solid #669900; border-right:1px solid #669900;"><span class="smalltext">&nbsp;<font color="#FFFFFF"><strong><a href="../admin_area.php" style="COLOR: #ffffff; TEXT-DECORATION: none;"> 
      Home</a> &gt;&gt; Admin Options</strong></font></span></td>
  </tr>
  <tr> 
    <td height="35" bgcolor="#7DC83A"><p class="h2">Welcome</p></td>
  </tr>
  <tr>
    <td height="20" bgcolor="#B5CCFB"><span class="smalltext"><font color="#B5CCFB">.</font></span></td>
  </tr>
</table><table width="740" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999;">
  <tr> 
    <td height="157" align="center" valign="top"> <br>
      <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="30%" align="center" valign="top">                  <table border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="100%">
                      <img border="0" src="images/hightop.gif" width="210" height="23"></td>
                    </tr>
                    <tr>
                      
                <td width="100%" align="center" valign="top" background="images/highbg.gif"> 
                  <table width="95%" border="0" cellspacing="0" cellpadding="0" class="HightLightBox">
                    <tr align="center" valign="top"> 
                      <td colspan="2">
                        <? //require_once('../highlights.php') ?>
                      </td>
                    </tr>
                  </table></td>
                    </tr>
                    <tr>
                      <td width="100%" height="32">
                      <img border="0" src="images/highbot.gif" width="210" height="13"></td>
                    </tr>
                  </table>
</td>
          <td width="70%" valign="top">
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="50%" align="center"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="15%" valign="top"> <img border="0" src="images/box_top_left.gif"></td>
                            <td width="84%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr> 
                                  <td width="1%" valign="top"> <img border="0" src="images/blue_head_left.gif"></td>
                                  <td width="98%" valign="top" background="images/blue_head_bg.gif"> 
                                    <p class="OptionBoxHeading">Change Password</td>
                                  <td width="1%" valign="top"> <img border="0" src="images/blue_head_right.gif" style="background-repeat:repeat-x;"></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="15%" valign="top" background="images/box_left_bg.gif" style="background-repeat:repeat-y;"> 
                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr> 
                                  <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                </tr>
                                <tr> 
                                  <td width="100%" valign="top"> <img src="images/boxicon.gif" width="53" height="52" border="0"></td>
                                </tr>
                                <tr> 
                                  <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                </tr>
                              </table></td>
                            <td width="79%" valign="top" background="images/box_bg.gif" style="background-repeat:repeat-y;background-position:right; cursor:hand" onClick="javascript:location.href='admin_password/index.php'"><p class="OptionBoxText"> 
                                Admin can change Password...</p></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="2%" valign="top"> <img border="0" src="images/box_below_left.gif"></td>
                            <td width="78%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                            <td width="4%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;"> 
                              <img border="0" src="images/arrow_circle.gif"></td>
                            <td width="14%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                            <td width="1%" valign="top"> <img border="0" src="images/box_below_right.gif"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <!-- <td width="50%" align="center"> <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="15%" valign="top"> <img border="0" src="images/box_top_left.gif"></td>
                            <td width="84%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr> 
                                  <td width="1%" valign="top"> <img border="0" src="images/blue_head_left.gif"></td>
                                  <td width="98%" valign="top" background="images/blue_head_bg.gif"> 
                                    <p class="OptionBoxHeading">Category setting</td>
                                  <td width="1%" valign="top"> <img border="0" src="images/blue_head_right.gif" style="background-repeat:repeat-x;"></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="15%" valign="top" background="images/box_left_bg.gif" style="background-repeat:repeat-y;"> 
                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr> 
                                  <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                </tr>
                                <tr> 
                                  <td width="100%" valign="top"> <img border="0" src="images/circle_image.gif"></td>
                                </tr>
                                <tr> 
                                  <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                </tr>
                              </table></td>
                            <td width="79%" valign="top" background="images/box_bg.gif" style="background-repeat:repeat-y;background-position:right; cursor:hand" onclick="javascript:location.href='setting/index.php'"><p class="OptionBoxText"> 
                                Admin can set the order of categories...</p></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr> 
                            <td width="2%" valign="top"> <img border="0" src="images/box_below_left.gif"></td>
                            <td width="78%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                            <td width="4%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;"> 
                              <img border="0" src="images/arrow_circle.gif"></td>
                            <td width="14%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                            <td width="1%" valign="top"> <img border="0" src="images/box_below_right.gif"></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td> -->
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <!-- <tr>
                <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="100%" valign="top"> 
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="15%" valign="top"> <img border="0" src="images/box_top_left.gif"></td>
                                <td width="84%" valign="top"> 
                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr> 
                                          <td width="1%" valign="top"> <img border="0" src="images/blue_head_left.gif"></td>
                                          <td width="98%" valign="top" background="images/blue_head_bg.gif"> 
                                            <p class="OptionBoxHeading">Admin 
                                      Settings</td>
                                          <td width="1%" valign="top"> 
                                              <img border="0" src="images/blue_head_right.gif" style="background-repeat:repeat-x;"></td>
                                        </tr>
                                      </table>
                                    </td>
                              </tr>
                            </table>
                          </td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="15%" valign="top" background="images/box_left_bg.gif" style="background-repeat:repeat-y;"> 
                                  
                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr> 
                                          <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                        </tr>
                                        <tr> 
                                          <td width="100%" valign="top"> <img src="images/category_icon.gif" width="53" height="52" border="0"></td>
                                        </tr>
                                        <tr> 
                                          <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                        </tr>
                                      </table>
                                    </td>
                                <td width="79%" valign="top" background="images/box_bg.gif" style="background-repeat:repeat-y;background-position:right; cursor:hand" onclick="javascript:location.href='admin_settings/index.php'"><p class="OptionBoxText"> 
                                change Admin Settings , Price , Fees, Tax and 
                                many more...</p>
                                </td>
                              </tr>
                            </table>
                         </td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> 
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="2%" valign="top"> <img border="0" src="images/box_below_left.gif"></td>
                                <td width="78%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                                <td width="4%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;"> 
                                   <img border="0" src="images/arrow_circle.gif"></td>
                                <td width="14%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                                <td width="1%" valign="top">  
                                    <img border="0" src="images/box_below_right.gif"></td>
                              </tr>
                            </table>
                         </td>
                    </tr>
                  </table></td>
                <!--
<td align="center"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="100%" valign="top"> 
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="15%" valign="top"> <img border="0" src="images/box_top_left.gif"></td>
                                <td width="84%" valign="top"> 
                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr> 
                                          <td width="1%" valign="top"> <img border="0" src="images/blue_head_left.gif"></td>
                                          <td width="98%" valign="top" background="images/blue_head_bg.gif"> 
                                            <p class="OptionBoxHeading">Statistics
</td>
                                          <td width="1%" valign="top"> 
                                              <img border="0" src="images/blue_head_right.gif" style="background-repeat:repeat-x;"></td>
                                        </tr>
                                      </table>
                                    </td>
                              </tr>
                            </table>
                          </td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="15%" valign="top" background="images/box_left_bg.gif" style="background-repeat:repeat-y;"> 
                                  
                                      <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr> 
                                          <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                        </tr>
                                        <tr> 
                                          <td width="100%" valign="top"> <img src="images/forumicon.gif" width="53" height="52" border="0"></td>
                                        </tr>
                                        <tr> 
                                          <td width="100%" valign="top"><img border="0" src="images/spacer.gif" height=5></td>
                                        </tr>
                                      </table>
                                    </td>
                                <td width="79%" valign="top" background="images/box_bg.gif" style="background-repeat:repeat-y;background-position:right; cursor:hand" onclick="javascript:location.href='statistics/index.php'"><p class="OptionBoxText"> 
                                Manage categories, sub categories and more...</p>
                                </td>
                              </tr>
                            </table>
                         </td>
                    </tr>
                    <tr> 
                      <td width="100%" valign="top"> 
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr> 
                                <td width="2%" valign="top"> <img border="0" src="images/box_below_left.gif"></td>
                                <td width="78%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                                <td width="4%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;"> 
                                   <img border="0" src="images/arrow_circle.gif"></td>
                                <td width="14%" valign="top" background="images/box_below_bg.gif" style="background-repeat:repeat-x;">&nbsp;</td>
                                <td width="1%" valign="top">  
                                    <img border="0" src="images/box_below_right.gif"></td>
                              </tr>
                            </table>
                         </td>
                    </tr>
                  </table></td>
				-->
				<!--<td>&nbsp;</td>
              </tr> -->
            </table></td>
        </tr>
        <tr>
          <td height="18">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      
    </td>
  </tr>
</table><?php
require($admin_level . 'footer.inc.php');
?>
</body>
</html>
