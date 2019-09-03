<?php 

	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";
 ?>
<?php 
class FondPage
{
		private $db;
		private $fm;
	
	function __construct()
	{
		$this->db=new Database();
		$this->fm=new Format();
		
	}


	public function displayDepartment($start_from,$per_page){
		$sql="SELECT * FROM department limit $start_from,$per_page";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
	}


	public function displayAllDepartment(){
		$sql="SELECT * FROM department ";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
	}



	public function displayDoctor($start_from_doctor,$per_page_doctor){
		$sql="SELECT * FROM doctor where status='0' limit $start_from_doctor,$per_page_doctor";
		$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
	}
public function displayDoctorfondpage($doctor_id){
	$doctor_id=$this->fm->validation($doctor_id);
	$doctor_id=mysqli_real_escape_string($this->db->link,$doctor_id);

	$sql="SELECT doctor.*, department.department FROM doctor INNER JOIN department ON doctor.department=department.department_id WHERE doctor_id='$doctor_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function dispplayDoctorBydep($department_id){
	$department_id=$this->fm->validation($department_id);
	$department_id=mysqli_real_escape_string($this->db->link,$department_id);

	$sql="SELECT * FROM doctor WHERE department='$department_id' and status='0'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}


public function selectDoctor(){
	$sql="SELECT * FROM doctor where onlinedate !='' and onlinetime!='' ";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function makeAppointment($data){
	$doctorname =$this->fm->validation($data['doctorname']);
	$pname      =$this->fm->validation($data['pname']);
	$pemail     =$this->fm->validation($data['pemail']);
	$page       =$this->fm->validation($data['page']);
	$psex       =$this->fm->validation($data['psex']);
	$description=$this->fm->validation($data['description']);

	$doctorname =mysqli_real_escape_string($this->db->link,$doctorname);
	$pname      =mysqli_real_escape_string($this->db->link,$pname);
	$pemail     =mysqli_real_escape_string($this->db->link,$pemail);
	$page       =mysqli_real_escape_string($this->db->link,$page);
	$psex       =mysqli_real_escape_string($this->db->link,$psex);
	$description=mysqli_real_escape_string($this->db->link,$description);

	if ($doctorname=="" || $pname=="" || $pemail=="" || $page=="" || $psex=="" || $description=="") {
		$message="<span class='error'>No fields can be empty</span>";
		return $message;
	}else if(!filter_var($pemail,FILTER_VALIDATE_EMAIL)){
		$message="<span class='error'>E-mail is not validate</span>";
		return $message;
	}else{
		$sql="SELECT * FROM onlineappointment where email='$pemail'";
		$query=$this->db->select($sql);
		if ($query !=false) {
			$message="<span class='error'>This email already exist</span>";
		     return $message;
		}else{
			$sql="INSERT INTO onlineappointment(doctor_name,pname,email,age,sex,description)
			VALUES
			('$doctorname','$pname','$pemail','$page','$psex','$description')";
			$query=$this->db->insert($sql);
			if ($query !=false) {
				$message="<span class='success'>Appointment has made successfully</span>";
		        return $message;
			}
		}
	}
}

public function patientlogin($data){
	$pemail=$this->fm->validation($data['pemail']);
	$pemail=mysqli_real_escape_string($this->db->link,$pemail);

	if ($pemail=="") {
		$message="<span class='error'>Fields must not be empty</span>";
		 return $message;
	}else{
		$sql="SELECT * FROM onlineappointment where email='$pemail'";
		$query=$this->db->select($sql);
		if ($query !=false) {
			$value=$query->fetch_assoc();
			Sessiontwo::set("login",true);
			Sessiontwo::set("email",$value['email']);
			Sessiontwo::set("name",$value['name']);
			Sessiontwo::set("onlineappointment_id",$value['onlineappointment_id']);
			header("location:profile.php");
		}else{
			$message="<span class='error'>Your email is wrong</span>";
		    return $message;
		}
	}

}



public function selectpatient($Sessionemail){
	$Sessionemail=$this->fm->validation($Sessionemail);
	$Sessionemail=mysqli_real_escape_string($this->db->link,$Sessionemail);
	$sql="SELECT onlineappointment.*, doctor.name from onlineappointment inner join doctor 
	on  
	onlineappointment.doctor_name=doctor.username where onlineappointment.email='$Sessionemail'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function displayinfo($onlineappointment_id){
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	$sql="SELECT * FROM  onlineappointment where onlineappointment_id='$onlineappointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function updatepatientInfo($onlineappointment_id,$data){
    $doctorname          =$this->fm->validation($data['doctorname']);
	$pname               =$this->fm->validation($data['pname']);
	$pemail              =$this->fm->validation($data['pemail']);
	$page                =$this->fm->validation($data['page']);
	$psex                =$this->fm->validation($data['psex']);
	$description         =$this->fm->validation($data['description']);
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);

	$doctorname          =mysqli_real_escape_string($this->db->link,$doctorname);
	$pname               =mysqli_real_escape_string($this->db->link,$pname);
	$pemail              =mysqli_real_escape_string($this->db->link,$pemail);
	$page                =mysqli_real_escape_string($this->db->link,$page);
	$psex                =mysqli_real_escape_string($this->db->link,$psex);
	$description         =mysqli_real_escape_string($this->db->link,$description);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	if ($doctorname=="" || $pname=="" || $pemail=="" || $page=="" || $psex=="" || $description=="") {
		$message="<span class='error'>Fields must not be empty</span>";
		 return $message;
	}else if(!filter_var($pemail,FILTER_VALIDATE_EMAIL)){
		$message="<span class='error'>E-mail is not validate</span>";
		return $message;
	}else{
		$sql="UPDATE onlineappointment set 
		doctor_name='$doctorname', 
		pname      ='$pname', 
		email      ='$pemail',
		age        ='$page',
		sex        ='$psex', 
		description='$description' 
		where 
		onlineappointment_id='$onlineappointment_id'";
		$query=$this->db->update($sql);
		if ($query !=false) {
			$message="<span class='success'>Updated successfully</span>";
		    return $message;
		}
	}

} 


public function confirmTreatment($onlineappointment_id){
	$onlineappointment_id=$this->fm->validation($onlineappointment_id);
	$onlineappointment_id=mysqli_real_escape_string($this->db->link,$onlineappointment_id);
	$sql="UPDATE onlineappointment set status='2' where onlineappointment_id='$onlineappointment_id'";
	$query=$this->db->update($sql);
	if ($query !=false) {
		$message="<span class='success'>I have received treatment successfully</span>";
		return $message;
	}

}



public function getTotalowfromdepartment(){
	$sql="SELECT * FROM department";
	$query=$this->db->select($sql);
	if ($query !=false) {
		$num=mysqli_num_rows($query);
		return $num;
	}
}


public function getTotaldoctor(){
	$sql="SELECT * FROM doctor";
	$query=$this->db->select($sql);
	if ($query !=false) {
		$num=mysqli_num_rows($query);
		return $num;
	}
}
public function contact($data){
	$name   =$this->fm->validation($data['name']);
	$email  =$this->fm->validation($data['email']);
	$message=$this->fm->validation($data['message']);

	$name   =mysqli_real_escape_string($this->db->link,$name);
	$email  =mysqli_real_escape_string($this->db->link,$email);
	$message=mysqli_real_escape_string($this->db->link,$message);
	if ($name=="" || $email=="" || $message=="") {
		$message="<span class='error'>Fields must not be empty</span>";
		return $message;
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$message="<span class='error'>E-mail is not validate</span>";
	    return $message;
	}else{
		$sql="INSERT INTO contact(name,email,message) VALUES('$name','$email','$message')";
		$query=$this->db->insert($sql);
		if ($query !=false) {
				$message="<span class='success'>Your message has been send successfully</span>";
	             return $message;
		}
	}

}




}



 ?>

 