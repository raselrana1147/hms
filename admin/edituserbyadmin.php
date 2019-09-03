<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update username</h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if (isset($_GET["admin_id"]) AND $_GET["admin_id"] !=NULL) 
                    {
                        $admin_id=$_GET["admin_id"];
                    }else{
                         echo "<script>window.location='userlist.php'</script>";
                    }

             ?>
            
             <?php 
                        $result=$admin->showallusername($admin_id);
                        if ($result !=false) {
                            while($value=$result->fetch_assoc()){

   
             ?>
             <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                        $username=$_POST["username"];

                        $resultupdate=$admin->updateUsernamebyadmin($username,$admin_id);
                        if ($resultupdate !=false) {
                            echo $resultupdate;
                        }
                    }
                    
              ?>
            <table class="form">					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" class="medium" value="<?php echo $value['username'] ?>"/>
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
            <?php }} ?>
            </form>
        </div>
        


    </div>

</div>

<?php include 'inc/footer.php';?>