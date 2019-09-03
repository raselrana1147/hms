<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">

        <h2>Update Infomation</h2>
         <?php 
                 if (isset($_GET['doctor_id']) and $_GET['doctor_id'] !=NULL) {
                     $doctor_id=$_GET["doctor_id"];
                 }else{
                    echo "<script>window.location='userprofile.php'</script>";
                 }
            ?>   
             <?php 

                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                       $result=$doctor->updateProfileInfo($_POST,$doctor_id);
                       if ($result !=false) {
                           echo $result;
                       }
                    }

              ?>
        <div class="block"> 
         <?php 
                   $result=$doctor->displaydoctorforupadte($doctor_id);
                   if ($result !=false) {
                       while ($value=$result->fetch_assoc()) {        
          ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">	
                 <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text"  name="name" value="<?php echo $value['name'] ?>" class="medium" />
                    </td>
                </tr>				
                <tr>
                    <td>
                        <label>E-mail</label>
                    </td>
                    <td>
                        <input type="text"  name="email" value="<?php echo $value['email'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text"  name="address" value="<?php echo $value['address'] ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $value['phone'] ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Online shedule date</label>
                    </td>
                    <td>
                        <input type="text" name="onlinedate" id="onlinedate" value="<?php echo $value['onlinedate'] ?>" class="medium" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Online shedule time</label>
                    </td>
                    <td>
                        <input type="time" name="onlinetime" id="onlinetime" value="<?php echo $value['onlinetime'] ?>" class="medium" value="" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Consulttency fee</label>
                    </td>
                    <td>
                        <input type="number" name="fee" id="fee" class="medium"  value="<?php echo $value['fee'] ?>"/>
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label></label>
                    </td>
                    <td>
                        <input type="hidden" name="doctorusername" value="<?php echo $value['username'] ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
       <?php }} ?>
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>