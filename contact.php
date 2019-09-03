<?php include_once "file/header.php" ?>
 <div class="main">
    <div class="content">
    	<div class="about">
    		<div class="container">
    			<div class="row">
    				<div class="mymap">
    					<div id="map"></div>
    				</div>
    			</div>
    			<div class="row">
    				<div class="col-md-3"></div>
    				<div class="col-md-6">
    				    <div class="contactform">
                  <?php 
                      if ($_SERVER['REQUEST_METHOD']=="POST") {
                        $result=$fondpage->contact($_POST);
                        if ($result !=false) {
                          echo $result;
                        }
                      }

                   ?>
                       <h2>Contact us</h2>
                       <form action="" method="post">
                        <div class="form-group">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                   </div>
                   <div class="form-group">
                      <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
                   </div>
                    <div class="form-group">
                      <textarea class="form-control" rows="4" placeholder="Message here..." name="message"></textarea>
                   </div>
                   <input type="submit" name="submit" value="Send" class="btn buttonbac">
                 </form>
                </div>
    				</div>
    				<div class="col-md-3"></div>
    			</div>
    		</div>	
    	</div>
    	</div>	
 </div>
 
 
 <script src="http://maps.google.com/maps/api/js"></script>
  <script src="myjs/gmaps.js"></script>

 <script type="text/javascript">
    var map;
    $(document).ready(function(){
      var map = new GMaps({
        el: '#map',
        lat: 23.8104659,
        lng: 90.327261
      });

      GMaps.geolocate({
        success: function(position){
          map.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function(error){
          alert('Geolocation failed: '+error.message);
        },
        not_supported: function(){
          alert("Your browser does not support geolocation");
        },
       
      });
    });
  </script>
  
 <?php include_once "file/footer.php" ?>
 
 