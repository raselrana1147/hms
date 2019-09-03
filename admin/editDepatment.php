<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Department</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <?php 
                    if (isset($_GET["department_id"]) AND $_GET['department_id'] !=NULL) {
                        $department_id=$_GET["department_id"];
                        $department_id=preg_replace('/[^a-zA-Z0-9]/','',$department_id);       
                    }else{
                        echo "<script>window.location='departmentlist.php'</script>";
                    }
             ?>
             <?php 

                if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                    $upresult=$staff->updateDepartment($_POST,$department_id,$_FILES);
                    if ($upresult !=false) {
                        echo $upresult;
                    }
                  }
                   

              ?>
             <?php 
                    $result=$staff->showDepartmentinfo($department_id);
                    if ($result !=false) {
                        while ($value=$result->fetch_assoc()) {
             ?>

            <table class="form">					
                <tr>
                    <td>
                        <label>Department</label>
                    </td>
                    <td>
                        <input type="text" name="department" class="medium" value="<?php echo $value['department'] ?>" />
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
            <div class="dimage">
               <img src="<?php echo $value['image'] ?>">
            </div>
            <?php }} ?>
            </form>
        </div>
        


    </div>

</div>

<?php include 'inc/footer.php';?>