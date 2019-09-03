<?php include_once "file/header.php" ?>
<?php 

    Sessiontwo::checkLogin();

 ?>
 <div class="main">
 	 <div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
    	<?php 
    			if ($_SERVER["REQUEST_METHOD"]=="POST") {
    				$result=$fondpage->patientlogin($_POST);
    				if ($result !=false) {
    					echo $result;
    				}
    			}

    	 ?>
    	<div class="loginimg">
      		<img src="images/pl.jpg" alt="log in image" class="img-fluid img-thumbnail">
      	</div>
      <div class="onlineappointment">
	      <form action="" method="post">
	      	 <div class="form-group">
	           		<label for="pemail">E-mail:</label>
	           		<input type="text" class="form-control" name="pemail" id="pemail" placeholder="Patient email">
	           </div>
	            <input type="submit" name="submit" value="Log in" class="btn buttonbac">
	      </form>
       </div>
    </div>
    <div class="col-4">
       
    </div>
  </div>
</div>
    </div>
 <?php include_once "file/footer.php" ?>