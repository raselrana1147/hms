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
        <h2>Add Room Type</h2>
        <div class="block">   
        <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                        $result=$room->addroomtype($_POST);
                        if ($result !=false) {
                            echo $result;
                        }
                       
                    }
            ?>            
         <form action="" method="post">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Room type..."  name="roomtype" id="roomtype" class="medium" />
                        <p id="showroomstatus" style="color: red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Cost</label>
                    </td>
                    <td>
                        <input type="number" name="cost" class="medium" placeholder="Cost" />
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add room type" />
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>