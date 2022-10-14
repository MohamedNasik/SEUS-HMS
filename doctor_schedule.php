<!DOCTYPE html>
<html lang="en">
           
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
         
        ?>

<!-- calendar23:59-->
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/calender/fullcalendar.css">


    <link href='assets/packages/daygrid/main.css' rel='stylesheet' />
    <link href='assets/packages/timegrid/main.css' rel='stylesheet' />
    <link href="assets/packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='assets/packages/datepicker/datepicker.css' rel='stylesheet' />
    <link href='assets/packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <link href="assets/packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">

<script src="assets/sweetalert/bestsweet.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<script src="assets/sweetalert/sweetalert.js"></script>



</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="#" class="logo">
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>SEUS HMS</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a> -->

                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>  You</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php

if( $_SESSION['role_id']=='1'){
  include ('sidebar/adminsidebar.php');
} if( $_SESSION['role_id']=='2'){

    include ('sidebar/doctorsidebar.php');

} if( $_SESSION['role_id']=='3'){

    include ('sidebar/laboratorist.php');

}
if( $_SESSION['role_id']=='4'){
    include ('sidebar/receptionist.php');
}



    ?>


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-4">
                        <h4 class="page-title">Doctor Schedule</h4>
                    </div>
        
                </div>
                <?php
if( $_SESSION['role_id']=='1'){
?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#event-modal">
                    Add Doctor Schedule
                </button> 

         

<?php  } ?>
                <br> <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box mb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="calendar"></div>

                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>


<!--  prescribe another doctor -->
<div class="modal fade" id="event-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <center> <span class="dash-widget-bg1"><i class="fa fa-user-md"></i> </span>
                        <h3> Create Doctor Schedule ?</h3>
                    </center>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-body">
                        <div class="row">
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong> <label>Specilization type</label></strong>
                                    <select class="select specilization" id="specilization" name="specilization">
                                        <option value="Select Specilization">Select Specilization</option>

                                        <?php    
                                            require_once 'auth/dbconnection.php';
                                            $sql = "SELECT * FROM doctorspecilization";
                                            if($result = mysqli_query($conn, $sql)){
                                            if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){
                                                ?>

                                        <option value="<?php echo $row['specilization']; ?>">
                                            <?php echo $row['specilization']; ?></option>

                                        <?php  }}}?>

                                    </select>
                                    <span id="spec" class="info text-danger"></span><br />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong> <label>Doctor Name</label></strong>
                                    <select class="select" id="doctor_name" name="doctor_name">
                                        <option value="Select Doctor">Select Doctor</option>
                                    </select>
                                    <span id="type" class="info text-danger"></span><br />
                                </div>
                            </div>

                            <div class="col-md-6">         
                            <div id="startdate-group" class="form-group">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="text" class="form-control datetimepicker" id="startDate" name="startDate">
                                <span id="startt" class="info text-danger"></span><br />
                            </div>

                        </div>

                        <div class="col-md-6">

                        <div id="enddate-group" class="form-group">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                                <span id="endt" class="info text-danger"></span><br />

                            </div>

                     
                       

                        </div>


                        </div>
                    </div>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <button class="btn btn-primary" id="submitButton">Create Schedule</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




            
           

<!-- event model -->
        <div id="event-modal" class="modal fade none-border">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Event</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group">
                                <label>Event Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label>Event Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control" type="text">
                                </div>
                            </div>

                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>












    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/calender/jquery-ui.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/calender/moment.min.js"></script>
    <script src="assets/calender/fullcalendar.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>


    <script src='assets/packages/daygrid/main.js'></script>
    <script src='assets/packages/timegrid/main.js'></script>
    <script src='assets/packages/list/main.js'></script>
    <script src='assets/packages/interaction/main.js'></script>
    <script src='assets/packages/datepicker/datepicker.js'></script>



    
<script>

$(document).ready(function() {



var calendar = $('#calendar').fullCalendar({
    <?php
if( $_SESSION['role_id']=='1'){
?>
    editable:true,
    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],

<?php } ?>
    header:{
     left:'prev,next today',
     center:'title',
     right: 'month,agendaWeek,agendaDay,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    events:'adminquery/schedule/load_doctor_schedule.php',
    <?php
if( $_SESSION['role_id']=='1'){
?>
    selectable:true,
    selectHelper:true,

    // select: function(start, end, allDay)
    // {
    //  var title = prompt("Enter Event Title");
    //  if(title)
    //  {
    //   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    //   $.ajax({
    //     url: "adminquery/schedule/schedule.php", // Url to which the request is send
    //    type:"POST",
    //    data:{title:title, start:start, end:end},
    //    success:function()
    //    {
    //     calendar.fullCalendar('refetchEvents');
    //     alert("Added Successfully");
    //    }
    //   })
    //  }
    // },

    editable:true,
    

    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var doctor_schedule_id = event.doctor_schedule_id;
     $.ajax({
        url: "adminquery/schedule/update_doctor_schedule.php", // Url to which the request is send
      type:"POST",
      data:{title:title, start:start, end:end, doctor_schedule_id:doctor_schedule_id},
      success:function(data){

        if ($.trim(data) === '1') {
  
     calendar.fullCalendar('refetchEvents');
       alert('Schedule Update');

}else{

    swal("Error", "Some patients available  :(", "error");
    calendar.fullCalendar('refetchEvents');


}
      }
     })
    },

    // eventDrop:function(event)
    // {
    //  var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
    //  var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
    //  var title = event.title;
    //  var doctor_schedule_id = event.doctor_schedule_id;
    //  $.ajax({
    //     url: "adminquery/schedule/update_doctor_schedule.php", // Url to which the request is send
    //   type:"POST",
    //   data:{title:title, start:start, end:end, doctor_schedule_id:doctor_schedule_id},
    //   success:function(data)
    //   {
    //    calendar.fullCalendar('refetchEvents');
    //    alert("Schedule Updated");
    //    $('#success_mes').html(data);

    //   }
    //  });
    // },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var doctor_schedule_id = event.doctor_schedule_id;
      var starts = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");

      $.ajax({
        url: "adminquery/schedule/delete_doctor_schedule.php", // Url to which the request is send
       type:"POST",
       data:{doctor_schedule_id:doctor_schedule_id,starts:starts},
       success:function(data)
       {
        if (data == 'Cant') {
  
            swal("Error", "Some patients available  :(", "error");

        
        }else{

        calendar.fullCalendar('refetchEvents');
        alert("Schedule Removed");
        $('#success_mes').html(data);
        }


       }
      })
     }
    },
    <?php } ?>
   });

// fetch cpec
$('#specilization').change(function () {
    var doc_spec_id = $(this).val();

       $.ajax({
            url: "adminquery/fetch_doctor_names.php", // Url to which the request is send
            method: "POST",             // Type of request to be send, called as method
            data: { doc_spec_id: doc_spec_id },
            dataType: "text",

            success: function (data) {
            $("#doctor_name").html(data);

                    }
                });
            });
// end search doctor name

// add doctor schedule
$('#submitButton').on('click', function (e) {

// stop the form refreshing the page
var startDate = $('#startDate').val();
var endDate = $('#endDate').val();
var doctor_name = $('#doctor_name').val();

// process the form

var valid;
valid = validateContact();
if (valid) {

$.ajax({
    type: "POST",
    url: 'adminquery/schedule/add_doctor_schedule.php',
    data: {
        startDate: startDate,
        doctor_name: doctor_name,
        endDate: endDate,

    },
    //  dataType    : 'json',

success: function (data) {
if (data == 'Saved') {
calendar.fullCalendar('refetchEvents');

swal("Success", "Schedule Updated  :)", "success");


} else if (data == 'Didnt Saved') {
//our handled error
swal("Sorry", "Failed to update the Schedule :(", "error");
} else if (data == 'Wrong Date') {

    swal("Sorry", "Wrong Date :(", "error");

} else if (data == 'Time Adjustment Wrong') {

    swal("Sorry", "Time Adjustment Wrong :(", "error");

} else if (data == 'Already Added') {

swal("Sorry", "Doctor Already Added :(", "error");

} else if (data == 'Selected Past Date') {

swal("Sorry", "Don't select past Date :(", "error");


}else {
//our handled error
swal("Sorry", "Failed to save :(", "error");
}



},
error: function (data) {
//other errors that we didn't handle
swal("Sorry", "Failed to send order. Please try later :(", "error");
}

});


doSubmit();

};

        // check validations
        function validateContact() {
                            var valid = true;
                            $(".demoInputBox").css('background-color', '');
                            $(".info").html('');

                            if (!$("#startDate").val()) {
                                $("#startt").html("(Required)");
                                $("#startDate").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if (!$("#endDate").val()) {
                                $("#endt").html("(Required)");
                                $("#endDate").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if ($("#specilization").val() == 'Select Specilization') {
                                $("#spec").html("(Select type)");
                                //    $("#specilization").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if ($("#doctor_name").val() == 'Select Doctor') {
                                $("#type").html("(Select Doctor)");
                                //    $("#specilization").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            return valid;
                        }

        

});

function doSubmit() {

$("#event-modal").modal('hide');

$("#calendar").fullCalendar('renderEvent',
    {
        title: $('#eventName').val(),
        start: new Date($('#eventDueDate').val()),

    },
    true);
}

// get specialization
// $('#doctor').change(function () {
   
//    var doctor=$(this).val();
   
//    $.ajax({
//                url: "adminquery/schedule/update_doctor_schedules.php", // Url to which the request is send
//                method: "POST",             // Type of request to be send, called as method
//                data: {doctor:doctor  },
//               // dataType:"text",
   
//                success: function (data) {
             
                   
//                    document.getElementById('start-Date').value = data.start_time;
//                    document.getElementById('end-Date').value = data.end_time;
   
//             }
   
//            });
   
   
//        });







  });
 


</script>



</body>


<!-- calendar24:03-->
</html>