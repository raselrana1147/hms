<?php include_once "file/header.php" ?>
 <div class="main">

 <div class="container">
  <div class="row">
    <div class="col-sm-3">
     <img src="images/pi.jpg" class="img-fluid img-thumbnail">
    </div>
    <div class="col-sm-6">
    	<?php 

			if ($_SERVER["REQUEST_METHOD"]=="POST") {
				$result=$fondpage->makeAppointment($_POST);
				if ($result !=false) {
					echo $result;;
				}
			}
      ?>
      <div class="onlineappointment">
	      <form action="" method="post">
	      	  <div class="form-group">
			    <label for="doctorname">Doctor name:</label>
			    <select class="form-control" id="doctorname" name="doctorname">
			       <option value="">Select one</option>
			       <?php 
			       		$result=$fondpage->selectDoctor();
			       		if ($result !=false) {
			       			while ($value=$result->fetch_assoc()) {	
			        ?>
			         <option value="<?php echo $value['username'] ?>"><?php echo $value['name'] ?></option>
			         <?php }} ?>
			     </select>
	           </div>
	           <div class="form-group">
	           		<label for="pname">Patient name:</label>
	           		<input type="text" class="form-control" name="pname" id="pname" placeholder="Patient name">
	           </div>
	           <div class="form-group">
	           		<label for="pemail">Patient email:</label>
	           		<input type="text" class="form-control" name="pemail" id="pemail" placeholder="Patient email">
	           </div>
	           <div class="form-group">
	           		<label for="pemail">Patient age:</label>
	           		<input type="number" class="form-control" name="page" id="page" placeholder="Patient age">
	           </div>
	           	<label for="psex">Gender:</label>
	           <div class="form-check form-check-inline">
	           		<input type="radio" class="form-check-input" name="psex" id="psex" value="Male" checked="1">Male
	           </div>
	           <div class="form-check form-check-inline">
	           		<input type="radio" class="form-check-input" name="psex" id="psex" value="Female">Female
	           </div>
	           <div class="form-group">
	           		<label for="description">Disease description:</label>
	           		<textarea class="form-control" rows="4" placeholder="Write here..." name="description"></textarea>
	           </div>
	            <input type="submit" name="submit" value="Make appointment" class="btn buttonbac">
	      </form>
       </div>
    </div>
    <div class="col-3">
       
    </div>
  </div>
</div>

</div>


 <?php include_once "file/footer.php" ?>