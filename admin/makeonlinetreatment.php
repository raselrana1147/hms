<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
        $role=Session::get("role");
        if ($role !="doctor") {
           echo "<script>window.location='log.php'</script>";
           Session::destroy();
        }

 ?>
 <style type="text/css">
     
     .prescriptionmaker{width: 500px;height: 150px;padding: 8px; font-size: 16px; font-family: Tahma;color: #204562}

 </style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Make online treatment</h2>
        <?php 
                if($_GET['onlineappointment_id'] and $_GET['onlineappointment_id'] !=NULL){
                    $onlineappointment_id=$_GET['onlineappointment_id'];
                }else{
                    echo "<script>window.location='inbox.php'</script>";
                }

         ?>
         <?php 
                if ($_SERVER['REQUEST_METHOD']=="POST") {
                    $result=$doctor->maketreatment($onlineappointment_id,$_POST);
                        if ($result !=false) {
                            echo $result;
                        }
                }


          ?>
        <div class="block">    
         <form action="" method="post"> 
            <table class="form">
            <?php 
                        $resultdisplay=$doctor->displaytreatment($onlineappointment_id);
                        if ($resultdisplay !=false) {
                            while ($value=$resultdisplay->fetch_assoc()) {
             ?>               
                <tr>
                    <td>
                        <label>Treatment</label>
                    </td>
                    <td>
                        <textarea class="prescriptionmaker" name="treatment" placeholder="Write treatment here...">
                            <?php echo $value['treatment'] ?>
                        </textarea>
                    </td>
                </tr>
                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Make treatment" />
                    </td>
                </tr>
                <?php }} ?>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>