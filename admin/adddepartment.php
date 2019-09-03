<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
        $role=Session::get("role");
        if ($role =="doctor") {
           echo "<script>window.location='log.php'</script>";
           Session::destroy();
        }

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Department</h2>
        <div class="block">   
        <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                       $result=$staff->addDepartment($_POST,$_FILES);
                       if ($result !=false) {
                           echo $result;
                       }
                    }
            ?>            
         <form action="" method="post" enctype="multipart/form-data">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Department</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Department..."  name="department" id="department" class="medium" />
                        <p id="showdepartmentStatus" style="color: red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                        <input type="file" name="dimage" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add Department" />
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>