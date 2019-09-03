<?php 

	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";

 ?>

 <?php 
 
 class Patient
 {
 		private $db;
 		private $fm;
 	
 	function __construct()
 	{
 		$this->db=new Database();
 		$this->fm=new Format();
 	}
 	
public function DisplayPatient(){
	$sql="SELECT * FROM patient";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function deletePatient($patient_id){
	$patient_id=$this->fm->validation($patient_id);
	$Patient_id=mysqli_real_escape_string($this->db->link,$patient_id);
	$sql="DELETE FROM patient where patient_id='$patient_id'";
	$query=$this->db->delete($sql);
	if ($query !=false) {
		$message="<span class='success'>This patient has been deleted successfully</span>";
		return $message;
	}
}


public function displaypatientforUpdate($patient_id){
	$patient_id=$this->fm->validation($patient_id);
    $patient_id=mysqli_real_escape_string($this->db->link,$patient_id);
	$sql="SELECT * FROM patient where 	patient_id='$patient_id'";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function updatePatient($data,$patient_id){
	  $patient_id=$this->fm->validation($patient_id);
    $patient_id=mysqli_real_escape_string($this->db->link,$patient_id);

    $name      =$this->fm->validation($data["name"]);
    $address   =$this->fm->validation($data["address"]);
    $phone     =$this->fm->validation($data["phone"]);
    $sex       =$this->fm->validation($data["sex"]);
    $dob       =$this->fm->validation($data["dob"]);
    $bloodgroup=$this->fm->validation($data["bloodgroup"]);
    $disease   =$this->fm->validation($data["disease"]);
    $pno       =$this->fm->validation($data["pno"]);

    $name      =mysqli_real_escape_string($this->db->link,$name);
    $address   =mysqli_real_escape_string($this->db->link,$address);
    $phone     =mysqli_real_escape_string($this->db->link,$phone);
    $sex       =mysqli_real_escape_string($this->db->link,$sex);
    $dob       =mysqli_real_escape_string($this->db->link,$dob);
    $bloodgroup=mysqli_real_escape_string($this->db->link,$bloodgroup);
    $disease   =mysqli_real_escape_string($this->db->link,$disease);
    $pno       =mysqli_real_escape_string($this->db->link,$pno);

        $newdob= new DateTime($dob);
        $nowDate=new DateTime();
        $difference = $nowDate->diff($newdob);
        $age=$difference->y;


   if ($name=="" || $address=="" || $phone=="" || $sex=="" || $dob=="" || $bloodgroup==""  || $disease=="" || $pno=="") {
   		$message="<span class='error'>Fields must not be empty</span>";
		  return $message;
   }else{
   		$sql="UPDATE patient set 
   		name      ='$name',
   		address   ='$address',
   		phone     ='$phone',
   		sex       ='$sex',
   		dob       ='$dob',
      age       ='$age',
   		bloodgroup='$bloodgroup',
   		disease   ='$disease',
   		pno='$pno' where patient_id='$patient_id' and pno='$pno'";
   		$query=$this->db->update($sql);
   		if ($query !=false) {
   			$message="<span class='success'>Updated successfully</span>";
		    return $message;
   		}
   }

}


public function makeInvoice($data,$appointment_id){

    $strartdate     =$this->fm->validation($data['strartdate']);
    $dischargedate  =$this->fm->validation($data['dischargedate']);
    $totalday       =$this->fm->validation($data['totalday']);
    $totalcharge    =$this->fm->validation($data['totalcharge']);
    $extracharge    =$this->fm->validation($data['extracharge']);
    $patientid      =$this->fm->validation($data['patientid']);
    $doctorid       =$this->fm->validation($data['doctorid']);
    $roomtype       =$this->fm->validation($data['roomtype']);
    $room           =$this->fm->validation($data['room']);
    $bed            =$this->fm->validation($data['bed']);
    $appointment_id =$this->fm->validation($appointment_id);



    $startdate     =mysqli_real_escape_string($this->db->link,$strartdate);
    $dischargedate =mysqli_real_escape_string($this->db->link,$dischargedate);
    $totalday      =mysqli_real_escape_string($this->db->link,$totalday);
    $totalcharge   =mysqli_real_escape_string($this->db->link,$totalcharge);
    $extracharge   =mysqli_real_escape_string($this->db->link,$extracharge);
    $patientid     =mysqli_real_escape_string($this->db->link,$patientid);
    $doctorid      =mysqli_real_escape_string($this->db->link,$doctorid);
    $roomtype      =mysqli_real_escape_string($this->db->link,$roomtype);
    $room          =mysqli_real_escape_string($this->db->link,$room);
    $bed           =mysqli_real_escape_string($this->db->link,$bed);
    $appointment_id=mysqli_real_escape_string($this->db->link,$appointment_id);

   

    if ($patientid=="" || $doctorid=="" || $roomtype=="" || $room=="" || $bed=="" || $totalcharge=="" || $startdate=="" || $dischargedate=="" || $totalday=="" || $extracharge=="" || $appointment_id=="") {
        $message="<span class='error'>Fields must not be empty</span>";
        return $message;
    }else{

      $sql="SELECT * FROM invoice where patientid='$patientid'";
      $query=$this->db->select($sql);
      if ($query !=false) {
        $message="<span class='error'>Already exists</span>";
        return $message;
      }else{
         $sql="SELECT * FROM appointment where appointment_id='$appointment_id'";
         $query=$this->db->select($sql);
         if ($query !=false) {
           $value=$query->fetch_assoc();
           $pname=$value['patient_name'];
             $sql="INSERT INTO invoice (patientid,pname,doctorid,roomtype,room,bed,totalcost,extracost,startdate,enddate,days,appointment_id) 
            VALUES
         ('$patientid','$pname','$doctorid','$roomtype','$room','$bed','$totalcharge','$extracharge','$startdate','$dischargedate','$totalday','$appointment_id')";
           $query=$this->db->insert($sql);
            if ($query !=false) {
            $message="<span class='success'>Proccessing...</span>";
            return $message;
            }
         }
      }
      
    }

}

public function displayinvoiceInfo($appointment_id){
  $appointment_id=$this->fm->validation($appointment_id);
  $appointment_id=mysqli_real_escape_string($this->db->link,$appointment_id);
  $sql="SELECT invoice.*, patient.*, doctor.* from invoice 
  inner join patient on invoice.patientid=patient.pno 
  inner join doctor on invoice.doctorid=doctor.username where appointment_id='$appointment_id'";
  $query=$this->db->select($sql);
  if ($query !=false) {
     $sql="SELECT * FROM appointment where appointment_id='$appointment_id'";
     $appointmentquery=$this->db->select($sql);
     if ($appointmentquery !=false) {
       $value    =$appointmentquery->fetch_assoc();
       $bed_id   =$value['bed'];
       $patientid=$value['patient_id'];
        $sql="UPDATE bed set status='0' where bed_id='$bed_id'";
        $upadequery=$this->db->update($sql);
        if ($upadequery !=false) {
          $sql="DELETE from appointment where appointment_id='$appointment_id'";
          $deletequery=$this->db->delete($sql);
          if ($deletequery !=false) {
            $sqlp="DELETE from patient where pno='$patientid'";
            $deletequeryp=$this->db->delete($sqlp);
          }
        }
       
     }
     return $query;
  }
}


public function taotalenrrolledpatient(){
  $sql="SELECT * FROM invoice";
  $query=$this->db->select($sql);
  if ($query !=false) {
    $totalenrolled=mysqli_num_rows($query);
    return $totalenrolled;
  }
}

public function taotalcurrent(){
  $sql="SELECT * FROM patient";
  $query=$this->db->select($sql);
  if ($query !=false) {
    $totalcurrent=mysqli_num_rows($query);
    return $totalcurrent;
  }
}

public function invoicelistdisplay(){
  $sql="SELECT * FROM invoice";
  $query=$this->db->select($sql);
  if ($query !=false) {
    return $query;
  }
}


public function makeinvoiceshheet($invoice_id){
   $invoice_id =$this->fm->validation($invoice_id);
   $invoice_id=mysqli_real_escape_string($this->db->link,$invoice_id);
 $sql="SELECT invoice.*, doctor.* from invoice 
  inner join doctor on invoice.doctorid=doctor.username where invoice_id='$invoice_id'";
    $query=$this->db->select($sql);
    if ($query !=false) {
      return $query;
    }


}








 }


  ?>