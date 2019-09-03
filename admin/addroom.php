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
        <h2>Add Room</h2>
        <div class="block">   
        <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                        $result=$room->addroomt($_POST);
                        if ($result !=false) {
                            echo $result;
                         }
                       
                    }
            ?>            
         <form action="" method="post">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Room</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Room ..."  name="room" id="room" class="medium" />
                        <p id="showroom" style="color: red"></p>
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                        <select name="roomtype" id="roomtype">
                            <option value="">Select one</option>
                            <?php 
                                $result=$room->selectroomtype();
                                if ($result !=false) {
                                while ($value=$result->fetch_assoc()) {
                             ?>
                            <option value="<?php echo $value['roomtype_id'] ?>"><?php echo $value['roomtype'] ?></option>
                            <?php }}?>
                        </select>
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Add room" />
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>