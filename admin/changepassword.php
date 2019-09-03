<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">  
        <?php 
                $role=Session::get("role");
                if ($role !="doctor") {
                    
                

         ?>             
         <form action="" method="post">
            <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                       $admin_id= Session::get("admin_id");     
                        $result=$admin->changePass($_POST,$admin_id);
                        echo $result;
                    }
             ?>
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
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
            <?php }else{ ?>


                <form action="" method="post">
            <?php 
               
                
                 if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submitdoctor"]) {
                       $doctor_id= Session::get("doctor_id");  
                        $result=$doctor->changePass($_POST,$doctor_id);
                        echo $result;
                    }

             ?>
            <table class="form">                    
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submitdoctor" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>

            <?php } ?>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>