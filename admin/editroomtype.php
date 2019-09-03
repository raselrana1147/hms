<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Room type</h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if (isset($_GET["roomtype_id"]) AND $_GET['roomtype_id'] !=NULL) {
                        $roomtype_id=$_GET["roomtype_id"];
                        $roomtype_id=preg_replace('/[^a-zA-Z0-9]/','',$roomtype_id);       
                    }else{
                        echo "<script>window.location='roomtypelist.php'</script>";
                    }
             ?>
             <?php 

                if ($_SERVER["REQUEST_METHOD"]=="POST" and $_POST["submit"]) {
                    $upresult=$room->updateroomtype($_POST,$roomtype_id);
                    if ($upresult !=false) {
                        echo $upresult;
                    }
                  }
                   

              ?>

             <?php 
                    $result=$room->showRoomtypeinfo($roomtype_id);
                    if ($result !=false) {
                        while ($value=$result->fetch_assoc()) {
             ?>

            <table class="form">					
                <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                        <input type="text" name="roomtype" class="medium" value="<?php echo $value['roomtype'] ?>" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Cost</label>
                    </td>
                    <td>
                        <input type="number" name="cost" value="<?php echo $value['cost'] ?>" class="medium" />
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