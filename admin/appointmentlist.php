<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Appointment List</h2>
                <?php 
                		if (isset($_GET['delpatient_id'])) {
                			$patient_id=preg_replace("/[^a-zA-Z0-9]/", '', $_GET['delpatient_id']);
                			$result=$patient->deletePatient($patient_id);
                			if ($result !=false) {
                				echo $result;
                			}
                		}
                 ?>

                 <?php 
                 		date_default_timezone_get("Asia/Dhaka");
                 		 $today= Date("m/d/Y");
                 		

                  ?>
                	<p>Serarch option</p>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="4%">S No.</th>
							<th width="5%">P. ID</th>
							<th width="7%">P. Disease</th>
							<th width="15%">Prescription</th>
							<th width="12%">Doctor ID</th>
							<th width="7%">Department</th>
							<th width="15%">Room</th>
							<th width="10%">A.Date</th>
							<th width="10%">A.time</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$result=$appointment->displayAppointment();
							if ($result !=false) {
								$i=0;
								while ($value=$result->fetch_assoc()) {
								$i++;	
						 ?>
						<tr class="odd gradeX">
							<td>
								<?php echo  $i ?>
							</td>
							<td><?php echo $value['patient_id'] ?></td>
						    <td><?php echo $value['disease'] ?></td>
						    <?php 
						    $role=Session::get("role");
						    $username=Session::get("username");
						    	if ($value["status"]=="0" and $role=="doctor" and $value['doctor_id']==$username) {	
						     ?>
						     <td>
						     	<?php 
						     			if ($today>=$value['appointment_date']) {
						     	 ?>
						     	<a href="makeprescription.php?appointment_id=<?php echo $value['appointment_id'] ?>">Make prescription</a>	
						     	<?php }else{ ?>
						     	<span><strong>Not Now</strong></span>
						     	<?php } ?>
						     </td>
						     <?php }else if($value["status"]=="0" and $value['doctor_id']!=$username){ ?>
						     	 <td><span style="color: red"><strong >Not prescription</strong></span></td>
						     <?php }else{?>
						      <td><a href="viewprescription.php?appointment_id=<?php echo $value['appointment_id'] ?>">View prescription</a></td>
						     <?php } ?>

							<td><?php echo $value['doctor_id'] ?></td>
							<td><?php echo $value['department'] ?></td>
							<td><?php echo $value['roomtype'].",".$value['room'].",".$value['bed'] ?></td>
							<td><?php echo $value['appointment_date'] ?></td>
							<?php 
								if ($value['appointment_time']>='12') {
							 ?>
							<td><?php echo $value['appointment_time']." PM" ?></td>
							<?php }else{?>
							<td><?php echo $value['appointment_time']." AM" ?></td>
							<?php } ?>
							<td>
								<?php 
									if ($value['status']=='0' and $role!='doctor') {
								 ?>
						       <a href="editappointment.php?appointment_id=<?php echo $value['appointment_id'] ?>">Edit</a>||
						     	<a href="#?appointment_id=<?php echo $value['appointment_id'] ?>" onclick="return confirm('Comming soon')">Delete</a>
						       <?php }else if($value['status']=='1' and $role!='doctor'){ ?>
						       	  <a href="discharge.php?appointment_id=<?php echo $value['appointment_id'] ?>">Discharge</a>
						       	  <?php }else{ ?>
						       	  <span>No action vailable</span>
						       	  <?php } ?>
							</td>		
						</tr>	
						<?php }} ?>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
