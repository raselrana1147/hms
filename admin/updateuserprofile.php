<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
         <?php 
                   if (isset($_GET["admin_id"]) AND $_GET["admin_id"] !=NULL) {
                       $admin_id=$_GET["admin_id"];
                       $admin_id=preg_replace('/[^a-zA-Z0-9]/','', $admin_id);
                   }else{
                      
                      echo "<script>window.location='userprofile.php'</script>";
                   }
             ?>

             
        <h2>Update Infomation</h2>
        <?php 
            if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                $result=$admin->updateUserinfo($_POST,$admin_id,$_FILES);
                echo $result;
            }
         ?>
        <div class="block"> 
         <?php 
                    $result=$admin->selectUser($admin_id);
                    if ($result !=false) {
                        while ($value=$result->fetch_assoc()) {
                          
              ?>              
         <form action="" method="post" enctype="multipart/form-data">
           
            
            <table class="form">					
                <tr>
                    <td>
                        <label>First name</label>
                    </td>
                    <td>
                        <input type="text"  name="fname" value="<?php echo $value['fname'] ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Last name</label>
                    </td>
                    <td>
                        <input type="text" name="lname" value="<?php echo $value['lname'] ?>" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>E-mail</label>
                    </td>
                    <td>
                        <input type="text" name="email" class="medium" value="<?php echo $value['email'] ?>" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" name="address" class="medium" value="<?php echo $value['address'] ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone No</label>
                    </td>
                    <td>
                        <input type="text" name="phone" class="medium" value="<?php echo $value['phone'] ?>"/>
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