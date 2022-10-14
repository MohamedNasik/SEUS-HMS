<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();
         require_once 'auth/dbconnection.php';

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

  //  redirect to main page according to the user role 

  if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
    header("location: index.php");
    exit;
 }
 
 if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
    header("location: index-lab.php");
    exit;
 }

 if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
    header("location: index-recep.php");
    exit;
 }



        ?>
<!-- add-schedule24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="assets/date1/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">

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
            } 
            if( $_SESSION['role_id']=='4'){
                include ('sidebar/receptionist.php');
                        } 
            
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Schedule</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <form id="form_appoint" method="POST">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specilization type</label>
                                        <select class="select" id="specilization" name="specilization">
                                            <option value="Select Specilization">Select Specilization</option>

    <?php    

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
                                        <label>Doctor Name</label>
                                        <select class="select" id="doctor_name" name="doctor_name"
                                            onblur="checkemail();" onkeyup="checkemail();" onchange="checkemail();">
                                            <option value="Select Doctor">Select</option>

    <?php    
    $sql = "SELECT * FROM users WHERE role_id='2' ";
        if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          ?>
                                            <option value="<?php echo $row['user_id']; ?>">
                                                <?php echo $row['username']; ?></option>


                                            <?php  }}}?>


                                        </select><br>
                                        <span id="type" class="info text-danger"></span><br />
                                        <span id="email_status" name="email_status" class="text text-danger"></span>
                                    </div>
                                </div>

                            </div>

                           
                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="schedule"
                                    value="Create Schedule" id="schedule">
                            </div>
                            <br>
                            <center>
                                <div id="success_mes" class="text text-success"> </div>
                            </center> <br>

                        </form>
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
            <script src="assets/js/jquery-ui.min.php"></script>
            <script src="assets/js/fullcalendar.min.js"></script>
            <script src="assets/js/jquery.fullcalendar.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/js/app.js"></script>


            <script>


                function checkemail() {
                    var name = document.getElementById("doctor_name").value;

                    if (name) {

                        $.ajax({
                            type: 'post',
                            url: "adminquery/checkname.php", // request file the 'check_email.php'
                            data: {
                                name: name,
                            },

                            success: function (response) {
                                $('#email_status').html(response);
                                if (response == "Already added to the schedule") {
                                    $("email_status").fadeIn().html(response);
                                    $('input:button').attr('disabled', true);

                                    return false;
                                }
                                else {
                                    $('input:button').attr('disabled', false);

                                    return true;
                                }
                            }
                        });
                    }
                    else {
                        $('#email_status').html("Select Doctor");
                        return false;

                    }
                }

            </script>



            <script>

                //    start query
                $(document).ready(function () {

                    // save schedule to database
                    $(document).on('click', '#schedule', function () {

                        var doctor_name = $('#doctor_name').val();
                        var specilization = $('#specilization').val();

                        var datas = {
                            'doctor_name': doctor_name,
                            'specilization': specilization,
                        }

                        var datas = JSON.stringify(datas);

                        var valid;
                        valid = validateContact();

                        if (valid) {

                            $.ajax({
                                url: "adminquery/addschedule.php", // Url to which the request is send
                                method: "POST",             // Type of request to be send, called as method
                                data: {
                                    //index1: timetable, 
                                    index2: datas
                                },
                                //dataType:'json',             
                                cache: false,



                                success: function (response) {

                                    $('#doctor_name').val('');
                                    $('#specilization').val('');


                                    $('#success_mes').fadeIn().html(response);

                                    $("success_mes").fadeIn().html(response);
                                    setTimeout(function () {
                                        $('#success_mes').fadeOut("Slow");
                                    }, 2000);

                                }

                            });
                        };

                        // check validations
                        function validateContact() {
                            var valid = true;
                            $(".demoInputBox").css('background-color', '');
                            $(".info").html('');


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


                            return valid;
                        }

                    });


                });


            </script>


</body>


<!-- add-schedule24:07-->

</html>