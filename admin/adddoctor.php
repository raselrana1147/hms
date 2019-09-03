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
        <h2>Add Doctor</h2>
        <div class="block">   
              <?php 
             
              if ($_SERVER["REQUEST_METHOD"]=="POST") {
                  
                    $result=$staff->addDoctor($_POST,$_FILES);
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
                        <input type="text" placeholder="name..."  name="name"  class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Title" name="title" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Qualification</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Qualification" name="qualification" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Department</label>
                    </td>
                    <td>
                        <select name="department" id="department" style="width: 515px">
                                <option value="">Select one</option>
                                <?php 
                                        $deparment=$staff->selectDepartment();
                                        if ($deparment !=false) {
                                        while ($row=$deparment->fetch_assoc()) {
                                               
                                 ?>
                                <option value="<?php echo $row['department_id'] ?>"><?php echo $row["department"] ?></option>
                                <?php }} ?>
                        </select>
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
                        <label>E-mail</label>
                    </td>
                    <td>
                        <input type="text" placeholder="E-mail" name="email" id="emaildoctor" class="medium" />
                        <p id="chechdoctoremail" style="color:red"></p>
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
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Password" name="password" class="medium" />
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
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" class="medium" id="username" value="<?php echo "D-".rand(1000,5000); ?>" />
                        <p id="chechdoctorid" style="color:red"></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Profile type:</label>
                    </td>
                    <td>
                        <input readonly type="text" name="profiletype" class="medium" value="doctor" />
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add Doctor"/>
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>