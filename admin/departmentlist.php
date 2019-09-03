<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Department List</h2>
                	<p>Serarch option</p>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="30%">Department</th>
							<th width="40%">Image</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
								$result=$staff->dispalyDepartmanet();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $value['department'] ?></td>
							<td><img src="<?php echo $value['image'] ?>" style="width: 60px;height: 55px;border-radius: 15px"></td>
							<td>
								<?php 
										$role=Session::get("role");
										if ($role !="doctor") {
											# code...
										
								 ?>
								<a href="editDepatment.php?department_id=<?php echo $value['department_id'] ?>">Edit</a> || 
								<a href="deleteDepartment.php?department_id=<?php echo $value['department_id'] ?>" onclick="return confirm('Do you want to delete this department ?')">Delete</a>
								<?php }else{ ?>
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
