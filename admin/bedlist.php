<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Bed list</h2>
                <?php 
            		if (isset($_GET['bed_id'])) {
            			$bed_id=$_GET["bed_id"];
            			$result=$room->deleteBed($bed_id);
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
							<th width="10%">Serial No.</th>
							<th width="20%">Bed</th>
							<th width="15%">Room</th>
							<th width="15%">Room type</th>
							<th width="20%">Status</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
								$result=$room->displayBed();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $value['bed'] ?></td>
							<td><?php echo $value['room'] ?></td>
							<td><?php echo $value['roomtype'] ?></td>
							<?php 
							  if ($value['status']=="0") {
							 ?>
							<td>Bed available</td>
						    <?php }else{?>
						    <td style="color: red">Bed not available</td>
						    <?php } ?>
							<td>
								<?php 
									$role=Session::get("role");
									if ($role !='doctor') {
								 ?>
								<a href="editbed.php?bed_id=<?php echo $value['bed_id'] ?>">Edit</a> || 
								<a href="?bed_id=<?php echo $value['bed_id'] ?>" onclick="return confirm('Do you want to delete this bed ?')">Delete</a>
								<?php }else{ ?>
									<strong>Action not available</strong>
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
