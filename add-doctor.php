<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
         session_start();
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
<!-- add-doctor24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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
            } 
    
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <!-- fORM STARTS -->

                        <form method="POST" id="doctor_form">
                            <div class="row">

                            <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Prefix <span class="text-danger">*</span></label>
                                        <select class="select" id="prefix" name="prefix">
                                            <option value="Select">Select</option>
                                            <option value="Dr.">Dr</option>
                                        </select>
                                        <span id="prefix_info" class="info text-danger"></span>
                                    </div>
                                </div>


                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="fname" name="fname">
                                        <span id="fname_info" class="info text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="lname" name="lname">
                                        <span id="lname_info" class="info text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            onblur="checkemail();" onkeyup="checkemail();" onchange="checkemail();">
                                        <span id="email_info" class="info text-danger"></span>
                                        <span id="email_status" name="email_status"></span>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password<span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="password" name="password">
                                        <span id="pass" class="info text-danger"></span>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password<span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="con_password"
                                            name="con_password">
                                        <span id="pass1" class="info text-danger"></span>
                                        <span id="invalid" class="info text-danger"></span>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specilization <span class="text-danger">*</span></label>
                                        <select class="select" id="specilization" name="specilization">
                                            <option value="Select">Select</option>

                                            <?php    

                                             require_once 'auth/dbconnection.php';
                                             $sql = "SELECT * FROM doctorspecilization";
                                             if($result = mysqli_query($conn, $sql)){
                                             if(mysqli_num_rows($result) > 0){
                                             while($row = mysqli_fetch_array($result)){
          
                                                     ?>

                                            <option value="<?php echo $row['specilization']; ?>">
                                                <?php echo $row['specilization']; ?></option>
                                            <?php     }}}     ?>
                                        </select>
                                        <span id="typeposs" class="info text-danger"></span><br />
                                    </div>


                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date Of Birth<span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" id="dob"
                                            name="dob">
                                        <span id="dobs" class="info text-danger"></span>

                                    </div>
                                </div>



             
                                
                            </div>

                            <strong> Select gender<span class="text-danger">*</span> </strong> <br> <br>
                            <div class="form-group">
                                <!-- <label class="display-block">Schedule Status</label> -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="yes" value="Male">
                                    <label class="form-check-label" for="product_active"> Male </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="no" value="Female" >
                                    <label class="form-check-label" for="product_inactive"> Female </label>
                                </div>
                            </div>
                            <span id="genders" class="info text-danger"></span>

                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="Register"
                                    value="Create Doctor" id="Register">
                            </div>
                            <center>
                                <div id="success_mes" class="text text-success"> </div>
                            </center> <br>

                        </form>
                        <!-- FORM ENDS -->

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
    $('#dob').attr('max', maxDate);
});



                function checkemail() {
                    var email = document.getElementById("email").value;

                    if (email) {

                        $.ajax({
                            type: 'post',
                            url: "adminquery/checkmail.php", // request file the 'check_email.php'
                            data: {
                                email: email,
                            },

                            success: function (response) {
                                $('#email_status').html(response);
                                if (response == "This Email Address is Already Exist") {
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
                        $('#email_status').html("");
                        return false;

                    }
                }


                //    start query
                $(document).ready(function () {

                    // save DOCTOR to database
                    $(document).on('click', '#Register', function () {

                        var fname = $('#fname').val();
                        var lname = $('#lname').val();
                        var email = $('#email').val();
                        var password = $('#password').val();
                        var con_password = $('#con_password').val();
                        var specilization = $('#specilization').val();
                        var gender = $(".gender:checked").val();
                        var dob = $('#dob').val();
                        var prefix = $('#prefix').val();

                        var valid;
                        valid = validateContact();

                        if (valid) {

                            swal({
                                title: "Are you sure?",
                                text: "You wanna save this Doctor!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Yes, Save It!",
                                closeOnConfirm: false
                            },

                                function (isConfirm) {
                                    if (!isConfirm) return;
                                    $.ajax({
                                        url: "adminquery/add_doctor.php", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {
                                            'fname': fname,
                                            'lname': lname,
                                            'email': email,
                                            'password': password,
                                            'specilization': specilization,
                                            'gender': gender,
                                            'dob': dob,
                                            'prefix': prefix,

                                        },

                                        success: function (response) {


                                            if ($.trim(response) === 'Successfully Saved') {


                                            swal("Saved!", "The Doctor has been Saved", "success");
                                            $('#lname').val('');
                                            $('#fname').val('');
                                            $('#email').val('');
                                            $('#password').val('');
                                            $('#con_password').val('');
                                            $('#specilization').val('');
                                            $('#dob').val('');
                                            $('#prefix').val('');

                                        }else{
                                        swal("Sorry!", "Somthing went wrong !!", "error");''
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

                            var minLength = 8;
                            var value = $("#password").val();

                            if (value.length < minLength) {
                                $("#pass").html("(Password contains Minimum 8 Characters)");
                                valid = false;
                            }

                            if (!$("#dob").val()) {
                                $("#dobs").html("(Required)");
                                $("#dob").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#fname").val()) {
                                $("#fname_info").html("(Required)");
                                $("#fname").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#lname").val()) {
                                $("#lname_info").html("(Required)");
                                $("#lname").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#specilization").val()) {
                                $("#specilization_info").html("(Required)");
                                $("#specilization").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#email").val()) {
                                $("#email_status").html("(Required)");
                                $("#email").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                                $("#email_info").html("(Invalid Email Address)");
                                $("#email").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#password").val()) {
                                $("#pass").html("(Required)");
                                $("#password").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#con_password").val()) {
                                $("#pass1").html("(Required)");
                                $("#password1").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if ($("#password").val() != $("#con_password").val()) {
                                $("#invalid").html("(Password do not match)");
                                // $("#password1").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if (!$("input[name='gender']:checked").val()) {
                    $("#genders").html("(Gender Required)");
                    valid = false;

                     }
                            if ($("#specilization").val() == 'Select') {
                                $("#typeposs").html("(Please select appropriate type)");
                                //    $("#specilization").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if ($("#prefix").val() == 'Select') {
                                $("#prefix_info").html("(Please)");
                                //    $("#specilization").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            return valid;
                        }

                    });



                });





            </script>


</body>




<!-- add-doctor24:06-->

</html>