
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Appointment.php";
	$appointment=new Appointment();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$patientid=$_POST["patientid"];
		$appointment->displaypatientinformation($patientid);

	}


 ?>