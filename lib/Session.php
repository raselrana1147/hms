
<?php 

		
class Session{
	 public static function init(){
	 	session_start();
	 }
	 
	 public static function set($key, $val){
	 	$_SESSION[$key] = $val;
	 }

	 public static function get($key){
	 	if (isset($_SESSION[$key])) {
	 		return $_SESSION[$key];
	 	} else {
	 		return false;
	 	}
	 }

	 public static function checkSession(){
	 	
	 	if (self::get("login") == false) {
	 		self::destroy();
	 		header("Location:log.php");
	 	}
	 }

	 public static function checkLogin(){
	 	
	 	if (self::get("login") == true) {
	 		header("location:index.php");
	 	}
	 }

	 public static function destroy(){
	 	session_destroy();
	    header("Location:log.php");
	 	session_unset();
	 	
	 }
}
 ?>