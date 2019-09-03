<?php 

	$realpath=realpath(dirname(__FILE__));
	include_once $realpath."/../lib/Database.php";
	include_once $realpath."/../helper/Format.php";

 ?>

 <?php 
 
 class Room
 {
 		private $db;
 		private $fm;
 	
 	function __construct()
 	{
 		$this->db=new Database();
 		$this->fm=new Format();
 	}


 	public function addroomtype($data){
 		$roomtype=$this->fm->validation($data["roomtype"]);
 		$cost    =$this->fm->validation($data["cost"]);
 		$roomtype=mysqli_real_escape_string($this->db->link,$roomtype);
 		$cost    =mysqli_real_escape_string($this->db->link,$cost);

 		if ($roomtype=="" || $cost=="") {
 			$message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 		}else{
 			$sql="SELECT * FROM roomtype where roomtype='$roomtype'";
 			$query=$this->db->select($sql);
 			if ($query !=false) {
 				$message="<span class='error'>This room type already exist</span>";
		        return $message;
 			}else{
 				$sql="INSERT INTO roomtype (roomtype,cost) VALUES('$roomtype','$cost')";
 				$query=$this->db->insert($sql);
 				if ($query !=false) {
 					$message="<span class='success'>Room type added successfully</span>";
		            return $message;
 				}
 			}
 		}

 	}

 	public function checkeroomtype($roomtype){
 		$cost    =$this->fm->validation($roomtype);
 		$roomtype=mysqli_real_escape_string($this->db->link,$roomtype);
 		$sql="SELECT * FROM roomtype where roomtype='$roomtype'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "This room type already exist";
 		}
 	}

 	public function selectroomtype(){
 		$sql="SELECT * FROM roomtype";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
 	}

public function checkeroom($roomtype,$roomc){
	    $roomc   =$this->fm->validation($roomc);
 		$roomtype=$this->fm->validation($roomtype);
 		$roomc   =mysqli_real_escape_string($this->db->link,$roomc);
 		$roomtype=mysqli_real_escape_string($this->db->link,$roomtype);

 		$sql="SELECT * FROM room where room='$roomc' and roomtype='$roomtype'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "The $roomc already exist in this type";
 		}

}



 	public function addroomt($data){
 		$room    =$this->fm->validation($data["room"]);
 		$roomtype=$this->fm->validation($data["roomtype"]);
 		$room    =mysqli_real_escape_string($this->db->link,$room);
 		$roomtype=mysqli_real_escape_string($this->db->link,$roomtype);
 		if ($room=="" || $roomtype=="") {
 			$message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 		}else{
 			$sql="SELECT * FROM room where room='$room' and roomtype='$roomtype'";
 			$query=$this->db->select($sql);
 			if ($query !=false) {
 				$message="<span class='error'>The $room  already existed in this type</span>";
		        return $message;
 			}else{
 				$sql="INSERT INTO room (room,roomtype) VALUES('$room','$roomtype')";
 				$query=$this->db->insert($sql);
 				if ($query !=false) {
 					$message="<span class='success'>Room added successfully</span>";
		            return $message;
 				}
 			}
 		}

 	}

public function selectroom(){
	$sql="SELECT room.*,roomtype.roomtype from room inner join roomtype on room.roomtype=roomtype.roomtype_id";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			return $query;
 		}
}


public function checkbed($bed,$roomc){
	    $bed  =$this->fm->validation($bed);
 		$roomc=$this->fm->validation($roomc);
 		$bed  =mysqli_real_escape_string($this->db->link,$bed);
 		$roomc=mysqli_real_escape_string($this->db->link,$roomc);

 		$sql="SELECT * FROM bed where bed='$bed' and room='$roomc'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			echo "The $bed already exist in this room";
 		}

}




public function addBed($data){
	    $bed =$this->fm->validation($data["bed"]);
 		$room=$this->fm->validation($data["room"]);
 		$bed =mysqli_real_escape_string($this->db->link,$bed);
 		$room=mysqli_real_escape_string($this->db->link,$room);
 		if ($bed=="" || $bed=="") {
 			$message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 		}else{
 			$sql="SELECT * FROM bed where bed='$bed' and room='$room'";
 			$query=$this->db->select($sql);
 			if ($query !=false) {
 				 $message="<span class='error'>The $bed is already exist in this room</span>";
		         return $message;
 			}else{
 				$sql="INSERT into bed(bed,room) VALUES('$bed','$room')";
 				$query=$this->db->insert($sql);
 				if ($query !=false) {
 					$message="<span class='success'>Bed addedd successfully</span>";
		            return $message;
 				}
 			}
 		}
}


public function displayRoomtype(){
	$sql="SELECT * FROM roomtype";
	$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
}

public function deleteRoomtype($roomtype_id){
	$roomtype_id=$this->fm->validation($roomtype_id);
 	$roomtype_id=mysqli_real_escape_string($this->db->link,$roomtype_id);
 	$sql="DELETE FROM roomtype where roomtype_id='$roomtype_id'";
 	$query=$this->db->delete($sql);
 	if ($query !=false) {
 		$message="<span class='success'>Deleted successfully</span>";
		return $message;
 	}
}

public function showRoomtypeinfo($roomtype_id){
	$roomtype_id=$this->fm->validation($roomtype_id);
 	$roomtype_id=mysqli_real_escape_string($this->db->link,$roomtype_id);
 	$sql="SELECT * FROM roomtype where roomtype_id='$roomtype_id'";
 	$query=$this->db->select($sql);
 	if ($query !=false) {
 		return $query;
 	}
}

public function updateroomtype($data,$roomtype_id){
	$roomtype   =$this->fm->validation($data['roomtype']);
	$cost       =$this->fm->validation($data['cost']);
	$roomtype_id=$this->fm->validation($roomtype_id);
	$roomtype   =mysqli_real_escape_string($this->db->link,$roomtype);
	$cost       =mysqli_real_escape_string($this->db->link,$cost);
 	$roomtype_id=mysqli_real_escape_string($this->db->link,$roomtype_id);
 	if ($roomtype=="" || $cost=="") {
 		$message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 	}else{
 		$sql="UPDATE roomtype set roomtype='$roomtype', cost='$cost' where roomtype_id='$roomtype_id'";
 		$query=$this->db->update($sql);
 		if ($query !=false) {
 			$message="<span class='success'>Updated successfully</span>";
		    return $message;
 		}
 	}
}

public function displayRoom(){
	$sql="SELECT r.*,rt.roomtype FROM room AS r INNER JOIN roomtype AS rt ON r.roomtype=rt.roomtype_id";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}
}

public function deleteRoom($room_id){
	$room_id=$this->fm->validation($room_id);
 	$room_id=mysqli_real_escape_string($this->db->link,$room_id);
 	$sql="DELETE FROM room where room_id='$room_id'";
 	$query=$this->db->delete($sql);
 	if ($query !=false) {
 		$message="<span class='success'>Deleted successfully</span>";
		return $message;
 	}
}

public function showRoominfo($room_id){
	$room_id=$this->fm->validation($room_id);
 	$room_id=mysqli_real_escape_string($this->db->link,$room_id);
 	$sql="SELECT * FROM room where room_id='$room_id'";
	$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}

}

public function updateroom($data,$room_id){
	$room    =$this->fm->validation($data['room']);
	$roomtype=$this->fm->validation($data['roomtype']);
	$room_id =$this->fm->validation($room_id);
	$room    =mysqli_real_escape_string($this->db->link,$room);
	$roomtype=mysqli_real_escape_string($this->db->link,$roomtype);
 	$room_id =mysqli_real_escape_string($this->db->link,$room_id);
 	if ($room=="" || $roomtype=="") {
 		    $message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 	}else{
 		$sql="SELECT * FROM room where room='$room' and roomtype='$roomtype'";
 		$query=$this->db->select($sql);
 		if ($query !=false) {
 			$message="<span class='error'>The $room is already exist in this type</span>";
		    return $message;
 		}else{
 			$sql="UPDATE room set room='$room', roomtype='$roomtype' where room_id='$room_id'";
 		$query=$this->db->update($sql);
 		if ($query !=false) {
 			$message="<span class='success'>Updated successfully</span>";
		    return $message;
 		}
 		}
 	}
}

public function displayBed(){
	$sql="SELECT bed.*, room.room, roomtype.roomtype from bed inner join room on bed.room=room.room_id inner join roomtype on room.roomtype=roomtype.roomtype_id";
	$query=$this->db->select($sql);
	if ($query !=false) {
		return $query;
	}

}

public function deleteBed($bed_id){
	$bed_id=$this->fm->validation($bed_id);
 	$bed_id=mysqli_real_escape_string($this->db->link,$bed_id);
 	$sql="DELETE FROM bed where bed_id='$bed_id'";
 	$query=$this->db->delete($sql);
 	if ($query !=false) {
 		$message="<span class='success'>Deleted successfully</span>";
		return $message;
 	}
}
public function showBedinfo($bed_id){
	$bed_id=$this->fm->validation($bed_id);
 	$bed_id=mysqli_real_escape_string($this->db->link,$bed_id);
 	$sql="SELECT * FROM bed where bed_id='$bed_id'";
	$query=$this->db->select($sql);
		if ($query !=false) {
			return $query;
		}
}

public function updatebed($data,$bed_id){
	$bed   =$this->fm->validation($data['bed']);
	$room  =$this->fm->validation($data['room']);
	$bed_id=$this->fm->validation($bed_id);
	$bed   =mysqli_real_escape_string($this->db->link,$bed);
	$room  =mysqli_real_escape_string($this->db->link,$room);
 	$bed_id=mysqli_real_escape_string($this->db->link,$bed_id);
 	if ($bed=="" || $room=="") {
 		    $message="<span class='error'>Fields must not be empty</span>";
		    return $message;
 	  }else{
 	  	$sql="SELECT * FROM bed where bed='$bed' and room='$room'";
 	  	$query=$this->db->select($sql);
 	  	if ($query !=false) {
 	  		$message="<span class='error'>The $bed is already exist in this room</span>";
		    return $message;
 	  	}else{
 	  		$sql="UPDATE bed set bed='$bed', room='$room' where bed_id='$bed_id'";
 	  		$query=$this->db->update($sql);
 	  		if ($query !=false) {
 	  			 $message="<span class='success'>Updated successfully</span>";
		        return $message;
 	  		}
 	  	}
 	  }

}







}