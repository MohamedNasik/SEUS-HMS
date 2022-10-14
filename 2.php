<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
        ?>
<!-- add-doctor24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS- Medical & Hospital</title>
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
                        <h4 class="page-title">Add Administrators</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <!-- ADD LABOROTORY -->
                        <form method="POST" id="doctor_form">
                            <div class="row">




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

                
              

                      

                            </div>



                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="Register"
                                    value="Create Administrator" id="Register">
                            </div>
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
            <script type="text/javascript" src="assets/ajax/vendor.js"></script>
            <script type="text/javascript" src="assets/ajax/app.js"></script>
            <script src="assets/js/jquery-3.2.1.min.js"></script>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/select2.min.js"></script>
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/js/app.js"></script>


            <script>

                //    start query
                $(document).ready(function () {

                    // save administration to database
                    $(document).on('click', '#Register', function () {

                        var fname = $('#fname').val();
           
                        var lname = $('#lname').val();
           

                        var valid;
                        valid = validateContact();


                        if (valid) {


                            swal({
                                title: "Are you sure?",
                                text: "You wanna save this Admin !",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Yes, Save It!",
                                closeOnConfirm: false
                            },

                                function (isConfirm) {
                                    if (!isConfirm) return;

                                    $.ajax({
                                        url: "adminquery/2.php", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {
                                            'lname': lname,
                                  
                                            'fname': fname,
                              
                                            

                                        },

                                        success: function (response) {

                                            if ($.trim(response) === 'Successfully Saved') {

                                            swal("saved!", "The Admin has been saved!!", "success");

                                            $('#fname').val('');
                                            $('#email').val('');
                           

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
                   
                 



                            return valid;
                        }

                    });



                });

            </script>


</body>




<!-- add-doctor24:06-->

</html>