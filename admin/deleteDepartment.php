<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../classes/Staff.php";

	$staff=new Staff();

 ?>

<?php 
		if (isset($_GET["department_id"]) and $_GET["department_id"] !=NULL) {
			 $department_id=preg_replace("/[^a-zA-Z0-9]/",'',$_GET["department_id"]) ;
			 
		}else{
			header("Location:departmentlist.php");
		}

		if ($department_id) {
			$result=$staff->deletedepartment($department_id);
			if ($result !=false) {
				$value=$result->fetch_assoc();
				$imagename=$value["image"];
				unlink($imagename);
			}
		}

		$deleteresult=$staff->deletedep($department_id);
		if ($deleteresult !=false) {
			header("Location:departmentlist.php");
		}

 ?>