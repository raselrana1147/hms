<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Bed </h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if (isset($_GET["bed_id"]) AND $_GET['bed_id'] !=NULL) {
                        $bed_id=$_GET["bed_id"];
                        $bed_id=preg_replace('/[^a-zA-Z0-9]/','',$bed_id);       
                    }else{
                        echo "<script>window.location='bedlist.php'</script>";
                    }
             ?>
             <?php 

                if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                   $upresult=$room->updatebed($_POST,$bed_id);
                   if ($upresult !=false) {
                       echo $upresult;
                   }
                  }
              ?>
             <?php 
                    $result=$room->showBedinfo($bed_id);
                    if ($result !=false) {
                        while ($valuebed=$result->fetch_assoc()) {
             ?>

            <table class="form">					
                <tr>
                    <td>
                        <label>Bed</label>
                    </td>
                    <td>
                        <input type="text" name="bed" class="medium" value="<?php echo $valuebed['bed'] ?>" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Room</label>
                    </td>
                    <td>
                        <select name="room">
                            <option value="">Select one</option>
                            <?php 
                                $result=$room->selectroom();
                                if ($result !=false) {
                                 while ( $value=$result->fetch_assoc()) {      
                             ?>
                            <option 
                            <?php 
                               if ($valuebed['room']==$value['room_id']){
                             ?>
                             selected="selected";
                             <?php } ?> 
                            value="<?php echo $value['room_id'] ?>"><?php echo $value['room']."------".$value['roomtype'] ?></option>
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