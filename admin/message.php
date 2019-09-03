<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 
                	if (isset( $_GET["contact_id"]) AND $_GET['contact_id'] !=NULL) {
                		$contact_id=$_GET["contact_id"];
                		 $resultdelete=$staff->deletemessage($contact_id);
                       if ($resultdelete !=false) {
                            echo $resultdelete;
                        }
                	}
                   


              ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="10%">S.No.</th>
							<th width="10%">Name</th>
							<th width="15%">E-mail</th>
							<th width="25%">Message</th>
							<th width="20%">Date Time</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
								$result=$staff->displayMessage();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['email'] ?></td>
							<td><?php echo $value['message'] ?></td>
							<td><?php echo $fm->dateformat($value['date']) ?></td>
							<td>

								<?php 
								$role=Session::get('role');
								if ($role=="doctor") {
									echo "No avilable";
								}else{
									if ($value['status']=="0") {
								 ?>
								<a href="replaymessage.php?contact_id=<?php echo $value['contact_id'] ?>">Replay</a>||
								<?php }else{ ?>
								<span  class="success"><strong>Seen</strong></span> ||
								<?php } ?>
								<a   href="?contact_id=<?php echo $value['contact_id'] ?>" onclick="return confirm('Do you want to delete this message ?')">Delete</a>
							</td>
							<?php } ?>
						</tr>
						<?php }}?>
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
