<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
 <style type="text/css">
     
     .prescriptionmaker{width: 500px;height: 150px;padding: 8px; font-size: 16px; font-family: Tahma;color: #204562}

 </style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View prescription</h2>
        <div class="block">  
        <?php 
                if (isset($_GET["appointment_id"]) and $_GET['appointment_id'] !=NULL) {
                    $appointment_id=$_GET["appointment_id"];
                }else{
                    echo "<script>window.location='appointmentlist.php'</script>";
                }
         ?> 
        <?php 
            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                     echo "<script>window.location='appointmentlist.php'</script>";
            }  
            
        ?>         
         <form action="" method="post">
            
            <table class="form">	
            <?php 
                    $result=$appointment->viewprescription($appointment_id);
                    if ($result !=false) {
                       while ($value=$result->fetch_assoc()) {
             ?>				
                <tr>
                    <td>
                        <label>Prescription</label>
                    </td>
                    <td>

                        <textarea class="prescriptionmaker" name="prescription" placeholder="Write prescription here">
                            <?php echo $value['prescription'] ?>
                        </textarea>
                   
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Seen" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }} ?>
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>