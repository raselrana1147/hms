<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Make invoice</h2>
                <div class="block">  
                <?php 
                      if (isset($_GET['invoice_id']) and $_GET["invoice_id"] !=NULL ) {
                          $invoice_id=$_GET["invoice_id"];
                      }else{
                         echo "<script>window.location='invoicelist.php'</script>";
                      }

                 ?>             
                 <div class="makeinvoicelist">
               
                 <div class="invoice">
                 
                   <header class="headerinvoice clear">
                    <?php 

                              $result=$patient->makeinvoiceshheet($invoice_id);
                              if ($result !=false) {
                                while ($value=$result->fetch_assoc()) {
                             
                          ?>

                     <div class="left">Bill No: <?php echo $value['invoice_id']; ?></div>
                      <div class="right">Date:<?php echo date("m/d/Y") ?></div>
                    
                     <div class="left"></div>
                      <div class="right"></div>
                   </header>
                    <nav class="navtittle clear">
                      <aside>Patient details</aside>
                      <aside>Doctor details</aside>
                      <aside>Charge details</aside>
                      <aside>Total charge</aside>
                    </nav>
                    <section class="invoicecontent clear">
                      <aside>
                        <table>
                         
                          <tr>
                            <th>P. ID:</th>
                            <td><?php echo $value['patientid']; ?></td>
                          </tr>
                          <tr>
                            <th>Name:</th>
                            <td><?php echo $value['pname']; ?></td>
                          </tr>
                          
                        </table>  
                      </aside>
                      <aside>
                      <table>
                         
                          <tr>
                            <th>Doctor ID:</th>
                            <td><?php echo $value['doctorid']; ?></td>
                          </tr>
                          <tr>
                            <th>Name:</th>
                            <td><?php echo $value['name']; ?></td>
                          </tr>
                          <tr>
                            <th>Qualification:</th>
                            <td><?php echo $value['qualification']; ?></td>
                          </tr>
                          <tr>
                            <th>Title:</th>
                            <td><?php echo $value['title']; ?></td>
                          </tr>
                          
                        </table>  
                      </aside>
                      <aside>
                       <table>
                         
                          <tr>
                            <th>Start date:</th>
                            <td><?php echo $value['startdate']; ?></td>
                          </tr>
                          <tr>
                            <th>End date:</th>
                            <td><?php echo $value['enddate']; ?></td>
                          </tr>
                          <tr>
                            <th>Total days:</th>
                            <td><?php echo $value['days']; ?></td>
                          </tr>
                          <tr>
                            <th>Roomtype:</th>
                            <td><?php echo $value['roomtype']; ?></td>
                          </tr>
                          <tr>
                            <th>Room:</th>
                            <td><?php echo $value['room']; ?></td>
                          </tr>
                          <tr>
                            <th>Bed:</th>
                            <td><?php echo $value['bed']; ?></td>
                          </tr>
                          <tr>
                            <th>T. charge:</th>
                            <td><?php echo $value['totalcost']; ?></td>
                          </tr>
                          <tr>
                            <th>E. charge:</th>
                            <td><?php echo $value['extracost']; ?></td>
                          </tr>  
                                     
                        </table>  
                      </aside>
                        <div class="costsection">
                         
                        </div>
                    </section>
                    <footer class="displaycsot clear">
                       <aside>Total charge: <?php echo $value['totalcost']+$value['extracost']; ?></aside>
                    </footer>
                 <?php }} ?>       
                  </div>

               </div>
                <button id="printinvoice" class="printbutton">Print</button>
             </div>

                </div>
            </div>
        </div> 
<?php include 'inc/footer.php';?>