
var selectedpatient={


};




$(document).ready(function(){
	$("#username").keyup(function(){
		var username=$("#username").val();
		if (username !="") {
			$.ajax({
				url:"ajaxfile/checkadmin.php",
				method:"POST",
				data:{username:username},
				dataType:"text",
				success:function(data){
					$("#showStatus").html(data);
				}

			});
			return false;
		}
		
	});



$("#department").keyup(function(){
		var department=$("#department").val();
		if (department !="") {
			$.ajax({
				url:"ajaxfile/checkdepartment.php",
				method:"POST",
				data:{department:department},
				dataType:"text",
				success:function(data){
					$("#showdepartmentStatus").html(data);
				}

			});
			return false;
		}

	});



$("#emaildoctor").keyup(function(){
		var emaildoctor=$("#emaildoctor").val();
		if (emaildoctor !="") {
			$.ajax({
				url:"ajaxfile/checkdoctoremail.php",
				method:"POST",
				data:{emaildoctor:emaildoctor},
				dataType:"text",
				success:function(data){
					$("#chechdoctoremail").html(data);
				}

			});
			return false;
		}
		
	});



$("#username").keyup(function(){
		var username=$("#username").val();
		if (username !="") {
			$.ajax({
				url:"ajaxfile/checkdoctorid.php",
				method:"POST",
				data:{username:username},
				dataType:"text",
				success:function(data){
					$("#chechdoctorid").html(data);
				}

			});
			return false;
		}
		
	});

                 
$("#dob").datepicker({
	dateFormat:"mm/dd/yy",
	appendText:"mm/dd/yy",
	changeMonth:true,
	changeYear:true
	
	
});

///=========check patient id;================

$("#pno").keyup(function(){
		var pno=$("#pno").val();
		if (pno !="") {
			$.ajax({
				url:"ajaxfile/checkdpatient.php",
				method:"POST",
				data:{pno:pno},
				dataType:"text",
				success:function(data){
					$("#checkedpatientstatus").html(data);
				}

			});
			return false;
		}
	});

//// Roomtype check======

$("#roomtype").keyup(function(){
		var roomtype=$("#roomtype").val();
		if (roomtype !="") {
			$.ajax({
				url:"ajaxfile/checkroomtype.php",
				method:"POST",
				data:{roomtype:roomtype},
				dataType:"text",
				success:function(data){
					$("#showroomstatus").html(data);
				}

			});
			return false;
		}
	});

////room check====
$("#roomtype").change(function(){ 
		var room=$("#room").val();
		var roomtype=$("#roomtype").val();
		if (room !="" || roomtype !="") {
			$.ajax({
				url:"ajaxfile/checkroom.php",
				method:"POST",
				data:{room:room,roomtype:roomtype},
				dataType:"text",
				success:function(data){
					$("#showroom").html(data);
				}
			});
			return false;
		}
	});
///check bed=======
$("#room").change(function(){ 
		var bed=$("#bed").val();
		var room=$("#room").val();
		if (bed !="" || room !="") {
			$.ajax({
				url:"ajaxfile/checkbed.php",
				method:"POST",
				data:{bed:bed,room:room},
				dataType:"text",
				success:function(data){
					$("#showbed").html(data);
				}
			});
			return false;
		}
	});
////show doctor =======

$("#departmentid").change(function(){ 
		var departmentid=$("#departmentid").val();
		if (departmentid !="") {
			$.ajax({
				url:"ajaxfile/selectdoctor.php",
				method:"POST",
				data:{departmentid:departmentid},
				dataType:"text",
				success:function(data){
					$("#doctorid").html(data);
				}
			});
			return false;
		}
	});

////=====show doctor =======

$("#roomtypeid").change(function(){ 
		var roomtypeid=$("#roomtypeid").val();
		if (roomtypeid !="") {
			$.ajax({
				url:"ajaxfile/selectroom.php",
				method:"POST",
				data:{roomtypeid:roomtypeid},
				dataType:"text",
				success:function(data){
					$("#roomid").html(data);
				}
			});
			return false;
		}
	});


////=====show doctor =======

$("#roomid").change(function(){ 
		var roomid=$("#roomid").val();
		if (roomid !="") {
			$.ajax({
				url:"ajaxfile/selectbed.php",
				method:"POST",
				data:{roomid:roomid},
				dataType:"text",
				success:function(data){
					$("#bedid").html(data);
				}
			});
			return false;
		}
	});


///show patient info===

$("#patientid").change(function(){ 
		var patientid=$("#patientid").val();
		if (patientid !="") {
			$.ajax({
				url:"ajaxfile/selectpatientinfo.php",
				method:"POST",
				data:{patientid:patientid},
				dataType:"text",
				success:function(data){
						
					var d=data.split(",")
					document.getElementById("patientname").value=d[0];
					document.getElementById("patientdisease").value=d[1];
					
			      
				}	
			});
			return false;
		}
	});

//====dob=====
$("#appointmentdate").datepicker({
	dateFormat:"mm/dd/yy",
	appendText:"mm/dd/yy",
	slideShow:"slidedown",
	minDate:0,
	showAnim:"slideDown"
	
	
});


$("#onlinedate").datepicker({
	dateFormat:"mm/dd/yy",
	appendText:"mm/dd/yy",
	slideShow:"slidedown",
	minDate:0,
	showAnim:"slideDown"
	
	
});







////===========making printer ================
$("#printinvoice").click(function(){
	
        var mode = 'iframe';
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $(".invoice").printArea( options );
    
});












});

