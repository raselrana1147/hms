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
        <h2>Make prescription</h2>
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
                        $result=$appointment->makeprescrition($_POST,$appointment_id);
                        if ($result !=false) {
                            echo $result;
                        
            
        ?>   

        <script type="text/javascript">
            function send() {
                window.location='appointmentlist.php';
            }
            setTimeout("send()",3000);
        </script>

        <?php }} ?>
                
         <form action="" method="post">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Prescription</label>
                    </td>
                    <td>
                        <textarea class="prescriptionmaker" name="prescription" placeholder="Write prescription here..."></textarea>
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Make prescription" />
                    </td>
                </tr>
            </table>
            </form>
        
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>