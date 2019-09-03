<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
        $role=Session::get("role");
        if ($role !="0") {
            echo "<script>window.location='log.php'</script>";
             session_destroy();
        }

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                          $username=$_POST["username"];
                           $password=$_POST["password"];
                           $role=$_POST["userrole"];

                           $result=$admin->adduser($username,$password,$role);
                           echo $result;;
                    }
             ?>
            <table class="form">					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Username..."  name="username" id="username" class="medium" />
                        <p id="showStatus" style="color: red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="password..." name="password" id="password" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Userrole</label>
                    </td>
                    <td>
                        <select id="userrole" name="userrole">
                             <option value="">Select role</option>
                             <option value="1">Staff</option>
                            
                        </select>
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add user" />
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>