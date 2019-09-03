<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
        $role=Session::get("role");
        if ($role =="doctor") {
            echo "<script>window.location='log.php'</script>";
             session_destroy();
        }

 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Patient</h2>
        <div class="block">   
              <?php 
             
                   if ($_SERVER["REQUEST_METHOD"]=="POST") {
                       $result=$staff->addPatient($_POST);
                       echo $result;
                      
                   }
               ?>
         <form action="" method="post" enctype="multipart/form-data">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Name..."  name="name"  class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Address" name="address" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Phone" name="phone" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Gender</label>
                    </td>
                    <td>
                        <input type="radio" name="sex" value="Male" checked="1">Male
                        <input type="radio" name="sex" value="Female">Female
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date of Birth</label>
                    </td>
                    <td>
                        <input type="text" placeholder="dob" name="dob" id="dob" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Blood group</label>
                    </td>
                    <td>
                        <select name="bloodgroup">
                            <option value="">Select one</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="o-">O-</option>
                            <option value="Unkhown">Unkhown</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Disease symdrome</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Disease" name="disease" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Patient No.</label>
                    </td>
                    <td>
                        <input type="text"  name="pno" value="<?php echo "P-".rand(1000,8888); ?>" id="pno" class="medium" />
                        <p id="checkedpatientstatus" style="color:red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add Patient"/>
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>