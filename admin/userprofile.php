<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
    $role=Session::get("role");
    if ($role !="doctor") {
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Your profile</h2>
        <div class="block">   
                  <?php 
                        $admin_id=Session::get("admin_id");
                        $username=Session::get("username");
                        $result  =$admin->showuserInfo($username,$admin_id);
                        if ($result !=false) {
                            $value=$result->fetch_assoc();
                        }
                         ?>            
            <div class="myprofile">
                  <div class="image">
                      <img src="<?php echo $value['image'] ?>">
                      <a href="updateuserprofile.php?admin_id=<?php echo $value['admin_id'] ?>">Update</a>
                  </div>
                  <div class="info">
                      <table>
                          <tr>
                              <th>First name:</th>
                              <td><?php echo $value['fname'] ?></td>
                          </tr>
                          <tr>
                              <th>last name:</th>
                              <td><?php echo $value['lname'] ?></td>
                          </tr>
                          <tr>
                              <th>Username</th>
                              <td><?php echo $value['username'] ?></td>
                          </tr>
                          <tr>
                              <th>Email:</th>
                              <td><?php echo $value['email'] ?></td>
                          </tr>
                          <tr>
                              <th>Address</th>
                              <td><?php echo $value['address'] ?></td>
                          </tr>
                          <tr>
                              <th>Phone</th>
                              <td><?php echo $value['phone'] ?></td>
                          </tr>
                      </table>
                  </div>

            </div>
        </div>
    </div>
</div>
<?php }else{?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Your profile</h2>
        <div class="block">   
                  <?php 
                        $doctor_id=Session::get("doctor_id");
                        $username=Session::get("username");
                        $result=$doctor->showDoctorProfile($username,$doctor_id);
                        if ($result !=false) {
                          while ($value=$result->fetch_assoc()) {
                         
                    ?>            
            <div class="doctorprofile">
                  <div class="image">
                      <img src="<?php echo $value['image'] ?>">
                      <a href="updatedoctorprofile.php?doctor_id=<?php echo $value['doctor_id'] ?>">Update</a>
                  </div>
                  <div class="info">
                      <table>
                          <tr>
                              <th>Name</th>
                              <td><?php echo $value['name'] ?></td>
                          </tr>
                          <tr>
                              <th>Title</th>
                              <td><?php echo $value['title'] ?></td>
                          </tr>
                          <tr>
                              <th>Department</th>
                              <td><?php echo $value['department'] ?></td>
                          </tr>
                          <tr>
                              <th>Qualification</th>
                              <td><?php echo $value['qualification'] ?></td>
                          </tr>
                          <tr>
                              <th>E-mail</th>
                              <td><?php echo $value['email'] ?></td>
                          </tr>
                          <tr>
                              <th>Address</th>
                              <td><?php echo $value['address'] ?></td>
                          </tr>
                           <tr>
                              <th>Phone</th>
                              <td><?php echo $value['phone'] ?></td>
                          </tr>
                           <tr>
                              <th>Online schedule date</th>
                              <td><?php echo $value['onlinedate'] ?></td>
                          </tr>
                          <tr>
                              <th>Online schedule time</th>
                              <?php 
                                  if ($value['onlinetime']>='12') {
                               ?>
                               <td><?php echo $value['onlinetime']." PM" ?></td>
                            <?php }else{ ?>
                              <td><?php echo $value['onlinetime']." AM" ?></td>
                              <?php } ?>
                          </tr>
                           <tr>
                              <th>Consultancy fee</th>
                              <td><?php echo $value['fee'] ?></td>
                          </tr>
                          <tr>
                              <th>Username</th>
                              <td><?php echo $value['username'] ?></td>
                          </tr>
                      </table>
                  </div>
                  <?php }} ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php include 'inc/footer.php';?>