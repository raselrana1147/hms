<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Room list</h2>
                <?php 
            		if (isset($_GET['room_id'])) {
            			$room_id=$_GET["room_id"];
            			$result=$room->deleteRoom($room_id);
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
							<th width="30%">Room</th>
							<th width="20%">Room type</th>
							<th width="20%">Status</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
								$result=$room->displayRoom();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
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
								<a href="editroom.php?room_id=<?php echo $value['room_id'] ?>">Edit</a> || 
								<a href="?room_id=<?php echo $value['room_id'] ?>" onclick="return confirm('Do you want to delete this room ?')">Delete</a>
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
