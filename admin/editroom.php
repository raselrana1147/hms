<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Room </h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if (isset($_GET["room_id"]) AND $_GET['room_id'] !=NULL) {
                        $room_id=$_GET["room_id"];
                        $room_id=preg_replace('/[^a-zA-Z0-9]/','',$room_id);       
                    }else{
                        echo "<script>window.location='roomlist.php'</script>";
                    }
             ?>
             <?php 

                if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                   $upresult=$room->updateroom($_POST,$room_id);
                   if ($upresult !=false) {
                       echo $upresult;
                   }
                  }
              ?>
             <?php 
                    $result=$room->showRoominfo($room_id);
                    if ($result !=false) {
                        while ($value=$result->fetch_assoc()) {
             ?>

            <table class="form">					
                <tr>
                    <td>
                        <label>Room</label>
                    </td>
                    <td>
                        <input type="text" name="room" class="medium" value="<?php echo $value['room'] ?>" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                        <select name="roomtype">
                            <option value="">Select one</option>
                            <?php 
                                $result=$room->selectroomtype();
                                if ($result !=false) {
                                 while ( $valuet=$result->fetch_assoc()) {      
                             ?>
                            <option 
                                <?php 
                                    if ($valuet['roomtype_id']==$value['roomtype']) {   
                                 ?>
                                 selected="selected";
                                 <?php } ?>
                            value="<?php echo $valuet['roomtype_id'] ?>"><?php echo $valuet['roomtype'] ?></option>
                            <?php }} ?>
                        </select>
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