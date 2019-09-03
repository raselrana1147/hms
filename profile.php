<?php include_once "file/header.php" ?>
<?php 
    $checksession=Sessiontwo::get("login");
    if ($checksession !=true) {
      Sessiontwo::destroyTwo();
    }
 ?>
 <div class="main">
 	 
    <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <?php 
                if (isset($_GET['onlineappointment_id'])) {
                   $onlineappointment_id=$_GET['onlineappointment_id'];
                  $resultupdate=$fondpage->confirmTreatment($onlineappointment_id);
                }
            ?>


          <?php 
              $Sessionemail=Sessiontwo::get("email");
              $result=$fondpage->selectpatient($Sessionemail);
              if ($result !=false) {
                while ($value=$result->fetch_assoc()) {    
           ?>
          <table class="table table-striped">
          <thead>
              <tr>
                <th scope="col">Doctor name</th>
               <td><?php echo $value['name']; ?></td>
              </tr>
           </thead>
        <tbody>
            <tr>
              <th scope="col">Patient name</th>
             <td><?php echo $value['pname']; ?></td>
            </tr>

            <tr>
             <th scope="col">E-mail</th>
           <td><?php echo $value['email']; ?></td>
          </tr>

          <tr>
             <th scope="col">Age</th>
            <td><?php echo $value['age']; ?></td>
          </tr>
          <tr>
             <th scope="col">Gender</th>
           <td><?php echo $value['sex']; ?></td>
          </tr>
          <tr>
            <th scope="col">Disease Description</th>
           <td><?php echo $value['description']; ?></td>
          </tr>
          <?php 
              if ($value['status']>0) {
           ?>
          <tr>
            <th scope="col">Treatment</th>
           <td><?php echo $value['treatment']; ?></td>
          </tr>
          <?php } ?>
          <?php 
              if ($value['status']!="0") {
           ?>
          <?php } ?>
          <tr>
             <th scope="col">Status</th>
             <?php 
                  $status=$value['status'];
                  if ($status=="0") {
                
              ?>
              <td style="color: red">Not Treatment</td>
              <?php }else if($status=="1"){
               ?>
               <td style="color: green"><a href="?onlineappointment_id=<?php echo $value['onlineappointment_id'] ?>">Treatment created</a></td>
               <?php }else if($value['status']=="2"){ ?>
               <td style="color: green"><strong>I got treatment </strong></td>
               <?php } ?>
          </tr>
           </tbody>
           <?php 
              if ($value['status']=="0") {
            ?>
            <div style="margin:0px 0px 10px 0px;"><a href="updateprofile.php?onlineappointment_id=<?php echo $value['onlineappointment_id'] ?>" class="btn buttonbac">Update</a></div>
            <?php } ?>

          </table>
          <?php }} ?>
        </div>
        <div class="col-sm-3"></div>

      </div>

    </div>  


  </div>
 <?php include_once "file/footer.php" ?>