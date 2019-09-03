<?php include_once "file/header.php" ?>
 <div class="main">
    <div class="content">
    	<div class="section group">

				<div class="cont-desc span_1_of_2">
					<?php 
							if (isset($_GET["doctor_id"]) AND $_GET["doctor_id"] !=NULL) {
								$doctor_id=$_GET["doctor_id"];
							}else{
								echo "<script>window.location='index.php'</script>";
							}
					 ?>
				<?php 
						$result=$fondpage->displayDoctorfondpage($doctor_id);
						if ($result !=false) {
							while ($value=$result->fetch_assoc()) {
					
				 ?>
				<div class="grid images_3_of_2">
					<img src="<?php echo "admin/".$value['image'] ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">

					<h2 class="textColor"><?php echo $value['qualification'].", ".$value['name'] ?></h2>
					<p></p>					
					<div class="price">
						<p>Title<span class="textColor"><?php echo $value['title'] ?></span></p>
						<p>Department<span class="textColor"><?php echo $value['department'] ?></span></p>
						<p>Consultency Fee <span class="textColor"><?php echo $value['fee'] ?></span></p>

						<p>
						<?php  
							if ($value['onlinetime']!="" and $value['onlinedate']!="") {
							if ($value['onlinetime']>='12') {
								echo "Time :".$value['onlinetime']." PM"."<br/>";
							}else{
								echo "Time :".$value['onlinetime']." AM"."<br/>";
							}
							echo "Date :".$value['onlinedate'];
							echo "<p>"."<a href='exteriorappointment.php'>Make appointment</a>"."</p>";
						}else{

							echo"<span style='red'>The doctor is not available for online treatment</span>";
						}
						?>
							
						</p>
					</div>
			</div>
			<?php }} ?>

			<div class="product-desc">
			<h2> Education background History</h2>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
	    </div>

				
	</div>
		<div class="rightsidebar span_3_of_1">
			<h2>Departments</h2>
			<ul>
				<?php 
						$result=$fondpage->displayAllDepartment();
						if ($result !=false) {
							while ($value=$result->fetch_assoc()) {
				 ?>
		      <li><a href="doctorbyspecilist.php?department_id=<?php echo $value['department_id'] ?>"><?php echo $value['department'] ?></a></li>
		      <?php } }?>
		      
			</ul>

			</div>
 		</div>
 	</div>
	</div>


   <?php include_once "file/footer.php" ?>