
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Appointment.php";
	$appointment=new Appointment();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$roomtypeid=$_POST["roomtypeid"];
		$appointment->displayavailablroom($roomtypeid);

	}


 ?>