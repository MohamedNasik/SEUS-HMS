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
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/calender/fullcalendar.css">

    <link href='assets/packages/daygrid/main.css' rel='stylesheet' />
    <link href='assets/packages/timegrid/main.css' rel='stylesheet' />
    <link href="assets/packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='assets/packages/datepicker/datepicker.css' rel='stylesheet' />
    <link href='assets/packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <link href="assets/packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->

    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">

<script src="assets/sweetalert/bestsweet.js"></script>
<script src="assets/sweetalert/sweetalert.min.js"></script>
<script src="assets/sweetalert/sweetalert.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            $('body').on('click', '.datetimepicker', function () {
                $(this).not('.hasDateTimePicker').datetimepicker({
                    controlType: 'select',
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd-mm-yy",
                    timeFormat: 'HH:mm:ss',
                    yearRange: "1900:+10",
                    showOn: 'focus',
                    firstDay: 1
                }).focus();
            });

            $(".colorpicker").colorpicker();

        });



    </script>




</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index-2.php" class="logo">
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>SEUS HMS</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg"
                                                    class="img-fluid rounded-circle">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">L</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">G</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                    added new task <span class="noti-title">Private chat module</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span>You</span>
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
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
                        <h4 class="page-title">Patient Schedule</h4>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#event-modal">
                    Add Patient Schedule
                </button> <br><br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box mb-0">
                            <div class="row">
                                <br>
                                <div class="col-md-12">
                                    <div id="calendar"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- dfdfdf -->



<div class="modal fade" id="event-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Patient Consultation Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                    <div class="col-md-12">

                    <textarea rows="2" cols="5" id="title" name="title" class="form-control" value=""
                     disabled> <?php echo $_GET['pname'] ?>  (Dr.<?php echo $_GET['name'] ?> <?php echo $_GET['spec'] ?>)     </textarea>  </div>
                            <input type="hidden" id="pid" value="<?php echo $_GET['pid']  ?>">
                            <input type="hidden" id="uid" value="<?php echo $_GET['userid']  ?>">
                            <input type="hidden" id="aid" value="<?php echo $_GET['apt']  ?>">
                            
                        <div class="col-md-6">         
                            <div id="startdate-group" class="form-group">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="text" class="form-control datetimepicker" id="startDate" name="startDate">
                                <!-- errors will go here -->
                            </div>
                            <div id="color-group" class="form-group">
                                <label class="control-label" for="color">Colour</label>
                                <input type="text" class="form-control colorpicker" name="color" value="#6453e9"
                                    id="color">
                                <!-- errors will go here -->
                            </div>

                        </div>

                        <div class="col-md-6">

                        <div id="enddate-group" class="form-group">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                            </div>

                     
                            <div id="textcolor-group" class="form-group">
                                <label class="control-label" for="textcolor">Text Colour</label>
                                <input type="text" class="form-control colorpicker" name="text_color" value="#ffffff"
                                    id="text_color">
                                <!-- errors will go here -->
                            </div>

                        </div>

                    </div>

                    

                </div>

            </div>

            <div class="modal-footer">
              <div class="m-t-20 text-center">
            <button class="btn btn-primary submit-btn" id="submitButton">Create Schedule</button>
                        </div>   </div>

           

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->













<!-- fdfdfdfd -->
        <div id="asdads" class="modal fade none-border">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-calendar"> </i> Add Patient Schedule</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">

                            <div id="title-group" class="form-group">
                                <label class="control-label" for="title">Schedule Name</label>
                                <!-- <input type="text" class="form-control" id="title"> -->

                                <textarea rows="2" cols="5" id="title" name="title" class="form-control" value=""
                                    disabled> <?php echo $_GET['pname'] ?>  (Dr.<?php echo $_GET['name'] ?>  <?php echo $_GET['spec'] ?>)      </textarea>

                                <!-- errors will go here -->
                            </div>

                            <input type="hidden" id="pid" value="<?php echo $_GET['pid']  ?>">
                            <input type="hidden" id="uid" value="<?php echo $_GET['userid']  ?>">
                            <input type="hidden" id="aid" value="<?php echo $_GET['apt']  ?>">


                            <div id="startdate-group" class="form-group">
                                <label class="control-label" for="startDate">Start Time</label>
                                <input type="text" class="form-control datetimepicker" id="startDate" name="startDate">
                                <!-- errors will go here -->
                            </div>

                            <div id="enddate-group" class="form-group">
                                <label class="control-label" for="endDate">End Time</label>
                                <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div id="color-group" class="form-group">
                                <label class="control-label" for="color">Colour</label>
                                <input type="text" class="form-control colorpicker" name="color" value="#6453e9"
                                    id="color">
                                <!-- errors will go here -->
                            </div>

                            <div id="textcolor-group" class="form-group">
                                <label class="control-label" for="textcolor">Text Colour</label>
                                <input type="text" class="form-control colorpicker" name="text_color" value="#ffffff"
                                    id="text_color">
                                <!-- errors will go here -->
                            </div>

                        </div>




                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" id="submitButton">Create Schedule</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- start model -->
    <div id="oppo" class="modal fade none-border">
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
                            <button class="btn btn-primary submit-btn" id="submitButton">Create Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/calender/jquery-ui.min.js"></script>
    <script src="assets/calender/moment.min.js"></script>
    <script src="assets/calender/fullcalendar.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src='assets/packages/daygrid/main.js'></script>
    <script src='assets/packages/timegrid/main.js'></script>
    <script src='assets/packages/list/main.js'></script>
    <script src='assets/packages/interaction/main.js'></script>
    <script src='assets/packages/datepicker/datepicker.js'></script>
    <script src='assets/packages/colorpicker/bootstrap-colorpicker.min.js'></script>





    <script>

        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            var calendar = $('#calendar').fullCalendar({
                // put your options and callbacks here
                editable: true,
                plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours

                selectable: true,
                selectHelper: true,

                eventSources: [
                    {
                        url: 'api/load.php',
                        type: 'POST',
                        data: {
                            user_id: <?php  echo $_GET['userid']?>
       

                    }
                    }
                ],



                //When u select some space in the calendar do the following:
                select: function (start, end, allDay) {
                    //do something when space selected
                    //Show 'add event' modal
                    $('#event-modal').modal('show');

                },

                //When u drop an event in the calendar do the following:
                eventDrop: function (event, delta, revertFunc) {
                    //do something when event is dropped at a new location
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "api/update.php", // Url to which the request is send
                        type: "POST",
                        data: { start: start, end: end, id: id },
                        success: function (data) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                            $('#success_mes').html(data);

                        }
                    });
                },

                //When u resize an event in the calendar do the following:
                eventResize: function (event, delta, revertFunc) {
                    //do something when event is resized
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "api/update.php", // Url to which the request is send
                        type: "POST",
                        data: { start: start, end: end, id: id },
                        success: function () {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Update');
                        }
                    })

                },

                eventRender: function (event, element) {
                    $(element).tooltip({ title: event.title });
                },

                //Activating modal for 'when an event is clicked'
                eventClick: function (event) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#fullCalModal').modal();

                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "api/delete.php", // Url to which the request is send
                            type: "POST",
                            data: { id: id },
                            success: function (data) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                                $('#success_mes').html(data);

                            }
                        })
                    }

                },
            })

// save patient schedule
            $('#submitButton').on('click', function (e) {

                // stop the form refreshing the page
                var startDate = $('#startDate').val();
                var title = $('#title').val();
                var endDate = $('#endDate').val();
                var text_color = $('#text_color').val();
                var color = $('#color').val();


                var pid = $('#pid').val();
                var uid = $('#uid').val();
                var aid = $('#aid').val();


                // process the form
                $.ajax({
                    type: "POST",
                    url: 'api/insert.php',
                    data: {
                        startDate: startDate,
                        title: title,
                        endDate: endDate,
                        text_color: text_color,
                        color: color,
                        pid: pid,
                        uid: uid,
                        aid: aid,
                    },
                    //  dataType    : 'json',



        success: function (data) {
        if (data == 'Saved') {
            calendar.fullCalendar('refetchEvents');

            swal("Success", "Schedule Updated  :)", "success");

      
        } else if (data == 'Didnt Saved') {
           //our handled error
            swal("Sorry", "Failed to update the Schedule :(", "error");
        } else if (data == 'First approve the appointment') {
           //our handled error
            swal("Sorry", "First approve the appointment :(", "error");
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
        });










    </script>





</body>


<!-- calendar24:03-->

</html>