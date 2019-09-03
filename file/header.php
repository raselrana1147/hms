<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../classes/FondPage.php";
	include_once $realpath."/../lib/Sessiontwo.php";
	include_once $realpath."/../helper/Format.php";
	Sessiontwo::init();
	$fondpage=new FondPage();
	$fm      =new Format();
 ?>
 
<!DOCTYPE HTML>
<head>
<title><?php  echo $fm->tittlename() ?>-<?php  echo TITTLE ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
   

<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php" ><img src="images/g2.jpg" alt="" style="width: 200px; height: 100px" /></a>
			</div>	 
	 <div class="clear"></div>
 </div>
<div class="menu">

	<?php 
		if (isset($_GET['action']) and $_GET['action']=="logout") {
			Sessiontwo::destroyTwo();
		}

	 ?>
	<?php 
	   	$checksession=Sessiontwo::get("login");	
	   ?>
	<ul id="dc_mega-menu-orange" class="dc_mm-orange " >
	  <li><a href="index.php">Home</a></li>
	  <li><a href="exteriorappointment.php">Appointment</a> </li>
	   <li><a href="#service.php">Service</a></li>
	   <li><a href="contact.php">Contact Us</a></li>
	  <?php 	
	  		if ($checksession !=true) {
	   ?>
	   <li><a href="plogin.php">Log in</a> </li>
	   <?php } ?>
	   	<?php 
	   			if ($checksession==true) {
	   	 ?>
	   <li><a href="profile.php">Profile</a> </li>
	    <li><a href="?action=logout">Log out</a> </li>
	    <?php } ?>
	  <div class="clear"></div>
	</ul>
</div>
