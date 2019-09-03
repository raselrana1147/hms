<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Invoice List</h2>
                <?php 

                    if (isset($_GET["invoice_id"]) and $_GET["invoice_id"] !=NULL) {
                      $invoice_id=$_GET["invoice_id"];
                      $result=$admin->deleteinvoce($invoice_id);
                    }


                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="4%">S.No.</th>
							<th width="10%">P.ID</th>
							<th width="10%">P.Name</th>
							<th width="10%">D.ID</th>
							<th width="10%">R.type</th>
							<th width="5%">Room</th>
							<th width="5%">Bed</th>
							<th width="5%">T.cost</th>
							<th width="5%">E.cost</th>
							<th width="8%">S.date</th>
							<th width="8%">E.date</th>
							<th width="5%">Days</th>
							<th width="15%">Action</th>

						</tr>
					</thead>
					<tbody>
						<?php 

								$result=$patient->invoicelistdisplay();
								if ($result !=false) {
									$i=0;
									while ($value=$result->fetch_assoc()) {
										$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $value['patientid'] ?></td>
							<td><?php echo $value['pname'] ?></td>
							<td><?php echo $value['doctorid'] ?></td>
							<td><?php echo $value['roomtype'] ?></td>
							<td><?php echo $value['room'] ?></td>
						    <td><?php echo $value['bed'] ?></td>
							<td><?php echo $value['totalcost'] ?></td>
							<td><?php echo $value['extracost'] ?></td>
							<td><?php echo $value['startdate'] ?></td>
							<td><?php echo $value['enddate'] ?></td>
							<td><?php echo $value['days'] ?></td>
							<td>
								<a href="makenewInvoice.php?invoice_id=<?php echo $value['invoice_id'] ?>" id="fadeinvoice">Make invoice</a>||
								<a href="?invoice_id=<?php echo $value['invoice_id'] ?>" onclick="return confirm('Do you want to delete this invoice list ?')">Delete</a>

							</td>
                           
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>

               <!--div class="makeinvoicelist">
               
               	 <div class="invoice">
                 
                   <header class="headerinvoice clear">
                    
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
                            <td></td>
                          </tr>
                          <tr>
                            <th>Name:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Sex:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>B.group:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Age:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Age:</th>
                            <td></td>
                          </tr>
                        </table>  
                      </aside>
                      <aside>
                      <table>
                         
                          <tr>
                            <th>Doctor ID:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Name:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Qualification:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Title:</th>
                            <td></td>
                          </tr>
                          
                        </table>  
                      </aside>
                      <aside>
                       <table>
                         
                          <tr>
                            <th>Start date:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>End date:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Total days:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Roomtype:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Room:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Bed:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>T. charge:</th>
                            <td></td>
                          </tr>
                          <tr>
                            <th>E. charge:</th>
                            <td></td>
                          </tr>                          
                        </table>  
                      </aside>
                        <div class="costsection">
                         
                        </div>
                    </section>
                    <footer class="displaycsot clear">
                      <aside>Total charge:</aside>
                    </footer>
                  </div>
               </div>
            </div>-->

        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
