<?php include_once "file/header.php" ?>
 <div class="main">
<?php 
		if (isset($_GET['onlineappointment_id']) and $_GET['onlineappointment_id'] !=NULL) {
			$onlineappointment_id=$_GET['onlineappointment_id'];
		}else{
			echo "<script>window.location='profile.php'</script>";
		}
 ?>
 <?php 

 	if ($_SERVER["REQUEST_METHOD"]=="POST") {
 		$resultupdate=$fondpage->updatepatientInfo($onlineappointment_id,$_POST);
 		if ($resultupdate !=false) {
 			echo $resultupdate;
 		}
 	}
  ?>

 <div class="container">
  <div class="row">
    <div class="col-sm-3">
     <img src="images/pi.jpg" class="img-fluid img-thumbnail">
    </div>
    <div class="col-sm-6"> 
      <div class="onlineappointment">
	      <form action="" method="post">
	      	<?php 
  				$resultone=$fondpage->displayinfo($onlineappointment_id);
  				if ($resultone !=false) {
  					while ($valueone=$resultone->fetch_assoc()) {
	      	 ?>
	      	  <div class="form-group">
			    <label for="doctorname">Doctor name:</label>
			    <select class="form-control" id="doctorname" name="doctorname">
			       <option value="">Select one</option>
			       <?php 
			       		$result=$fondpage->selectDoctor();
			       		if ($result !=false) {
			       			while ($value=$result->fetch_assoc()) {
			        ?>
			         <option 
			         	<?php 
			         		if ($valueone['doctor_name']==$value['username']) {	
			         	 ?>
			         	 selected="selected";
                      <?php } ?>
			         value="<?php echo  $value['username'] ?>"><?php echo $value['name'] ?></option>
			         <?php }} ?>
			     </select>
	           </div>
	           <div class="form-group">
	           		<label for="pname">Patient name:</label>
	           		<input type="text" class="form-control" name="pname" id="pname" value="<?php echo $valueone['pname'] ?>">
	           </div>
	           <div class="form-group">
	           		<label for="pemail">Patient email:</label>
	           		<input type="text" class="form-control" name="pemail" id="pemail" value="<?php echo $valueone['email'] ?>">
	           </div>
	           <div class="form-group">
	           		<label for="pemail">Patient age:</label>
	           		<input type="number" class="form-control" name="page" id="page" value="<?php echo $valueone['age'] ?>">
	           </div>
	           	<label for="psex">Sex:</label>
	           <div class="form-check form-check-inline">
	           		<input 
	           			<?php 
	           				if ($valueone['sex']=="Male") {	
	           			 ?>
	           			 checked="1";
	           			 <?php }?>
	           		type="radio" class="form-check-input" name="psex" id="psex" value="Male" >Male
	           </div>
	           <div class="form-check form-check-inline">
	           		<input 
	           			<?php 
	           				if ($valueone['sex']=="Female") {
	           			 ?>
	           			 checked="1";
	           			 <?php } ?>
	           		type="radio" class="form-check-input" name="psex" id="psex" value="Female">Female
	           </div>
	           <div class="form-group">
	           		<label for="description">Disease description:</label>
	           		<textarea class="form-control" rows="4" name="description">
	           			<?php echo $valueone['description'] ?>
	           		</textarea>
	           </div>
	            <input type="submit" name="submit" value="Update appointment" class="btn buttonbac">
	            <?php }} ?>
	      </form>
       </div>
    </div>
    <div class="col-3">
       
    </div>
  </div>
</div>

</div>


 <?php include_once "file/footer.php" ?>