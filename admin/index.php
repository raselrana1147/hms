<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2> Dashbord</h2>
                <div class="block">               
                  <section class="mydashboard">
                      <aside class="user">
                        <h4>Total user</h4>
                        <?php 
                            $userresult=$admin->totaluser();
                            if ($userresult !=false) {
                         ?>
                          <span class="counter" style="font-size: 25px; color: #000"><strong><?php echo $userresult; ?></strong></span>
                          <?php } ?>
                      </aside>
                        <aside class="doctor">
                        <h4>Total Doctor</h4>
                        <?php 
                            $doctorresult=$doctor->totaldoctor();
                            if ($doctorresult !=false) {
                         ?>
                          <span style="font-size: 25px; color: #000 " class="counter"><strong><?php echo $doctorresult; ?></strong></span>
                          <?php } ?>
                      </aside>
                        <aside class="patientcolor">
                        <h4>Enrolled Patient</h4>
                        <?php 
                            $resultenrolled=$patient->taotalenrrolledpatient();
                            if ($resultenrolled !=false) {
                         ?>
                        <span style="font-size: 25px; color: #000 " class="counter"><strong><?php echo $resultenrolled ?></strong></span>
                        <?php } ?>
                      </aside>
                      <aside class="patiencurent">
                        <h4>Current Patient</h4>
                        <?php 
                            $resulcurrent=$patient->taotalcurrent();
                            if ($resulcurrent !=false) {
                         ?>
                        <span style="font-size: 25px; color: #000 " class="counter"><strong><?php echo $resulcurrent ?></strong></span>
                        <?php } ?>
                      </aside>
                  </section>
                </div>
            </div>
        </div>
     
        <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
         <script src="myjs/jquery.counterup.min.js"></script>
       <script>
        jQuery(document).ready(function($) {

            $('.counter').counterUp({
                delay: 100,
                time: 1000
            });

        });
    </script>
<?php include 'inc/footer.php';?>