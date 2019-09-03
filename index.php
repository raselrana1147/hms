<?php include_once "file/header.php" ?>
<?php include_once "file/slider.php" ?>
  

 <div class="main">
    <div class="content">
    	<div class="about">
    		<h2>About Galaxy Hospital</h2>
    		<div class="row">
    			<div class="col-md-8">
    				<div id="readmorecontent">
	    				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.	
				   </div>
    			</div>
    			

    			<div class="col-md-4">
    				<div class="vedio">
    					<iframe width="300" height="315" src="https://www.youtube.com/embed/gdm_W8CIj-E" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    				</div>
    			</div>
    		</div>
    	</div>

    	<div class="content_top">
    		<div class="heading">
    		<h3>Department</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
<!--===================pagination==========-->
	      	<?php 
	      			$per_page=4;
	      			if (isset($_GET['page'])) {
	      				$page=$_GET['page'];
	      			}else{
	      				$page=1;
	      			}
	      			$start_from=($page-1)*$per_page;

	      	 ?>

<!--===================pagination==========-->
	      		<?php 
	      				$result=$fondpage->displayDepartment($start_from,$per_page);
	      				if ($result !=false) {
	      				while ($value=$result->fetch_assoc()) {	
	      		 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="#"><img src="<?php echo 'admin/'.$value['image'] ?>" alt="" /></a>
					 <div class="shadow">
							<h2><?php echo $value['department'] ?></h2>
					</div>
				</div>
				<?php }}else{ ?>
					<span class="error">No department available</span>

				<?php } ?>

			</div>

			<div class="row">
				
			<?php  
				$num=$fondpage->getTotalowfromdepartment();
				$total_pages=ceil($num/$per_page);


				if ($num>0) { 
			   echo "<span class='mypagination'><a href='index.php?page=1'>".'&laquo'."</a></li>" ;
			   	for($i=1; $i<=$total_pages; $i++){
			   			echo "<a href='index.php?page=".$i."'>".$i."</a>";
			   	}
			    echo "<a href='index.php?page=".$total_pages."'>".'&raquo'."</a></span>";
			   }
			?>
			</div>

			<div class="content_bottom">
    		<div class="heading">
    		<h3>Doctors</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<!--===================pagination==========-->
	      	<?php 
	      			$per_page_doctor=4;
	      			if (isset($_GET['paged'])) {
	      				$paged=$_GET['paged'];
	      			}else{
	      				$paged=1;
	      			}
	      			$start_from_doctor=($paged-1)*$per_page_doctor;

	      	 ?>

      <!--===================pagination==========-->
			<div class="section group">
				<?php 
					$result=$fondpage->displayDoctor($start_from_doctor,$per_page_doctor);
					if ($result !=false) {
						while ($value=$result->fetch_assoc()) {
				 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="doctorprofile.php?doctor_id=<?php echo $value['doctor_id'] ?>"><img src="<?php echo "admin/".$value['image'] ?>" alt="" style="height: 230px; width: 100%"/></a>
					 <h2 style="color:#370a58"><?php echo $value['name'].", ".$value['qualification'] ?> </h2>
				     <div class="button"><span><a href="doctorprofile.php?doctor_id=<?php echo $value['doctor_id'] ?>" class="details">Profile</a></span></div>
				</div>
				<?php }}else{ ?>
					<span class="error">No doctor available</span>
				<?php } ?>
			</div>
			<div class="row">
				
			<?php  
				$numdoctor=$fondpage->getTotaldoctor();
				$total_pages_doctor=ceil($numdoctor/$per_page);

				if ($numdoctor>0) {
			   echo "<span class='mypagination'><a href='index.php?paged=1'>".'&laquo'."</a></li>" ;
			   	for($i=1; $i<=$total_pages; $i++){
			   			echo "<a href='index.php?paged=".$i."'>".$i."</a>";
			   	}
			    echo "<a href='index.php?paged=".$total_pages_doctor."'>".'&raquo'."</a></span>";
			   }
			?>
			</div>
    </div>
 </div>
 

 <?php include_once "file/footer.php" ?>
 
 