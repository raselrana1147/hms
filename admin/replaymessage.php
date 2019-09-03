<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Bed </h2>
        <div class="block">               
         <form action="" method="post">
            <?php 
                    if (isset($_GET["contact_id"]) AND $_GET['contact_id'] !=NULL) {
                        $contact_id=$_GET["contact_id"];
                        $contact_id=preg_replace('/[^a-zA-Z0-9]/','',$contact_id);       
                    }else{
                        echo "<script>window.location='message.php'</script>";
                    }
             ?>
             
             <?php 
                    if ($_SERVER["REQUEST_METHOD"]=="POST") {
                       $resultsend=$staff->replaymessageto($_POST,$contact_id);
                       if ($resultsend !=false) {
                           echo $resultsend;
                       }
                    }
                
              ?>
             <?php 
                    
             ?>

            <table class="form">	
            <?php 
                $result=$staff->getemailto($contact_id);
                if ($result !=false) {
                    while ( $value=$result->fetch_assoc()) {
                      
               
             ?>				
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" name="tomesage" class="medium" value="<?php echo $value['email'] ?>" readonly="1"/>
                    </td>
                </tr>
                <tr>
                    <?php }} ?>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name="frommesage" class="medium" value="" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" class="medium" value="" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="messagestyle" name="message" placeholder="Write message here..."></textarea>
                   
                    </td>
                </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Replay" />
                    </td>
                </tr>
            </table>
          
            </form>
        </div>
        


    </div>

</div>

<?php include 'inc/footer.php';?>