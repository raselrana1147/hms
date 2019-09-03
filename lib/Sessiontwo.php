<?php 
include_once "Session.php";
class Sessiontwo extends Session
{

	public static function checkSessionTwo(){
		if (self::get("login")==false) {
			self::destroy();
	 		header("Location:plogin.php");
		}
	}
	
	public static function destroyTwo(){
		session_destroy();
		header("Location:plogin.php");
		session_unset();
	}
	
	
}


 ?>