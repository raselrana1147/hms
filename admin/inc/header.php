<?php 
        $realpath=realpath(dirname(__FILE__));
        include_once $realpath."/../../lib/Session.php";
        Session::init();
        Session::checkSession();      
 ?>

 <?php 
     $filepath=realpath(dirname(__FILE__));
     //include_once ($filepath."/../../classes/Admin.php");
     //include_once ($filepath."/../../classes/Staff.php");
     //include_once ($filepath."/../../classes/Doctor.php");
     ////include_once ($filepath."/../../classes/Patient.php");
     //include_once ($filepath."/../../classes/Room.php");

    include_once ($filepath."/../../helper/Format.php");
    
    spl_autoload_register(function ($class){
         include_once "../classes/".$class.".php";
     });

     $admin      =new Admin();
     $staff      =new Staff();
     $doctor     =new Doctor();
     $patient    =new Patient();
     $room       =new Room();
     $appointment=new Appointment();
     $fm         =new Format();
  ?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php  echo $fm->tittlename() ?>-<?php  echo TITTLE ?></title>
    
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css"   rel="stylesheet" type="text/css" />
    <link href="css/mystyle.css"   rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   
    <!-- BEGIN: load jquery-->
    
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>

     <!--END: load jquery-->

   <script type="text/javascript" src="js/table/table.js"></script>
   <script src="js/setup.js" type="text/javascript"></script>
     <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
    
</head>
<body> 
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/g2.jpg" alt="Logo" />
                </div>
                <div class="floatleft middle">
                    <h1>Enhancing Life, Excelling in Care</h1>
                    <p>Define tomorrows Healthcare</p>
                </div>
                <div class="floatright">
                    <div class="floatleft">
                        <?php 
                            $image=Session::get("image");
                         ?>
                        <img src="<?php echo $image ?>" alt="Profile Pic" style="width: 35px; border-radius: 15px"/></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <?php 
                                if (isset($_GET["action"]) and $_GET["action"]=="logout") {
                                    Session::destroy();
                               }
                           ?>
                            <?php 
                                $role=Session::get("role");
                                if ($role =="doctor") {
                             ?>
                            <?php 
                                $name=Session::get("name");
                             ?>
                            <li>Hello <?php echo $name ?></li>
                            <?php }else{ ?>
                            <?php 
                                $fname=Session::get("fname");
                                 $lname=Session::get("lname");
                             ?>
                            <li><?php echo $fname." ".$lname ?></li>

                            <?php } ?>


                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="userprofile.php"><span>Your Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                <?php 
                        $result=$staff->unseenmessage();
                        if ($result !=false) { 
                 ?>
                <li class="ic-grid-tables"><a href="message.php"><span>Message <?php echo "(".$result.")"; ?></span></a></li>
                <?php }else{ ?>
                 <li class="ic-grid-tables"><a href="message.php"><span>Message <?php echo "(0)"; ?></span></a></li>
                <?php } ?>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
                 <li class="ic-grid-tables"><a href="invoicelist.php"><span>Invoice</span></a></li>
                 <li class="ic-charts"><a href="../index.php"><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>



