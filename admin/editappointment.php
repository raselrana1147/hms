<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
        $role=Session::get("role");
        if ($role =="doctor") {
            echo "<script>window.location='log.php'</script>";
             session_destroy();
        }

 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Appointment</h2>
        <div class="block">   
            <p id="test"></p>
              <?php 
                    if (isset($_GET['appointment_id']) and $_GET['appointment_id']!=NULL) {
                        $appointment_id=$_GET['appointment_id'];
                      
                    }else{
                        echo "<script>window.location='appointmentlist.php'</script>";
                    }
               ?>
               <?php 

                        if ($_SERVER["REQUEST_METHOD"]=="POST") {
                            $result=$appointment->updateAppointment($appointment_id,$_POST);
                            if ($result !=false) {
                                echo $result;
                            }  
                        }
                ?>
              
              <?php 
                $result=$appointment->displayforupdateapp($appointment_id);
                if ($result !=false) {
                while ($value=$result->fetch_assoc()) {
               ?>  
         <form action="" method="post">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Patient ID</label>
                    </td>
                    <td>
                        <input type="text" readonly="1" name="patientid" id="patientid" value="<?php echo $value['patient_id'] ?>" class="medium">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Department</label>
                    </td>
                    <td>
                        <select id="departmentid" name="departmentid" style="width: 480px">
                            
                              <option value="">Select one</option>
                                                          <?php 
                                $resutldepartment=$appointment->selectdepartment();
                                if ($resutldepartment !=false) {
                                    while ($dvalue=$resutldepartment->fetch_assoc()) {    
                             ?>
                             

                              <option value="<?php echo $dvalue['department_id'] ?>"><?php echo $dvalue['department'] ?></option>

                              <?php }} ?>
                             
                        </select>
                         <span><?php echo $value['department'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Doctor name</label>
                    </td>
                    <td>
                        <select id="doctorid" name="doctorid" style="width: 480px">
                            <option value="">Select one</option>
                        </select>
                         <span><?php echo $value['name'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                       
                       <select style="width: 480px" id="roomtypeid" name="roomtypeid">
                        <option value="">Select one</option>
                        <?php 
                                $resutroomtype=$appointment->selectroomtype();
                                if ($resutroomtype !=false) {
                                    while ($rtvalue=$resutroomtype->fetch_assoc()) {    
                             ?>
                            <option value="<?php echo $rtvalue['roomtype_id'] ?>"><?php echo $rtvalue['roomtype'] ?></option>
                            <?php }} ?>
                       </select> 
                        <span><?php echo $value['roomtype'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Room</label>
                    </td>
                    <td>
                        <select id="roomid" name="roomid" style="width: 480px">
                            <option value="">Select one</option>
                        </select>
                         <span><?php echo $value['room'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Bed</label>
                    </td>
                    <td>
                       <select id="bedid" name="bedid" style="width: 480px">
                            <option value="">Select one</option>
                        </select>
                         <span><?php echo $value['bed'] ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Appointment Date</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Date" value="<?php echo $value['appointment_date'] ?>" name="appointmentdate" id="appointmentdate" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Appointment time</label>
                    </td>
                    <td>
                        <input type="time" name="appointmenttime" value="<?php echo $value['appointment_time'] ?>" id="appointmenttime" class="medium" />
                    </td>
                </tr>   
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update Appointment"/>
                    </td>
                </tr>
            </table>
              <div id="ok"></div>
            </form>
      <?php }} ?>
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>