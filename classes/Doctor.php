 <?php 

	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";

 ?>

 <?php 
 
 class Doctor
 {
 		private $db;
 		private $fm;
 	
 	function __construct()
 	{
 		$this->db=new Database();
 		$this->fm=new Format();
 	}

 	public function showDoctorProfile($username,$doctor_id){
 		$doctor_id  =$this->fm->validation($doctor_id);
 		$username   =mysqli_real_escape_string($this->db->link,$username);
 		$sql="SELECT d.*, department.department FROM doctor as d inner join department on d.department=department.department_id where doctor_id='$doctor_id' and username='$username'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}

 	}

 	public function changePass($data,$doctor_id){
		$oldpass  =$this->fm->validation($data['oldpass']);
		$newpass  =$this->fm->validation($data['newpass']);
		$doctor_id=$this->fm->validation($doctor_id);
		$doctor_id=mysqli_real_escape_string($this->db->link,$doctor_id);

		if ($oldpass=="" || $newpass=="") {
		     	$message="<span class='error'>No fields can be empty</span>";
		        return $message;
		     }else{
		     	$oldpass=mysqli_real_escape_string($this->db->link,md5($oldpass));
		     	$sql="SELECT * FROM doctor where password='$oldpass' and doctor_id='$doctor_id'";
		     	$query=$this->db->select($sql);
		     	if ($query !=false) {
		     		$newpass=mysqli_real_escape_string($this->db->link,md5($newpass));
		     		$sql="UPDATE doctor set password='$newpass' where doctor_id='$doctor_id'";
		     		$query=$this->db->update($sql);
		     		if ($query !=false) {
		     			$message="<span class='success'>Password changed successfully</span>";
		                return $message;
		     		}
		     	}else{
		     		$message="<span class='error'>Old password did not match</span>";
		           return $message;
		     	}
		     }     
		}


		public function displaydoctorforupadte($doctor_id){
				$doctor_id=$this->fm->validation($doctor_id);
				$doctor_id=mysqli_real_escape_string($this->db->link,$doctor_id);
				$sql="SELECT * FROM doctor where doctor_id='$doctor_id'";
				$query=$this->db->select($sql);
				if ($query !=false) {
					return $query;
				}
		}

		public function updateProfileInfo($data,$doctor_id){


				$name          =$this->fm->validation($data['name']);
				$email         =$this->fm->validation($data['email']);
				$address       =$this->fm->validation($data['address']);
				$phone         =$this->fm->validation($data['phone']);
				$onlinedate    =$this->fm->validation($data['onlinedate']);
				$onlinetime    =$this->fm->validation($data['onlinetime']);
				$fee           =$this->fm->validation($data['fee']);
				$doctor_id     =$this->fm->validation($doctor_id);
			    $doctorusername=$this->fm->validation($data['doctorusername']);

				$name          =mysqli_real_escape_string($this->db->link,$name);
				$email         =mysqli_real_escape_string($this->db->link,$email);
				$address       =mysqli_real_escape_string($this->db->link,$address);
				$phone         =mysqli_real_escape_string($this->db->link,$phone);
				$onlinedate    =mysqli_real_escape_string($this->db->link,$onlinedate);
				$onlinetime    =mysqli_real_escape_string($this->db->link,$onlinetime);
				$fee           =mysqli_real_escape_string($this->db->link,$fee);
				$doctor_id     =mysqli_real_escape_string($this->db->link,$doctor_id);
				$doctorusername=mysqli_real_escape_string($this->db->link,$doctorusername);



				$image         =$_FILES['image']['name'];
				$tmp_name      =$_FILES['image']['tmp_name'];
				$div           =explode('.', $image);
				$image_ext     =strtolower(end($div));
				$unique_name   =substr(md5(time()),0,10).'.'.$image_ext;
				$uploaded_image="upload/".$unique_name;

				if ($name=="" || $email=="" || $address=="" || $phone=="" ) {
					$message="<span class='error'>name, email, address phone must not be empty</span>";
		            return $message;
				}else{
					$sql="SELECT * FROM doctor where email ='$email'";
					$query=$this->db->select($sql);
					if ($query !=false) {
						$message="<span class='error'>This email already used</span>";
		                return $message;
					}else{
						$sql="SELECT * FROM appointment where doctor_id='$doctorusername'";
						$query=$this->db->select($sql);
						if ($query !=false) {
							while ($value=$query->fetch_assoc()) {
								$appointment_date=$value['appointment_date'];
								$appointment_time=$value['appointment_time'];
								if ($onlinedate== $appointment_date and $onlinetime==$appointment_time) {
									$message="<span class='error'>The time you have select is your duty time</span>";
		                            return $message;
								}else{
									if ($image !="") {
										move_uploaded_file($tmp_name, $uploaded_image);
										$sql      ="UPDATE doctor set 
										name      ='$name',
										email     ='$email',
										address   ='$address',
										phone     ='$phone',
										onlinedate='$onlinedate',
										onlinetime='$onlinetime',
										fee       ='$fee',
										image='$uploaded_image' where doctor_id='$doctor_id' and username='$doctorusername'";
										$query=$this->db->update($sql);
										if ($query !=false) {
											$message="<span class='success'>Updated successfully</span>";
		                                    return $message;
										}
									}else{
										$sql="UPDATE doctor set 
										name      ='$name',
										email     ='$email',
										address   ='$address',
										phone     ='$phone',
										onlinedate='$onlinedate',
										onlinetime='$onlinetime',
										fee       ='$fee'
										 where doctor_id='$doctor_id' and username='$doctorusername'";
										$query=$this->db->update($sql);
										if ($query !=false) {
											$message="<span class='success'>Updated successfully</span>";
		                                    return $message;
										}else{
											$message="<span class='success'>No</span>";
		                                    return $message;
										}
									}
								}
							}

						}else{

							if ($image !="") {
										move_uploaded_file($tmp_name, $uploaded_image);
										$sql      ="UPDATE doctor set 
										name      ='$name',
										email     ='$email',
										address   ='$address',
										phone     ='$phone',
										onlinedate='$onlinedate',
										onlinetime='$onlinetime',
										fee       ='$fee',
										image='$uploaded_image' where doctor_id='$doctor_id' and username='$doctorusername'";
										$query=$this->db->update($sql);
										if ($query !=false) {
											$message="<span class='success'>Updated successfully</span>";
		                                    return $message;
										}
									}else{
										$sql="UPDATE doctor set 
										name      ='$name',
										email     ='$email',
										address   ='$address',
										phone     ='$phone',
										onlinedate='$onlinedate',
										onlinetime='$onlinetime',
										fee       ='$fee'
										 where doctor_id='$doctor_id' and username='$doctorusername'";
										$query=$this->db->update($sql);
										if ($query !=false) {
											$message="<span class='success'>Updated successfully</span>";
		                                    return $message;
										}else{
											$message="<span class='success'>No</span>";
		                                    return $message;
										}
									}

						}
					}

				}
		}



public function Exteriorappointment(){
	$sql="SELECT onlineappointment.*, doctor.name from onlineappointment inner join doctor on onlineappointment.doctor_name=doctor.username";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function displaytreatment($onlineappointment_id){
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	$sql="SELECT * FROM onlineappointment where onlineappointment_id='$onlineappointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}
public function maketreatment($onlineappointment_id,$data){
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);
	$treatment          =$this->fm->validation($data['treatment']);

	$treatment           =mysqli_real_escape_string($this->db->link,$treatment);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	if ($treatment=="") {
		$message="<span class='error'>Field must not be empty</span>";
		return $message;
	}else{
		$sql="UPDATE onlineappointment set treatment='$treatment' where onlineappointment_id='$onlineappointment_id'";
		$query=$this->db->update($sql);
		if ($query !=false) {
			$sql="UPDATE onlineappointment set status='1' where onlineappointment_id='$onlineappointment_id'";
			$query=$this->db->update($sql);
			if ($query !=false) {
				$message="<span class='success'>Updated successfully</span>";
		         return $message;
			}
		}
	}


}

public function totaldoctor(){
	$sql="SELECT * FROM doctor";
	$query=$this->db->select($sql);
	if ($query !=false) {
		$totaldr=mysqli_num_rows($query);
		return $totaldr;
	}
}

public function deleteOnlineappointment($onlineappointment_id){
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	$sql="SELECT * FROM onlineappointment where onlineappointment_id='$onlineappointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		$value=$query->fetch_assoc();

		$doctorid=$value['doctor_name'];
		$pemail=$value["email"];
		$sql="INSERT INTO  backuponlineappointment(doctorid,pemail) VALUES('$doctorid','$pemail')";
		$query=$this->db->insert($sql);
		if ($query !=false) {
			$sql="DELETE FROM onlineappointment where onlineappointment_id='$onlineappointment_id'";
			$query=$this->db->delete($sql);
			if ($query !=false) {
				$message="<span class='success'>Deleted successfully</span>";
		         return $message;
			}
		}
	}

}


 }

  ?>