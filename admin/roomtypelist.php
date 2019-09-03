<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Room type list</h2>
                <?php 
                		if (isset($_GET['roomtype_id'])) {
                			$roomtype_id=$_GET["roomtype_id"];
                			$result=$room->deleteRoomtype($roomtype_id);
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
							<th width="30%">Room type </th>
							<th width="20%">Cost </th>
							<th width="20%">Status</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
								$result=$room->displayRoomtype();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $value['roomtype'] ?></td>
							<td><?php echo $value['cost'] ?></td>
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
								<a href="editroomtype.php?roomtype_id=<?php echo $value['roomtype_id'] ?>">Edit</a> || 
								<a href="?roomtype_id=<?php echo $value['roomtype_id'] ?>" onclick="return confirm('Do you want to delete this roomtype ?')">Delete</a>
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
