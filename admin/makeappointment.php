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
        <h2>Make Appointment</h2>
        <div class="block">   
            <p id="test"></p>
              <?php 
              if ($_SERVER["REQUEST_METHOD"]=="POST") {
                  $result=$appointment->makeAppointment($_POST);
                  if ($result !=false) {
                      echo $result;
                  }
                 
              }
                   
               ?>
              
         <form action="" method="post">
            
            <table class="form">					
                <tr>
                    <td>
                        <label>Patient ID</label>
                    </td>
                    <td>
                        <select id="patientid" name="patientid" style="width: 480px">
                              <option value="">Select one</option>
                            <?php 
                                $resutlPatient=$appointment->selectPatient();
                                if ($resutlPatient !=false) {
                                    while ($pvalue=$resutlPatient->fetch_assoc()) {    
                             ?>
                            <option value="<?php echo $pvalue['pno'] ?>"><?php echo "Patient Id: ".$pvalue['pno']." Name:".$pvalue['name'] ?></option>
                            <?php }} ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Patient name</label>
                    </td>
                    <td>
                      <input type="text" placeholder="Patient name" name="patientname" id="patientname" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Disease</label>
                    </td>
                    <td>
                       <input type="text" placeholder="Disease" name="patientdisease" id="patientdisease" class="medium" />
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
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Room type</label>
                    </td>
                    <td>
                       <select id="roomtypeid" name="roomtypeid" style="width: 480px">
                        <option value="">Select one</option>
                        <?php 
                                $resutroomtype=$appointment->selectroomtype();
                                if ($resutroomtype !=false) {
                                    while ($rtvalue=$resutroomtype->fetch_assoc()) {    
                             ?>
                            <option value="<?php echo $rtvalue['roomtype_id'] ?>"><?php echo $rtvalue['roomtype'] ?></option>
                            <?php }} ?>
                        </select>
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
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Appointment Date</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Date" name="appointmentdate" id="appointmentdate" class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Appointment time</label>
                    </td>
                    <td>
                        <input type="time" name="appointmenttime" id="appointmenttime" class="medium" />
                    </td>
                </tr>   
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Make Appointment"/>
                    </td>
                </tr>
            </table>
              <div id="ok"></div>
            </form>
      
        </div>
    </div>

</div>
<?php include 'inc/footer.php';?>