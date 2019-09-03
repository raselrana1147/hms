
<?php 
	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";
 ?>

<?php 

		class Admin
		{
			
			private $db;
			private $fm;

			function __construct()
			{
				$this->db=new Database();
				$this->fm=new Format();
			}

			public function adminlogin($username,$password,$role){
					$username=$this->fm->validation($username);
					$password=$this->fm->validation($password);
					$role=$this->fm->validation($role);
					$username=mysqli_real_escape_string($this->db->link,$username);
					$role=mysqli_real_escape_string($this->db->link,$role);

					if ($username=="" || $password=="" || $role=="") {
							$message="<span class='error'>No fields can be empty</span>";
						    return $message;
					}else{
						if ($role=="administrativ") {
							
						$password=mysqli_real_escape_string($this->db->link,md5($password));
						$sql="SELECT * FROM admin where username='$username' AND password='$password'";
						$query=$this->db->select($sql);
						if ($query !=false) {
							$value=$query->fetch_assoc();
							if ($value['status']==0) {
								Session::set("login",true);
								Session::set("admin_id",$value['admin_id']);
								Session::set("username",$value['username']);
								Session::set("email",$value['email']); 
								Session::set("fname",$value['fname']); 
								Session::set("lname",$value['lname']); 
								Session::set("image",$value['image']); 
								Session::set("role",$value['role']) ;
								header("Location:index.php");
							}else{
								$message="<span class='error'>Your accound has been disabled</span>";
						        return $message;
							}
							
						}else{
							$message="<span class='error'>Information did not match</span>";
						    return $message;
						}
					  }else{
					  		$password=mysqli_real_escape_string($this->db->link,md5($password));
						$sql="SELECT * FROM doctor where username='$username' AND password='$password'";
						$query=$this->db->select($sql);
						if ($query !=false) {
							$value=$query->fetch_assoc();
							if ($value['status']==0) {
								Session::set("login",true);
								Session::set("doctor_id",$value['doctor_id']);
								Session::set("username",$value['username']);
								Session::set("email",$value['email']); 
								Session::set("name",$value['name']); 
								Session::set("role",$value['role']) ;
								Session::set("image",$value['image']); 
								header("Location:index.php");
							}else{
								$message="<span class='error'>Your accound has been disabled</span>";
						        return $message;
							}
							
						}else{
							$message="<span class='error'>Information did not match</span>";
						    return $message;
						}

					  }

					}

			   }


			public function changePass($data,$admin_id){
				$oldpass =$this->fm->validation($data['oldpass']);
				$newpass =$this->fm->validation($data['newpass']);
				$admin_id=$this->fm->validation($admin_id);
				$admin_id=mysqli_real_escape_string($this->db->link,$admin_id);        
				if ($oldpass=="" || $newpass=="") {
					$message="<span class='error'>No fields can be empty</span>";
				     return $message;
				}else{
					$oldpass =mysqli_real_escape_string($this->db->link,md5($oldpass));
					$sql="SELECT * FROM admin where password='$oldpass' and admin_id='$admin_id'";
					$query=$this->db->select($sql);
					if ($query !=false) {
						$newpass =mysqli_real_escape_string($this->db->link,md5($newpass)); 
						$update="UPDATE admin set password='$newpass' where password='$oldpass' and admin_id='$admin_id'";
						$upquery=$this->db->update($update);
						if ($upquery !=false) {
							$message="<span class='succes'>Password updated successfully</span>";
				             return $message;
						}
					}else{
						$message="<span class='error'>Old password did not match</span>";
				        return $message;
					}
				}

			}




		public function checkadminusername($username){
				$sql="SELECT * FROM admin where username='$username'";
				$query=$this->db->select($sql);
				if ($query) {
					echo "Username already exist";

				}

		}

		public function adduser($username,$password,$role){

				$username =$this->fm->validation($username);
				$password =$this->fm->validation($password);
				$role     =$this->fm->validation($role);

				$username=mysqli_real_escape_string($this->db->link,$username); 
				$role=$this->fm->validation($role);

				if (empty($username) || empty($password) || empty($role)) {
			        $message="<span class='error'>No fields can be empty</span>";
				    return $message;
				}else{
					$check="SELECT * FROM admin where username='$username'";
					$query=$this->db->select($check);
					if ($query) {
						
						$message="<span class='error'>Username already exist</span>";
						return $message;
					}else{
						$password=mysqli_real_escape_string($this->db->link,md5($password)); 
					    $sql="INSERT INTO admin(username,password,role) values('$username','$password','$role')";
					    $insertquery=$this->db->insert($sql);
					     if ($insertquery !=false) {
						 $message="<span class='success'>User added successfully</span>";
				         return $message;
					    }  
						
					}

				}


		}

		public function showuserInfo($username, $admin_id){
				$username =$this->fm->validation($username);
				$admin_id =$this->fm->validation($admin_id);
				$username =mysqli_real_escape_string($this->db->link,$username); 
				$admin_id =mysqli_real_escape_string($this->db->link,$admin_id); 

				$sql="SELECT * FROM admin where admin_id='$admin_id' and username='$username'";
				$query=$this->db->select($sql);
				if ($query !=false) {
					return $query;
				}
		}


public function selectUser($admin_id){
	$admin_id =$this->fm->validation($admin_id);
	$username=mysqli_real_escape_string($this->db->link,$admin_id);
	$sql="SELECT * FROM admin where admin_id='$admin_id'";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
	    }

}


public function updateUserinfo($data,$admin_id,$file){
    $fname   =$this->fm->validation($data["fname"]);
    $lname   =$this->fm->validation($data["lname"]);
    $email   =$this->fm->validation($data["email"]);
    $address =$this->fm->validation($data["address"]);
    $phone   =$this->fm->validation($data["phone"]);

    $fname  =mysqli_real_escape_string($this->db->link,$fname);
    $lname  =mysqli_real_escape_string($this->db->link,$lname);
    $email  =mysqli_real_escape_string($this->db->link,$email);
    $address=mysqli_real_escape_string($this->db->link,$address);
    $phone  =mysqli_real_escape_string($this->db->link,$phone);

    $admin_id =$this->fm->validation($admin_id);

  
  	$permittedimage=array("jpg","png","jpeg");
  	$image=$_FILES["image"]["name"];
  	$image_tmp=$_FILES["image"]["tmp_name"];

  	$div=explode(".", $image);
  	$image_ext=strtolower(end($div));
  	$unique_name=substr(md5(time()),0,10).'.'.$image_ext;
	$uploaded_image="upload/".$unique_name;

	if ($fname=="" || $lname=="" || $email=="" || $address=="" || $phone=="") {
		 $message="<span class='error'>No fields can be empty</span>";
		 return $message;
	}else{

			if (!empty($image)) {
				move_uploaded_file($image_tmp, $uploaded_image);
				$sql   ="UPDATE admin set 
				fname  ='$fname', 
				lname  ='$lname', 
				email  ='$email', 
				address='$address',
				phone  ='$phone',
				image  ='$uploaded_image' where admin_id='$admin_id'";

				$query=$this->db->update($sql);
				if ($query !=false) {
					 $message="<span class='success'>Updated successfully</span>";
		             return $message;
				}
			}else{

				$sql   ="UPDATE admin set 
				fname  ='$fname', 
				lname  ='$lname', 
				email  ='$email', 
				address='$address',
				phone  ='$phone'
				where admin_id='$admin_id'";

				$query=$this->db->update($sql);
				if ($query !=false) {
					 $message="<span class='success'>Updated successfully</span>";
		             return $message;
				}
			}
	   }
   
}

	public function userlist()
	{
		$sql="SELECT * FROM admin";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
	}

public function showallusername($admin_id){
	$admin_id   =$this->fm->validation($admin_id);
	$admin_id=mysqli_real_escape_string($this->db->link,$admin_id);
	$sql="SELECT * FROM admin where admin_id='$admin_id'";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
   
}

public function updateUsernamebyadmin($username,$admin_id){
	$admin_id   =$this->fm->validation($admin_id);
	$admin_id=mysqli_real_escape_string($this->db->link,$admin_id);

	$username   =$this->fm->validation($username);
	$username=mysqli_real_escape_string($this->db->link,$username);
	if ($username=="") {
		 $message="<span class='error'>Field must not be empty</span>";
		 return $message;
	}else{
		$sql="SELECT * FROM admin where username='$username'";
	    $query=$this->db->select($sql);
	    if ($query !=false) {
	     $message="<span class='error'>This username already exist</span>";
		 return $message;
	    }else{
	    	$sql="UPDATE admin set username='$username' where admin_id='$admin_id'";
	    	 $query=$this->db->update($sql);
	    	 if ($query !=false) {
	    	 	$message="<span class='success'>Update successfully</span>";
		       return $message;
	    	 }
	    }
	}

	

}

public function totaluser(){
	$sql="SELECT * FROM admin";
	$query=$this->db->select($sql);
	if ($query !=false) {
		$totaluser=mysqli_num_rows($query);
		return $totaluser;
	}
}

public function deleteinvoce($invoice_id){
	$invoice_id   =$this->fm->validation($invoice_id);
	$invoice_id=mysqli_real_escape_string($this->db->link,$invoice_id);
	$sql="DELETE  FROM invoice where invoice_id='$invoice_id'";
	$query=$this->db->delete($sql);
	if ($query !=false) {
		       $message="<span class='success'>Invoice deleted successfully</span>";
		       return $message;
	}

}






	}

 ?>