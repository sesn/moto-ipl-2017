<?php 
session_start();
require_once("../lib/config.php");

if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
  header('Location: admin_area.php');
}

 ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<LINK REL="SHORTCUT ICON" HREF="../images/admin.ico">
<link rel="stylesheet" type="text/css" href="css/normalize.css">
<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">


<title>Control Panel - <?=SITE_NAME?></title>
</head>
<body>
  <div class="container-fluid">

    <!-- HEADER NAVIGATION MENU STARTS -->
    <div class="navbar-fixed headerNavbar">
      <nav>
        <div class="nav-wrapper">
          <a ui-sref="dashboard.overviewHashTag" class="logo">Control Panel - <?=SITE_NAME?></a>
          <a href="" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

          <!-- <ul class="right hide-on-med-and-down headerMenuLinkContainer">
            <li><a href="../">Home</a></li>
          </ul> -->

          <ul class="side-nav" id="mobile-demo">
            <li><a href="../">Login with Twitter</a></li>
            <li><a >Dashboard</a></li>
            <li></li>
            <li><a ui-sref="/logout">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- HEADER NAVIGATION MENU ENDS -->

    <div class="row">
       <div class="col s12">
          <!-- ADMIN FORM WRAPPER STARTS -->
          <div class="col l4 m6 s10 offset-s1 offset-m3 offset-l4 card-panel adminFormWrapper ">
            
            <div class="col s12 card-panel center-align formHead">Log In</div>

            <!-- LOGIN FORM STARTS -->
            <form name="frmLogin" method="POST" action="check_adminlogin.php" onSubmit="return validate()">
              <div class="input-field col l12 m12 s12 userNameDiv">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="userName" maxLength=50 name=Username size="20" type="text" class="validate">
                  <label for="userName">Username</label>
              </div>

              <div class="input-field col l12 m12 s12 clearfix">
                <i class="material-icons prefix">lock outline</i>
                <input id="password" maxLength=20 name=Password type=password size="20" class="validate">
                <label for="password">Password</label>
              </div>
              

              <div class="col s2 offset-s4 input-field customPrimaryBtn">
                  <button class="btn waves-effect waves-light" type="submit" cache name="login">Submit</button>
              </div>
              
              <!-- <input class="waves-effect waves-light btn text-center col s4 offset-s4 small customPrimaryBtn" type="submit" cache name=login  value="submit"> -->
              <!--<INPUT type=image cache name=login src="images/fmbtn_login.gif" >-->

            </form>
            <!-- LOGIN FORM ENDS-->
            
          <!-- ADMIN FORM WRAPPER ENDS -->
        </div>
        <div class="col s6 offset-s4"><?php
                  if(isset($_GET['err']))
                    {
                    $err = $_GET['err'];
                    if ($err == 1 ) 
                     {
    ?>
    &nbsp;&nbsp;  <blockquote style="color: red;">Make sure that your login ID and password are correct.</blockquote>
                <?php
                    }
                    elseif ($err == 2) {
                      ?>
                       &nbsp;&nbsp;  <blockquote style="color: red;">Permission denied. Contact administrator. </blockquote>
                      <?php
                    }
                  }
                ?></div>
          </div>
    </div>
<?php
require('footer.php');
?>
</div>
</body>
</html>