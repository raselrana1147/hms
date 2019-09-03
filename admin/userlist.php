<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Department List</h2>
                	<p>Serarch option</p>
                	<?php 
                		if (isset($_GET['disable_id'])) {
                			$disable_id=$_GET["disable_id"] ;
                			$resultenable=$staff->enableuser($disable_id);
                			echo $resultenable;
                		
                		}
                	 ?>
                	 <?php 
                		if (isset($_GET['enable_id'])) {
                			$enable_id=$_GET["enable_id"] ;
                			$resultenable=$staff->disableuser($enable_id);
                			echo $resultenable;
                		
                		}

                	 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">S No.</th>
							<th width="8%">Username</th>
							<th width="13%">Image</th>
							<th width="8%">F.Name</th>
							<th width="8%">L.name</th>
							<th width="14%">Address</th>
							<th width="10%">Phone</th>
							<th width="11%">E-mail</th>
							<th width="8%">Level</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$result=$admin->userlist();
							if ($result !=false) {
								$i=0;
								while ($value=$result->fetch_assoc()) {
									$i++;
						 ?>
						<tr class="odd gradeX">
							<td>
								<?php 
									if ($value["status"]=='1') {
										echo "<span class='error'><strong>".$i."</strong><span>";
									}else{
										echo $i;
									}
								  ?>
							</td>
							<td Editable=""><?php echo $value['username'] ?></td>
							<td><img src="<?php echo $value['image'] ?>" width="50px"></td>
						    <td><?php echo $value['fname'] ?></td>
							<td><?php echo $value['lname'] ?></td>
							<td><?php echo $value['address'] ?></td>
							<td><?php echo $value['phone'] ?></td>
							<td><?php echo $value['email'] ?></td>
							<td>
								<?php 
									if ($value['role']==0) {
										echo "<strong>Admin</strong>";
									}else if($value['role']=="1"){
										echo "<strong>Staff</strong>";
									}
								?>
							</td>

							<td>
								<?php 
									$role=Session::get("role");
									if ($role=='0') {			
								 ?>

								 <?php 
									if ($value['role']=='0') {
								 ?>
								 <a href="edituserbyadmin.php?admin_id=<?php echo $value['admin_id'] ?>">Edit</a>||
								 <span>N/A</span>
								 <?php }else{?>
								 <a href="edituserbyadmin.php?admin_id=<?php echo $value['admin_id'] ?>">Edit</a>||
								 	<?php if ($value['status']=='1') {								 	
								 	?>
								 	 <a onclick="return confirm('Do you want to Enable the user ?')" href="?disable_id=<?php echo $value['admin_id'] ?>">Disable</a>
								 	 <?php }else{?>
								 	 <a onclick="return confirm('Do you want to disabled the user ?')" href="?enable_id=<?php echo $value['admin_id'] ?>">Enable</a>
								 	 <?php  }?>
								<?php }?>
								<?php }else{?>
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
