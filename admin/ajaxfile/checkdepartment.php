
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Staff.php";
	$staff=new Staff();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$department=$_POST["department"];
		$staff->checkexistdepartment($department);

	}


 ?>