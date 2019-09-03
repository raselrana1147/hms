
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Admin.php";
	$admin=new Admin();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$username=$_POST["username"];
		$admin->checkadminusername($username);

	}


 ?>