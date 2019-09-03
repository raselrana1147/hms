
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Room.php";
	$room=new Room();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$roomc   =$_POST['room'];
		$roomtype=$_POST['roomtype'];
		$room->checkeroom($roomtype,$roomc);

	}


 ?>