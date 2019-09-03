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
        <h2>Upadte Patient</h2>
        <div class="block">   
              <?php 
                    if (isset($_GET["editpatient_id"]) and $_GET["editpatient_id"] !=NULL) {
                        $patient_id=$_GET["editpatient_id"];
                    }else{
                        echo "<script>window.location='patientlist.php'</script>";
                    }
               ?>
               <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                        $result=$patient->updatePatient($_POST,$patient_id);
                        if ($result !=false) {
                            echo $result;
                        }
                    }
                ?>
         <form action="" method="post" >
             <?php 
                    $result=$patient->displaypatientforUpdate($patient_id);
                    
                    if ($result !=false) {
                     while ($value=$result->fetch_assoc()) {
             ?>     
            <table class="form">	
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $value['name'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['address'] ?>" name="address" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['phone'] ?>" name="phone" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Sex</label>
                    </td>
                    <td>
                        <input 
                        <?php 
                            if ($value['sex']=="Male") {      
                         ?>
                            checked="checked";
                         <?php } ?>
                        type="radio" name="sex" value="Male">Male
                        <input 
                        <?php if ($value['sex']=="Female") {
                         ?>
                           checked="checked";
                         <?php  }?>
                        type="radio" name="sex" value="Female">Female
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Date of Birth</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['dob'] ?>" name="dob" id="dob" class="medium" />
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
                             <option value="Unkhown">Unknown</option>
                        </select>
                        <span><?php echo $value['bloodgroup'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Disease</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['disease'] ?>" name="disease" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Patient No.</label>
                    </td>
                    <td>
                        <input type="text"  name="pno" value="<?php echo $value['pno'] ?>" class="medium" readonly="1"/>
                        <p id="upcheckedpatientstatus" style="color:red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update Patient"/>
                    </td>
                </tr>

            </table>
         <?php }} ?>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>