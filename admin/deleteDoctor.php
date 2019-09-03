<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../classes/Staff.php";

	$staff=new Staff();

 ?>

<?php 
		if (isset($_GET["doctor_id"]) and $_GET["doctor_id"] !=NULL) {
			 $doctor_id=preg_replace("/[^a-zA-Z0-9]/",'',$_GET["doctor_id"]) ;
			 
		}else{
			header("Location:doctorlist.php");
		}

		if ($doctor_id) {
			$result=$staff->unlinkdoctorimage($doctor_id);
			if ($result !=false) {
				$value=$result->fetch_assoc();
				$imagename=$value["image"];
				unlink($imagename);
			}
		}

		$deleteresult=$staff->deletedoctor($doctor_id);
		if ($deleteresult !=false) {
			header("Location:doctorlist.php");
		}

 ?>