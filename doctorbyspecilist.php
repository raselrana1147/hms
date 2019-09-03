<?php include_once "file/header.php" ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Specilization doctors</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      		if (isset($_GET['department_id']) AND $_GET['department_id'] !=NULL) {
	      			$department_id=$_GET['department_id'];	
	      		}else{
	      			echo "<script>window.location='index.php'</script>";
	      		}
	      	 ?>
	      	 <?php 

	      	 		$result=$fondpage->dispplayDoctorBydep($department_id);
	      			if ($result !=false) {
	      				while ($value=$result->fetch_assoc()) {
	      					
	      	  ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="doctorprofile.php?doctor_id=<?php echo $value['doctor_id'] ?>"><img src="<?php echo 'admin/'.$value['image'] ?>" alt="" style="width: 100%; height: 230px"/></a>
					 <h2><?php echo $value['name'] ?> </h2>
				     <div class="button"><span><a href="doctorprofile.php?doctor_id=<?php echo $value['doctor_id'] ?>" class="details">Profile</a></span></div>
				</div>
				<?php }}else{ ?>
					<span style="color: red">No doctor are available for this department</span>
				<?php } ?>
			</div>
    </div>
 </div>

<?php include_once "file/footer.php" ?>