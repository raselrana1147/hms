<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Patient List</h2>
                <?php 
                		if (isset($_GET['delpatient_id'])) {
                			$patient_id=preg_replace("/[^a-zA-Z0-9]/", '', $_GET['delpatient_id']);
                			$result=$patient->deletePatient($patient_id);
                			if ($result !=false) {
                				echo $result;
                			}
                		}
                 ?>
                	<p>Serarch option</p>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="3%">S No.</th>
							<th width="10%">Name</th>
							<th width="13%">Address</th>
							<th width="10%">Phone</th>
							<th width="6%">Gender</th>
							<th width="10%">DOB</th>
							<th width="4%">Age</th>
							<th width="16%">Blood Group</th>
							<th width="8%">Patient ID</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$result=$patient->DisplayPatient();
							if ($result !=false) {
								$i=0;
								while ($value=$result->fetch_assoc()) {
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td>
								<?php 
									if ($value['status']=="1") {
										echo "<span style='color:red'>".$i."</span>";
									}else{
										echo $i;
									}
								 ?>
							</td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['address'] ?></td>
						    <td><?php echo $value['phone'] ?></td>
							<td><?php echo $value['sex'] ?></td>
							<td><?php echo $value['dob'] ?></td>
							<td><?php echo $value['age'] ?></td>
							<td><?php echo $value['bloodgroup'] ?></td>
							<td><?php echo $value['pno'] ?></td>
							<td>
								<?php 
									$role=Session::get("role");
									if ($role=='doctor') {		
								 ?>
								 <span>Action not available</span>
								 <?php }else{ ?>
							  
							   <?php 
							   		if ($value['status']=="0") {
							    ?>
							    <a href="edidtpatient.php?editpatient_id=<?php echo $value['patient_id'] ?>">Edit</a>||
							     <span>Not assigned</span>
							    <a href="?delpatient_id=<?php echo $value['patient_id'] ?>" onclick="return confirm('Do you want to delete this patient ?')">Delete</a>
							   <?php }else{ ?>
							   <span style="color: red">Assigned</span>
							   <?php } ?>
							  
							</td>	
							<?php } ?>
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
