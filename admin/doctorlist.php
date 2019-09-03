<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Doctor List</h2>

                	<?php 

                			if (isset($_GET["enable_id"])) {
                				$enable_id=preg_replace("/[^a-zA-Z0-9]/", "", $_GET["enable_id"]);
                				$enableResult=$staff->enableDoctor($enable_id);
                				if ($enableResult !=false) {
                					echo $enableResult;
                				}
                			}

                	 ?>
                	 <?php 

                			if (isset($_GET["disable_id"])) {
                				$disable_id=preg_replace("/[^a-zA-Z0-9]/", "", $_GET["disable_id"]);
                				$disableResult=$staff->disableDoctor($disable_id);
                				if ($disableResult !=false) {
                					echo $disableResult;
                				}
                			}

                	 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="1%">S.no</th>
							<th width="8%">Name</th>
							<th width="10%">Image</th>
							<th width="9%">Title</th>
							<th width="8%">Dept.</th>
							<th width="6%">Qual.</th>
							<th width="11%">E-mail</th>
							<th width="9%">Address</th>
							<th width="8%">Phone</th>
							<th width="13%">Schedule</th>
							<th width="4%">C.free</th>
							<th width="5%">Username</th>
							<th width="6%">Action</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
							
								$result=$staff->displayDoctor();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
								   $i++
						 ?>
						<tr class="odd gradeX">
							<td>
								<?php 
									if ($value['status']==1) {
										echo "<span style='color:red;font-size:20px'>".$i."</span>";
									}else{
										echo $i;
									}
								 ?>	
							</td>
							<td><?php echo $value['name'] ?></td>
							<td><img src="<?php echo $value['image'] ?>" width="40px"></td> 
							<td><?php echo $value['title'] ?></td> 
							<td><?php echo $value['department'] ?></td> 
							<td><?php echo $value['qualification'] ?></td> 
							<td><?php echo $value['email'] ?></td> 
							<td><?php echo $value['address'] ?></td> 
							<td><?php echo $value['phone'] ?></td> 
							<td>6.00 PM</td> 
							<td>400 Tk</td> 
							<td><?php echo $value['username'] ?></td> 
							<td>
								<?php 
										$role=Session::get("role");
										if ( $role !="doctor") {
											
								 ?>

								<a href="deleteDoctor.php?doctor_id=<?php echo $value['doctor_id'] ?>" onclick="return confirm('Do you want to delete this doctor ?')">Delete</a>
							<?php 
								if ($value['status']==1) {
							 ?>
								<a href="?enable_id=<?php echo $value['doctor_id'] ?>" onclick="return confirm('Do you want to enable this doctor ?')">Disable</a>
								<?php }else{ ?>
								<a href="?disable_id=<?php echo $value['doctor_id'] ?>" onclick="return confirm('Do you want to disable this doctor ?')">Enable</a>
								<?php  }?>
								<?php } else{?>
									<strong>N/A</strong>
								<?php } ?>

							</td>


						</tr>
						<?php }} ?>
					</tbody>
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
