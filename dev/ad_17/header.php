<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<LINK REL="SHORTCUT ICON" HREF="../images/admin.ico">
<link rel="stylesheet" type="text/css" href="<?php echo $admin_path;?>/css/normalize.css">
<link rel="stylesheet" type="text/css" href="<?php echo $admin_path;?>/css/materialize.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $admin_path;?>/css/main.css">
<title>CMS - Admin Area</title>
</head>
<body>

 <div class="navbar headerNavbar">
      <nav>
        <div class="nav-wrapper">
          <a ui-sref="dashboard.overviewHashTag" class="logo">Control Panel - <?=SITE_NAME?></a>
          <a href="" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

          <ul class="right hide-on-med-and-down headerMenuLinkContainer">
            <li><a href="<?php echo $admin_path;?>/admin_area.php">Home</a></li>
             <li><a href="<?php echo $Main_Path;?>" target="_blank">Website</a></li>
            <li><a href="<?php echo $admin_path?>/logout.php">Logout</a></li>
          </ul>

          <ul class="side-nav" id="mobile-demo">
            <li><a href="../">Home</a></li>
            <li><a href="<?php echo $admin_path?>/logout.php">Logout</a></li>
          </ul>
        </div>
      </nav>
    </div>
