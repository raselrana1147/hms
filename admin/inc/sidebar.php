<div class="grid_2">
    <div class="box sidemenu">
        <div class="block" id="section-menu">
            <ul class="section menu">
               
               <li><a class="menuitem">User panel</a>
                    <ul class="submenu">
                         <?php 
                             $role=Session::get("role");
                              if ($role=="0") {
                         ?>
                        <li><a href="adduser.php">Add user</a></li>
                        <?php } ?>
                       
                        <li><a href="userlist.php">User list</a></li>
                       
                    </ul>
                </li>
				
                 <li><a class="menuitem">Department</a>
                    <ul class="submenu">
                        <?php 
                            if ($role!="doctor") {
                         ?>
                        <li><a href="adddepartment.php">Add Department</a></li>
                        <?php } ?>
                        <li><a href="departmentlist.php">Department list</a></li>
                    </ul>
                </li>
				<li><a class="menuitem">Doctor</a>
                    <ul class="submenu">
                        <?php 
                                if ($role !="doctor") {   
                         ?>
                        <li><a href="adddoctor.php">Add doctor</a> </li>
                        <?php } ?>
                        <li><a href="doctorlist.php">Doctor List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Patient</a>
                    <ul class="submenu">
                        <?php 
                            if ($role !="doctor") {   
                         ?>
                        <li><a href="addpatient.php">Enroll patient</a> </li>
                        <?php } ?>
                        <li><a href="patientlist.php">Patient List</a> </li>
                    </ul>
                </li>
                <li><a class="menuitem">Room Info</a>
                    <ul class="submenu">
                        <?php 
                            if ($role !='doctor') {
                         ?>
                        <li><a href="addroomtype.php">Add Room type</a> </li>
                        <li><a href="addroom.php">Add Room</a> </li>
                        <li><a href="addbed.php">Add Bed</a> </li>
                        <?php } ?>
                        <li><a href="roomtypelist.php">Room type list</a> </li>
                        <li><a href="roomlist.php">Room list</a> </li>
                        <li><a href="bedlist.php">Bed list</a> </li>

                    </ul>
                </li>
                 <li><a class="menuitem">Appointment</a>
                    <ul class="submenu">
                        <?php 
                            if ($role !='doctor') {
                         ?>
                        <li><a href="makeappointment.php">Make appointment</a></li>
                        <?php } ?>
                        <li><a href="appointmentlist.php">Appointment list</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>