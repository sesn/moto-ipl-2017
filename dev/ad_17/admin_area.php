<?php	
session_start();
	 require_once('../lib/config.php');


//Check whether the user is logged in or not
checkLogin($_SESSION['admin_logged_in'], $admin_path);

	$page_heading="Welcome to Control Panel of ".SITE_NAME;
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<LINK REL="SHORTCUT ICON" HREF="../images/admin.ico">
<link rel="stylesheet" type="text/css" href="css/normalize.css">
<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>CMS - Admin Area</title>
</head>
<body>
  <div class="container-fluid">
    <!-- HEADER NAVIGATION MENU STARTS-->
    <?php include("header.php"); ?>
    <!-- HEADER NAVIGATION MENU ENDS-->
    <div class="row">
      <div class="col l10 s12 m14 offset-l1 adminAreaContainer">

      <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="question_manager/index.php?show=View_All"; ?>
            <a href="<?php echo $link; ?>"><i class="material-icons large">receipt</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">Question Manager</a></p>
            <p class="light center">View Questions here.</p>
          </div>
        </div>  

  		<!--  <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="answer_manager/index.php?show=View_All"; ?>
            <a href="<?php echo $link; ?>"><i class="material-icons large">receipt</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">Answer Manager</a></p>
            <p class="light center">View Answer here.</p>
          </div>
        </div>  --> 

        <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="campaign_manager/index.php"; ?>
            <a href="<?php echo $link; ?>"><i class="material-icons large">receipt</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">Campaign Manager</a></p>
            <p class="light center">View campaign control settings here.</p>
          </div>
        </div> 

         <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="winner_manager/index.php"; ?>
            <a href="<?php echo $link; ?>"><i class="material-icons large">receipt</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">Winner Manager</a></p>
            <p class="light center"> View users here.</p>
          </div>
        </div> 

        
        <!-- <?php  if($_SESSION['admin_permission'] == 'write') { ?>
        <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="user_manager/index.php?show=View_All"; ?>
            <a href="<?php echo $link;?>"><i class="material-icons large">camera_enhance</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">User1 Manager</a></p>
            <p class="light center">Add/Remove Users here.</p>
          </div>
        </div> 
        
        <?php } ?>
        <div class="col l3 m4 s12">
          <div class="center promo promo-example">
            <?php $link="options/admin_password/index.php"; ?>
            <a href="<?php echo $link;?>"><i class="material-icons large">settings</i></a>
            <p class="promo-caption"><a href="<?php echo $link; ?>">Site Owner settings</a></p>
            <p class="light center">Edit site owner settings.</p>
          </div>
        </div> -->


      </div>
    </div>
    <!-- FOOTER STARTS-->
    <div class="">
    <?php require('footer.php'); ?>
    </div>
    <!-- FOOTER ENDS-->
  </div>

  
</body>
</html>