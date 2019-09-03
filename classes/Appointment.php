<?php 

	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";

 ?>

 <?php 
 
 class Appointment
 {
 		private $db;
 		private $fm;
 	
 	function __construct()
 	{
 		$this->db=new Database();
 		$this->fm=new Format();
 	}

 	public function selectPatient(){
 		$sql="SELECT * FROM patient where status='0'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
 	}

    public function selectdepartment(){
 		$sql="SELECT * FROM department";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
 	}

 	public function selectroomtype(){
 		$sql="SELECT * FROM roomtype where status='0'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
 	}

 	public function displayavailabledoctor($departmentid){
 		$departmentid=$this->fm->validation($departmentid);
 		$departmentid=mysqli_real_escape_string($this->db->link,$departmentid);
 		$sql="SELECT * FROM doctor where department='$departmentid' and status='0'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "<option value=".">"."Select one"."</option>";
 			while ($result=$query->fetch_assoc()) {
 				 echo "<option value=".$result['username'].">".$result['name']."</option>";
 			}	
 		}else{
 			 echo "<option value=".">"."No doctor available"."</option>";
 		}

 	}

 	public function displayavailablroom($roomtypeid){
 		$roomtypeid=$this->fm->validation($roomtypeid);
 		$roomtypeid=mysqli_real_escape_string($this->db->link,$roomtypeid);
 		$sql="SELECT * FROM room where roomtype='$roomtypeid' and status='0'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "<option value=".">"."Select one"."</option>";
 			while ($result=$query->fetch_assoc()) {

 				 echo "<option value=".$result['room_id'].">".$result['room']."</option>";
 			}	
 		}else{
 			 echo "<option value=".">"."No room available"."</option>";
 		}

 	}

 	public function displayavailablbed($roomid){
 		$roomid=$this->fm->validation($roomid);
 		$roomid=mysqli_real_escape_string($this->db->link,$roomid);
 		$sql="SELECT * FROM bed where room='$roomid' and status='0'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "<option value=".">"."Select one"."</option>";
 			while ($result=$query->fetch_assoc()) {

 				 echo "<option value=".$result['bed_id'].">".$result['bed']."</option>";
 			}	
 		}else{
 			 echo "<option value=".">"."No bed available"."</option>";
 		}

 	}
 	


 	public function displaypatientinformation($patientid){
 		$patientid=$this->fm->validation($patientid);
 		$patientid=mysqli_real_escape_string($this->db->link,$patientid);
 		$sql="SELECT * FROM patient where pno='$patientid' and status='0'";
 		$query=$this->db->select($sql);
 		$str="";
 		if ($query !=false) {
 			while ($value=$query->fetch_assoc()) {
 				$array_info=array(
 					"name" => $value['name'],
 					"disease" => $value["disease"]
 				);
 				$str= $value['name'].",".$value["disease"];
 			}
 	echo  $str;
 		}	
 	}



public function makeAppointment($data){
	$patientid      =$this->fm->validation($data['patientid']);
	$patientname    =$this->fm->validation($data['patientname']);
	$patientdisease =$this->fm->validation($data['patientdisease']);
	$departmentid   =$this->fm->validation($data['departmentid']);
	$doctorid       =$this->fm->validation($data['doctorid']);
	$roomtypeid     =$this->fm->validation($data['roomtypeid']);
	$roomid         =$this->fm->validation($data['roomid']);
	$bedid          =$this->fm->validation($data['bedid']);
	$appointmentdate=$this->fm->validation($data['appointmentdate']);
	$appointmenttime=$this->fm->validation($data['appointmenttime']);

 	$patientid      =mysqli_real_escape_string($this->db->link,$patientid);
 	$patientname    =mysqli_real_escape_string($this->db->link,$patientname);
 	$patientdisease =mysqli_real_escape_string($this->db->link,$patientdisease);
 	$departmentid   =mysqli_real_escape_string($this->db->link,$departmentid);
 	$doctorid       =mysqli_real_escape_string($this->db->link,$doctorid);
 	$roomtypeid     =mysqli_real_escape_string($this->db->link,$roomtypeid);
 	$roomid         =mysqli_real_escape_string($this->db->link,$roomid);
 	$bedid          =mysqli_real_escape_string($this->db->link,$bedid);
 	$appointmentdate=mysqli_real_escape_string($this->db->link,$appointmentdate);
 	$appointmenttime=mysqli_real_escape_string($this->db->link,$appointmenttime);

 	if ($patientid=="" || $patientname=="" || $patientdisease=="" || $departmentid=="" || $doctorid=="" || $roomtypeid=="" || $roomid=="" || $appointmentdate=="" || $appointmenttime=="") {
 		 $message="<span class='error'>No feilds must not be empty</span>";
		 return $message;	
 	}else{
 		$sql="SELECT * FROM appointment WHERE doctor_id='$doctorid' and appointment_date='$appointmentdate' and appointment_time='$appointmenttime'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			 $message="<span class='error'>The doctor already assigned at this time to another patient</span>";
		     return $message;
 		}else{
 			$sql="INSERT INTO appointment(patient_id,patient_name,doctor_id,department,roomtype,room,bed,appointment_date,appointment_time,disease)
 			VALUES('$patientid','$patientname','$doctorid','$departmentid','$roomtypeid','$roomid','$bedid','$appointmentdate','$appointmenttime','$patientdisease')";
 			$query=$this->db->insert($sql);
 			if ($query !=false) {
 				
 					$sql="UPDATE patient set status='1' where pno='$patientid'";
 				    $query=$this->db->update($sql);
 				    $sqlbed="UPDATE bed set status='1' where bed_id='$bedid'";
 				    $querybed=$this->db->update($sqlbed);
 				    if ($querybed !=false) {
 				    	 $message="<span class='success'>Appointment has beed complite successfully</span>";
		                 return $message;
 				    }
 			}
 		}
 	}

}

public function displayAppointment(){
	$sql="SELECT appointment.*,department.department,roomtype.roomtype,room.room, bed.bed from appointment 
	INNER JOIN  department ON appointment.department=department.department_id 
	INNER JOIN roomtype    ON appointment.roomtype=roomtype.roomtype_id 
	INNER JOIN room        ON appointment.room=room.room_id 
	INNER JOIN bed         on appointment.bed=bed.bed_id";

	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function displayforupdateapp($appointment_id){
	$appointment_id=$this->fm->validation($appointment_id);
	$appointment_id=mysqli_real_escape_string($this->db->link,$appointment_id);

	$sql="SELECT appointment.*,doctor.name,department.department,roomtype.roomtype,room.room, bed.bed from appointment 
	INNER JOIN  doctor ON appointment.doctor_id=doctor.username 
	INNER JOIN  department ON appointment.department=department.department_id 
	INNER JOIN roomtype    ON appointment.roomtype=roomtype.roomtype_id 
	INNER JOIN room        ON appointment.room=room.room_id 
	INNER JOIN bed         on appointment.bed=bed.bed_id where 	appointment_id='$appointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function updateAppointment($appointment_id,$data){

	$patientid      =$this->fm->validation($data['patientid']);
	$departmentid   =$this->fm->validation($data['departmentid']);
	$doctorid       =$this->fm->validation($data['doctorid']);
	$roomtypeid     =$this->fm->validation($data['roomtypeid']);
	$roomid         =$this->fm->validation($data['roomid']);
	$bedid          =$this->fm->validation($data['bedid']);
	$appointmentdate=$this->fm->validation($data['appointmentdate']);
	$appointmenttime=$this->fm->validation($data['appointmenttime']);
	$appointment_id =$this->fm->validation($appointment_id);

	$patientid      =mysqli_real_escape_string($this->db->link,$patientid);
	$departmentid   =mysqli_real_escape_string($this->db->link,$departmentid);
	$doctorid       =mysqli_real_escape_string($this->db->link,$doctorid);
	$roomtypeid     =mysqli_real_escape_string($this->db->link,$roomtypeid);
	$roomid         =mysqli_real_escape_string($this->db->link,$roomid);
	$bedid          =mysqli_real_escape_string($this->db->link,$bedid);
	$appointmentdate=mysqli_real_escape_string($this->db->link,$appointmentdate);
	$appointmenttime=mysqli_real_escape_string($this->db->link,$appointmenttime);
	$appointment_id =mysqli_real_escape_string($this->db->link,$appointment_id);

	  $oldbedid;

	if ($departmentid=="" || $doctorid=="" || $roomtypeid=="" || $roomid=="" || $bedid=="" || $appointmentdate=="" || $appointmenttime=="") {
		 $message="<span class='error'>No feilds must not be empty</span>";
		 return $message;	
	}else{
		$sql="SELECT * FROM appointment where appointment_date='$appointmentdate'and appointment_time='$appointmenttime' and doctor_id='$doctorid'";
		$query=$this->db->select($sql);
		if ($query !=false) {
			$message="<span class='error'>This doctor already assigned on another patient at this time</span>";
		    return $message;
		}else{
			$sqlbed="SELECT * FROM appointment where appointment_id='$appointment_id' and patient_id='$patientid'";
			$bedquery=$this->db->select($sqlbed);
			if ($bedquery !=false) {
				$value=$bedquery->fetch_assoc();
				$oldbedid=$value['bed'];
				
			$updateSql="UPDATE appointment set 
			department      ='$departmentid',
			doctor_id       ='$doctorid',
			roomtype        ='$roomtypeid',
			room            ='$roomid',
			bed             ='$bedid',
			appointment_date='$appointmentdate',
			appointment_time='$appointmenttime'
			where appointment_id='$appointment_id'
			 ";
			 $upquery=$this->db->update($updateSql);
			 if ($upquery !=false) {

			 	$sqloldbed="UPDATE bed set status='0' where bed_id='$oldbedid'";
			 	$querybed=$this->db->update($sqloldbed);

			 	$sqlnewbed="UPDATE bed set status='1' where bed_id='$bedid'";
 			    $querynewbed=$this->db->update($sqlnewbed);
 			    if ($querynewbed !=false) {
 			    	$message="<span class='success'>Update successfully</span>";
		            return $message;
 			    }
			  }
			}
		}
	}

   }

   public function makeprescrition($data,$appointment_id){
   		$prescription  =$this->fm->validation($data['prescription']);
   		$appointment_id=$this->fm->validation($appointment_id);

   		$prescription   =mysqli_real_escape_string($this->db->link,$prescription);
   		$appointment_id =mysqli_real_escape_string($this->db->link,$appointment_id);
   		if ($prescription =="") {
   			$message="<span class='error'>Add prescription</span>";
		    return $message;
   		}else{
   			$sql="UPDATE appointment set prescription='$prescription' where appointment_id='$appointment_id'";
   			$query=$this->db->update($sql);
   			if ($query !=false) {

   				$sql="UPDATE appointment set status='1' where appointment_id='$appointment_id'";
   				$query=$this->db->update($sql);
   				if ($query !=false) {
   					$message="<span class='success'>Prescription added successfully</span>";
		            return $message;
   				}
   				
   			}
   		}

   }

public function viewprescription($appointment_id){
	$appointment_id =$this->fm->validation($appointment_id);
	$appointment_id =mysqli_real_escape_string($this->db->link,$appointment_id);
	$sql="SELECT * FROM appointment where appointment_id ='$appointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function calculatcharge($appointment_id){
	$appointment_id =$this->fm->validation($appointment_id);
	$appointment_id =mysqli_real_escape_string($this->db->link,$appointment_id);

	$sql="SELECT appointment.*,roomtype.*, room.room, bed.bed from appointment 
	inner join roomtype on appointment.roomtype=roomtype.roomtype_id
	inner join room on appointment.room=room.room_id
	inner join bed on appointment.bed=bed.bed_id where appointment_id='$appointment_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}









}






