<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>
<!-- add-schedule24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
    <![endif]-->


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">

    <script src="assets/sweetalert/bestsweet.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>





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
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                  
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
                        <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                            Profile</a>
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
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                        Profile</a>
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Appointment</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <!--  STARTS ADD APPOINTMENTS -->

                        <form id="form_appoint" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient ID<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input type="text" class="form-control" placeholder="Type the Patient ID"
                                                id="p_id" onblur="checkemail();" onkeyup="checkemail();"
                                                onchange="checkemail();">
                                        </div>
                                        <span id="nicinfo" class="info text-danger"></span><br />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient Name<span class="text-danger">*</span></label>
                                        <select class="select" id="patient_name">
                                            <option value="Select Patient Name">Select Patient Name</option>

                                        </select>
                                        <span id="patient" class="info text-danger"></span><br />

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specilization type<span class="text-danger">*</span></label>
                                        <select class="select" id="specilization" name="specilization">
                                            <option value="Select Specilization">Select Specilization</option>

                     <?php    
// php query for change specialization on select box
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
                                        <label>Doctor Name<span class="text-danger">*</span></label>
                                        <select class="select" id="doctor_name" name="doctor_name">
                                            <option value="Select Doctor">Select</option>

                                        </select>
                                        <span id="type" class="info text-danger"></span><br />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Appointment Type<span class="text-danger">*</span></label>
                                        <select class="select" id="typed" name="typed">
                                            <option value="Select type">Select Type</option>
                                            <option value="Consultation">Meet Doctor</option>
                                            <option value="Check Report">Check Report</option>

                                        </select>
                                        <span id="types" class="info text-danger"></span><br />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Appointment Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="date">

                                        <span id="dates" class="info text-danger"></span><br />
                                    </div>
                                </div>
   
                            </div>
                            

                            <div class="row">



                            </div>
                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="achedule"
                                    value="Create Appointment" id="appointment">
                            </div>
                            <br>
                            <center>
                                <div id="success_mes" class="text text-success"> </div>
                            </center> <br>

                        </form>

                    </div>
                </div>
            </div>
            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.php">See all messages</a>
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script>


    <script>

$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#date').attr('min', maxDate);
});


        function checkemail() {

            var p_id = document.getElementById("p_id").value;
            console.log(p_id);
            $.ajax({
                type: 'post',
                url: "adminquery/fetch_patient_name.php", // request file the 'check_email.php'
                data: {
                    p_id: p_id,
                },


                success: function (data) {
                    $("#patient_name").html(data);

                }

            });



        }



        //    start query for change specialization
        $(document).ready(function () {

            $('#specilization').change(function () {

                var doc_spec_id = $(this).val();

                $.ajax({
                    url: "adminquery/fetch_doctor_name.php", // Url to which the request is send
                    method: "POST",             // Type of request to be send, called as method
                    data: { doc_spec_id: doc_spec_id },
                    dataType: "text",

                    success: function (data) {
                        $("#doctor_name").html(data);

                    }

                });


            });


            // save apt to database 
            $(document).on('click', '#appointment', function () {

                var doctor_name = $('#doctor_name').val();
                var specilization = $('#specilization').val();
                var patient_name = $('#patient_name').val();
                var nic = $('#nic').val();
                var typed = $('#typed').val();
                var status = $('#status').val();
                var date = $('#date').val();

                var data = {
                    'doctor_name': doctor_name,
                    'specilization': specilization,
                    'nic': nic,
                    'patient_name': patient_name,
                    'typed': typed,
                    'date': date,

                }

                var valid;
                valid = validateContact();

                if (valid) {
                    swal({
                        title: "Are you sure?",
                        text: "You wanna save this Appointment!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, Save It!",
                        closeOnConfirm: false
                    },

                        function (isConfirm) {
                            if (!isConfirm) return;
                            $.ajax({
                                url: "check_apt.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: data,

                                success: function (response) {
                                    if ($.trim(response) === 'Admin added succesfully!!') {

swal("Success", "Appointment Requested  :)", "success");
    } else if($.trim(response) === 'This Doctor does not available in this time') {
        swal("Sorry", "This Doctor does not available in this time :(", "error");

    } else if($.trim(response) === 'This doctor does not available at this moment') {

        swal("Sorry", "This doctor does not available at this moment !! :(", "error");

    } else if($.trim(response) === 'You have already requested for this date with doctor') {

        swal("Sorry", "You have already requested for this date with doctor !! :(", "error");

    } else if($.trim(response) === 'Time passed') {
        swal("Sorry", "All time were allocated !! :(", "error");

    } else if($.trim(response) === 'Time Expired') {
                        swal("Sorry", "Consultation Time Passed !! :(", "error");

    } else {
        //our handled error
       swal("Sorry", "Failed to Sent. Something went wrong :(", "error");
   }



                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error Saved!", "Please try again", "error");
                                }

                            });


                        });

                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');


                    if (!$("#p_id").val()) {
                        $("#nicinfo").html("(Required)");
                        $("#nic").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if ($("#patient_name").val() == 'Select Patient Name') {
                        $("#patient").html("(Select Patient Name)");
                        // $("#password1").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if ($("#doctor_name").val() == 'Select Doctor') {
                        $("#type").html("(Select Doctor Name)");
                        // $("#selectsss").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if ($("#specilization").val() == 'Select Specilization') {
                        $("#spec").html("(Select specilization)");
                        // $("#password1").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if ($("#typed").val() == 'Select type') {
                        $("#types").html("(Select type)");
                        // $("#password1").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if (!$("#date").val()) {
                        $("#dates").html("(Required)");
                        // $("#date").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    return valid;
                }

            });


        });


    </script>


</body>


<!-- add-schedule24:07-->

</html>