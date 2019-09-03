<?php 

	$realpath=realpath(dirname(__FILE__));
	include_once ($realpath."/../lib/Database.php");
	include_once ($realpath."/../helper/Format.php");

 ?>

 <?php 
 
 class Staff
 {
 		private $db;
 		private $fm;
 	
 	function __construct()
 	{
 		$this->db=new Database();
 		$this->fm=new Format();
 	}

 	public function checkexistdepartment($department){
 			$sql="SELECT * FROM department where department='$department'";
				$query=$this->db->select($sql);
				if ($query) {
					echo "This department already exist";
			}
 	}


 	public function addDepartment($data,$file){
 		$department  =$this->fm->validation($data['department']);
 		$department  =mysqli_real_escape_string($this->db->link,$department);

 		$dimage  =$_FILES["dimage"]["name"];
 		$tmp_name=$_FILES["dimage"]["tmp_name"];

 		$div          =explode('.', $dimage);
 		$dimage_ext   =strtolower(end($div));
 		$unique_dimage=substr(md5(time()), 0,10).'.'.$dimage_ext;
 		$upload_dimage="upload/".$unique_dimage;

 		if ($department=="" || $dimage=="") {
 			 $message="<span class='error'>No feilds must not be empty</span>";
		     return $message;
 		}else{
 			$sql="SELECT * FROM department where department='$department'";
 			$query=$this->db->select($sql);
 			if ($query) {
 				$message="<span class='error'>This department already existed</span>";
		         return $message;
 				
 			}else{
 				 move_uploaded_file($tmp_name, $upload_dimage);
 				  $sql="INSERT INTO department(department,image)VALUES('$department','$upload_dimage')";
 			      $query=$this->db->insert($sql);
 			    if ($query !=false) {
	 				$message="<span class='success'>Department has been added successfully....</span>";
			        return $message;
 			   }
 			}
            
 		}
 	}



 	public function dispalyDepartmanet(){

 		$sql  ="SELECT * FROm department";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
 	}

public function showDepartmentinfo($department_id){
	    $department_id =$this->fm->validation($department_id);
 		$department_id =mysqli_real_escape_string($this->db->link,$department_id );

 		$sql="SELECT * FROM department where department_id='$department_id'";
 			$query=$this->db->select($sql);
 			if ($query !=false) {
 				return $query;
 				
 			}
     }


     public function updateDepartment($data,$department_id,$file){
     	
 		$department   =$this->fm->validation($data['department']);
 		$department   =mysqli_real_escape_string($this->db->link,$department);
 		$department_id=$this->fm->validation($department_id);
 		$department_id=mysqli_real_escape_string($this->db->link,$department_id);


 		$image   =$_FILES['image']["name"];
 		$tmp_name=$_FILES["image"]["tmp_name"];


 		$div         =explode('.', $image);
 		$image_ext   =strtolower(end($div));
 		$unique_image=substr(md5(time()),0,10).'.'.$image_ext;
 		$upload_image="upload/".$unique_image;

 		if ($department=="") {
 			$message="<span class='error'>Feild must not be empty</span>";
			return $message;
 		}else{
 			if (!empty($image)) {
 				move_uploaded_file($tmp_name, $upload_image); 
 				$sql="UPDATE department set 
 				department   ='$department', 
 				image        ='$upload_image' where 
 				department_id='$department_id'";
 				$query=$this->db->update($sql);
 				if ($query !=false) {
 					$message="<span class='success'>Department has updated successfully</span>";
			        return $message;
 				}
 			}else{
 				$sql="UPDATE department set department='$department' where department_id='$department_id'";
 				$query=$this->db->update($sql);
 				if ($query !=false) {
 					$message="<span class='success'>Department has updated successfully</span>";
			        return $message;
 				}
 			}
 		}
     }

     public function deletedepartment($department_id){
     		$department_id   =$this->fm->validation($department_id);
 		    $department_id   =mysqli_real_escape_string($this->db->link,$department_id);
 		    $sql="SELECT * FROM department where department_id='$department_id'";
 		    $query=$this->db->select($sql);
 		    if ($query !=false) {
 		    	return $query;
 		    }

     }

     public function deletedep($department_id){
     	     $department_id   =$this->fm->validation($department_id);
 		     $department_id   =mysqli_real_escape_string($this->db->link,$department_id);
 		    $sql="DELETE FROM department where department_id='$department_id'";
 		    $query=$this->db->delete($sql);
 		    if ($query !=false) {
 		    	return $query;
 		    }
     }


     public function enableuser($disable_id){
 		$sql="UPDATE admin set status='0' where admin_id='$disable_id'";
 		$query=$this->db->update($sql);
 		if ($query !=false) {
 			$message="<span class='success'>User has been enabled successfully</span>";
			return $message;
 		}
     }

     public function disableuser($enabl_id){
     	$sql="UPDATE admin set status='1' where admin_id='$enabl_id'";
 		$query=$this->db->update($sql);
 		if ($query !=false) {
 			$message="<span class='success'>User has been disabled successfully</span>";
			return $message;
 		}
     }


     public function checkedoctoremail($doctoremail){
     	$sql="SELECT * FROM doctor where email='$doctoremail'";
				$query=$this->db->select($sql);
				if ($query) {
					echo "This email already exist";
			}

     }
     public function checkexdoctorid($username){
     	$sql="SELECT * FROM doctor where username='$username'";
				$query=$this->db->select($sql);
				if ($query) {
					echo "This doctor already exist";
			}

     }

     public function selectDepartment(){
     	$sql="SELECT * FROM department";
     	$query=$this->db->select($sql);
     	if ($query !=false) {
     		return $query;
     	}
     }


     public function addDoctor($data,$file){

     		$name         =$this->fm->validation($data["name"]);
     		$title        =$this->fm->validation($data["title"]);
     		$department   =$this->fm->validation($data["department"]);
     		$address      =$this->fm->validation($data["address"]);
     		$email        =$this->fm->validation($data["email"]);
     		$phone        =$this->fm->validation($data["phone"]);
     	    $username     =$this->fm->validation($data["username"]);
     	    $qualification=$this->fm->validation($data["qualification"]);
     	    $password     =$this->fm->validation($data["password"]);
            $profiletype  =$this->fm->validation($data["profiletype"]);


     	    $name         =mysqli_real_escape_string($this->db->link,$name);
     	    $title        =mysqli_real_escape_string($this->db->link,$title);
     	    $department   =mysqli_real_escape_string($this->db->link,$department);
     	    $address      =mysqli_real_escape_string($this->db->link,$address);
     	    $email        =mysqli_real_escape_string($this->db->link,$email);
     	    $name         =mysqli_real_escape_string($this->db->link,$name);
     	    $phone        =mysqli_real_escape_string($this->db->link,$phone);
     	    $qualification=mysqli_real_escape_string($this->db->link,$qualification);
            $profiletype  =mysqli_real_escape_string($this->db->link,$profiletype);

     	  


             $image       =$_FILES["image"]["name"];
             $tmp_name    =$_FILES["image"]["tmp_name"];
             $div         =explode('.', $image);
             $image_ext   =strtolower(end($div));
             $unique_image=substr(md5(time()),0,10).'.'.$image_ext;
             $upload_image="upload/".$unique_image;

             if (empty($name) || empty($title) || empty($department) || empty($qualification) || empty($image) || empty($address) || empty($email) || empty($phone) || empty($password) || empty($username) || empty($profiletype)) {
             	$message="<span class='error'>No feilds must not be empty</span>";
			    return $message;
             }else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
             	$message="<span class='error'>E-mail is not valid</span>";
			    return $message;
             }else{

             		$sql="SELECT * FROM doctor where email='$email'";
             		$query=$this->db->select($sql);
             		if ($query !=false) {
             			$message="<span class='error'>This email aready exist</span>";
			            return $message;
             		}else{
             			move_uploaded_file($tmp_name, $upload_image);
             			$password  =mysqli_real_escape_string($this->db->link,md5($password));
             			$sql="INSERT INTO doctor(name,title,department,qualification,email,address,phone,password,image,username,role)
             			VALUES('$name','$title','$department','$qualification','$email','$address','$phone','$password','$upload_image','$username','$profiletype')";
             			$query=$this->db->insert($sql);
             			if ($query !=false) {
             				$message="<span class='success'>Doctor added successfully</span>";
			                return $message;
             			}
             	     }
                  }  
               }

    public function displayDoctor(){
        $sql="SELECT doctor.*,department.department from doctor inner join department on doctor.department=department.department_id";
        $query=$this->db->select($sql);
        if ($query !=false) {
            return $query;
        }
    }

    

 	
   public function unlinkdoctorimage($doctor_id){
            $doctor_id   =$this->fm->validation($doctor_id);
            $doctor_id   =mysqli_real_escape_string($this->db->link,$doctor_id);
            $sql="SELECT * FROM doctor where doctor_id='$doctor_id'";
            $query=$this->db->select($sql);
            if ($query !=false) {
                return $query;
            }
     }
     public function deletedoctor($doctor_id){
             $doctor_id   =$this->fm->validation($doctor_id);
             $doctor_id   =mysqli_real_escape_string($this->db->link,$doctor_id);
            $sql="DELETE from doctor where doctor_id='$doctor_id'";
            $query=$this->db->delete($sql);
            if ($query !=false) {
                return $query;
            }

    }

    public function enableDoctor($enable_id){
         $enable_id   =$this->fm->validation($enable_id);
         $enable_id   =mysqli_real_escape_string($this->db->link,$enable_id);
         $sql="UPDATE doctor SET status='0'  where doctor_id='$enable_id'";
         $query=$this->db->update($sql);
         if ($query !=false) {
             $message="<span class='success'>Doctor enabled successfully</span>";
             return $message;
         }

    }

     public function disableDoctor($disable_id){
         $disable_id   =$this->fm->validation($disable_id);
         $disable_id   =mysqli_real_escape_string($this->db->link,$disable_id);
         $sql="UPDATE doctor SET status='1'  where doctor_id='$disable_id'";
         $query=$this->db->update($sql);
         if ($query !=false) {
             $message="<span class='success'>Doctor disabled successfully</span>";
             return $message;
         }

    }

    public function checkeexitpatient($pno){
         $pno   =$this->fm->validation($pno);
         $pno   =mysqli_real_escape_string($this->db->link,$pno);
         $sql="SELECT * FROM  patient where pno='$pno'";
         $query=$this->db->select($sql);
         if ($query !=false) {
             echo "This patient already exist";
         }
    }


    public function addPatient($data){

        $name     =$this->fm->validation($data['name']);
        $address  =$this->fm->validation($data['address']);
        $phone    =$this->fm->validation($data['phone']);
        $sex      =$this->fm->validation($data['sex']);
        $dob      =$this->fm->validation($data['dob']);
        $bloodgroup=$this->fm->validation($data['bloodgroup']);
        $disease  =$this->fm->validation($data['disease']);
        $pno      =$this->fm->validation($data['pno']);

        $name     =mysqli_real_escape_string($this->db->link,$name);
        $address  =mysqli_real_escape_string($this->db->link,$address);
        $phone    =mysqli_real_escape_string($this->db->link,$phone);
        $sex      =mysqli_real_escape_string($this->db->link,$sex);
        $dob      =mysqli_real_escape_string($this->db->link,$dob);
        $bloodgroup=mysqli_real_escape_string($this->db->link,$bloodgroup);
        $disease  =mysqli_real_escape_string($this->db->link,$disease);
        $pno      =mysqli_real_escape_string($this->db->link,$pno);
       

        $newdob= new DateTime($dob);
        $nowDate=new DateTime();
        $difference = $nowDate->diff($newdob);
        $age=$difference->y;
        
        if ($name=="" || $address=="" || $phone=="" || $sex=="" || $dob=="" || $bloodgroup=="" || $disease=="" || $pno=="") {
            $message="<span class='error'>Feilds must not be empty</span>";
             return $message;
        }else{
            $sql="SELECT * FROM patient where pno='$pno'";
            $query=$this->db->select($sql);
            if ($query !=false) {
                    $message="<span class='error'>This patient already exist</span>";
                 return $message;
                
            }else{
                $sql="INSERT INTO patient(name,address,phone,sex,dob,age,bloodgroup,disease,pno) VALUES('$name','$address','$phone','$sex','$dob','$age','$bloodgroup','$disease','$pno')";
            $query=$this->db->insert($sql);
            if ($query !=false) {
                 $message="<span class='success'>Pateint addedd successfully</span>";
                 return $message;
            }
            }
        }
    }

public function unseenmessage(){
    $sql="SELECT * FROM contact where status='0'";
    $query=$this->db->select($sql);
    if ($query !=false) {
        $unseenmessage=mysqli_num_rows($query);
        return $unseenmessage;
    }
}

public function displayMessage(){
    $sql="SELECT * from contact";
    $query=$this->db->select($sql);
    if ($query !=false) {
        return $query;
    }
}

public function getemailto($contact_id){
    $contact_id=$this->fm->validation($contact_id);
    $contact_id=mysqli_real_escape_string($this->db->link,$contact_id);
     $sql="SELECT * from contact where contact_id='$contact_id'";
    $query=$this->db->select($sql);
    if ($query !=false) {
        return $query;
    }

} 
public function replaymessageto($data,$contact_id){
     $tomesage  =$this->fm->validation($data['tomesage']);
     $frommesage=$this->fm->validation($data['frommesage']);
     $subject   =$this->fm->validation($data['subject']);
     $message   =$this->fm->validation($data['message']);
     $contact_id=$this->fm->validation($contact_id);

    $tomesage  =mysqli_real_escape_string($this->db->link,$tomesage);
    $frommesage=mysqli_real_escape_string($this->db->link,$frommesage);
    $subject   =mysqli_real_escape_string($this->db->link,$subject);
    $message   =mysqli_real_escape_string($this->db->link,$message);
    $contact_id=mysqli_real_escape_string($this->db->link,$contact_id);


    if (empty($tomesage) || empty($frommesage) || empty($subject) || empty($message)) {
        $message="<span class='error'>Feilds must not be empty</span>";
        return $message;
    }else if(!filter_var($frommesage,FILTER_VALIDATE_EMAIL)){
         $message="<span class='error'>E-mail is not valide</span>";
         return $message;
    }else{
        $sendmail=mail($tomesage, $subject, $message,$frommesage);
        if ($sendmail !=false) {
            
           $message="<span class='success'>Your replay has been successfully</span>";
           return $message;
             
        }
        $sql="UPDATE contact set status='1' where contact_id='$contact_id'";
            $query=$this->db->update($sql);
            if ($query !=false) {
                 $message="<span class='success'>Your replay has been successfully</span>";
                  return $message;
        }
    } 

}


public function deletemessage($contact_id){
      $contact_id=$this->fm->validation($contact_id);
      $contact_id=mysqli_real_escape_string($this->db->link,$contact_id);

      $sql="DELETE FROM contact where contact_id='$contact_id'";
       $query=$this->db->delete($sql);
            if ($query !=false) {
                 $message="<span class='success'>Message deleted successfully</span>";
                 return $message;
        }



}






 }

  ?>