<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Session.php";
	Session::init();
	include_once $realpath."/../classes/Admin.php";

	$admin=new Admin();

 ?>
<?php 
		Session::checkLogin();


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login-Hospital-Management-System</title>
	<link rel="stylesheet" type="text/css" href="css/logstyle.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
		<div class="container">
		<div class="row"> 
			   <div class="col-md-4"> 

			   </div>
			     <div class="col-md-4"> 
			     	<div class="mylog"> 
			     		<div class="imagepanel">
			     			<img src="img/g2.jpg" alt="" class="img-thumbnail" style="width: 100%; height: 100px">
			     		</div>
			     		<h4>Please log in</h4>
			     	   <form action="" method="post">
			     	   		<?php 

			     	   			if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["loginpanel"])) {
			     	   				$username=$_POST["username"];
			     	   				$password=$_POST["password"];
			     	   				$role=$_POST["role"];

			     	   				$result=$admin->adminlogin($username,$password,$role);
			     	   		        echo $result;		
			     	   			}
			     	   		 ?>
			     	   		 <div class="form-group">
							      <label>Select role</label>
							      <select id="role" class="form-control" name="role">
							         <option value="">Select one</option>
							         <option value="administrativ">Administrative</option>
							         <option value="doctor">Doctor</option>
							      </select>
                              </div>
                           <div class="form-group">
                               <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            </div>
                             <div class="form-group">
                                 <label for="password">Password</label>
                                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                             </div>
                             
                             <input type="submit" name="loginpanel" Value="Log in">
                         </form>
			     	</div>
			   				
			   </div>
			     <div class="col-md-4"> 
			   				
			   </div>
		</div>

	</div>

</body>
</html>