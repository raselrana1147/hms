<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Discharge patient</h2>
                <div class="block">   
                 <?php 
                           
                          if (isset($_GET['appointment_id']) and $_GET['appointment_id'] !=NULL) {
                            $appointment_id=$_GET['appointment_id'];
                         
                          }else{
                            echo "<script>window.location='appointmentlist.php'</script>";
                          }
                       ?> 
                       <?php 
                            if ($_SERVER['REQUEST_METHOD']=="POST") {
                                  $invoiceresult=$patient->makeInvoice($_POST,$appointment_id);
                                  if ($invoiceresult !=false) {
                                  echo $invoiceresult;                           
                        ?> 
                        <script type="text/javascript">
                           function send() {
                          window.location='invoice.php?appointment_id=<?php echo $appointment_id ?>';
                          }
                         setTimeout("send()",2000);
                     </script>
                  <?php }} ?>          
              <div class="discharge">     
             <form action="" method="post">
              <?php 
                    $result=$appointment->calculatcharge($appointment_id);
                    if ($result !=false) {
                      while ($value=$result->fetch_assoc()) {
               ?>
               <span style="margin-left: 200px; color: green"> <strong>Patient ID: <?php echo $value['patient_id'] ?></strong></span>
                  <table class="form">          
                      <tr>
                          <th>
                              <label>Start Date</label>
                          </th>
                          <td>
                              <input type="text" name="strartdate" class="medium" value="<?php echo $value['appointment_date'] ?>"  readonly="1"/>
                          </td>
                      </tr>
                       <tr>
                          <th>
                              <label>Discharge Date</label>
                          </th>
                          <td>
                              <input type="text" name="dischargedate" class="medium" value="<?php echo date('m/d/Y') ?>" readonly="1"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Total day</th>
                          <?php 
                             $days=floor(abs(strtotime(date('m/d/Y'))-strtotime($value['appointment_date']))/(24*60*60))+1;
                           ?>
                          <td>
                               <input type="text" name="totalday" class="medium" value="<?php echo $days ?>" readonly="1"/>
                          </td>
                      </tr>
                      <tr>
                          <th>Total charge</th>
                           
                          <td>
                               <input type="text" name="totalcharge" class="medium" value="<?php echo $value['cost']*$days ?>" readonly="1"/>
                          </td>
                      </tr>
                       <tr>
                          <th>Extra charge</th>
                          <td>
                               <input type="number" name="extracharge" class="medium" value="0" />
                          </td>
                      </tr>
                      <tr>
                          <th></th>
                          <td>
                               <input type="hidden" name="patientid" class="medium" value="<?php echo $value['patient_id'] ?>" />
                          </td>
                      </tr>
                      <tr>
                          <th></th>
                          <td>
                               <input type="hidden" name="doctorid" class="medium" value="<?php echo $value['doctor_id'] ?>" />
                          </td>
                      </tr>
                      <tr>
                          <th></th>
                          <td>
                               <input type="hidden" name="roomtype" class="medium" value="<?php echo $value['roomtype'] ?>" />
                          </td>
                      </tr>
                      <tr>
                          <th></th>
                          <td>
                               <input type="hidden" name="room" class="medium" value="<?php echo $value['room'] ?>" />
                          </td>
                      </tr>
                      <tr>
                          <th></th>
                          <td>
                               <input type="hidden" name="bed" class="medium" value="<?php echo $value['bed'] ?>" />
                          </td>
                      </tr>

                      <tr>
                          <th></th>
                          <td>
                               <input type="submit" name="submit" class="medium" value="Generate Bill" />
                          </td>
                      </tr>
                  </table>
                  <?php }} ?>
            </form>
                    </div>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>