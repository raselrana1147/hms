
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../../classes/Room.php";
	$room=new Room();
 ?>
<?php 
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$bed   =$_POST['bed'];
		$roomc=$_POST['room'];
		$room->checkbed($bed,$roomc);

	}


 ?>