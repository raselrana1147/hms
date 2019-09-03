<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 

                		// if (isset($_GET["onlineappointment_id"])) {
                		// 	$$onlineappointment_id=$_GET["onlineappointment_id"];
                		// 	$result=$doctor->deleteOnlineappointment($onlineappointment_id);
                		// 	if ($result !=false) {
                		// 		echo $result;
                		// 	}
                		// }






                 ?>


                  <?php 
                		if (isset($_GET['onlineappointment_id'])) {
                			$onlineappointment_id=preg_replace("/[^a-zA-Z0-9]/", '', $_GET['onlineappointment_id']);
                			$result=$doctor->deleteOnlineappointment($onlineappointment_id);
                			if ($result !=false) {
                				echo $result;
                			}
                		}
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="3%">S.No.</th>
							<th width="10%">Doctor ID</th>
							<th width="10%">Doctor name</th>
							<th width="15%">patient name</th>
							<th width="10%">E-mail</th>
							<th width="5%">Age</th>
							<th width="5%">Sex</th>
							<th width="27%">Description</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

							$result=$doctor->Exteriorappointment();
							if ($result !=false) {
								$i=0;
								while ($value=$result->fetch_assoc()) {
								$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $value['doctor_name'] ?></td>
							<td><?php echo $value['name'] ?></td>
							<td><?php echo $value['pname'] ?></td>
							<td><?php echo $value['email'] ?></td>
							<td><?php echo $value['age'] ?></td>
							<td><?php echo $value['sex'] ?></td>
							<td> <?php echo $value['description'] ?> </td>
							<td>
								<?php 
								$sessiondoctor=Session::get("username");
									if ($value['doctor_name']==$sessiondoctor and $value['status']=="0" || $value['status']=="1") {
								 ?>
								<a href="makeonlinetreatment.php?onlineappointment_id=<?php echo $value['onlineappointment_id'] ?>">Treatment</a> 
								|| 
								<a href="#">Delete</a>
								<?php }else if($value['doctor_name']==$sessiondoctor and $value['status']=="2"){ ?>
								
								<span><strong>Seen</strong></span>||
								<a href="?onlineappointment_id=<?php echo $value['onlineappointment_id'] ?>" onclick="return confirm('Do you want to delete this ?')">Delete</a>
								<?php }else{ ?>

								<span>Not available</span>
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
