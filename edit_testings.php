<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
require_once ('auth/dbconnection.php');
        ?>

<!-- edit-department24:07-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
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




    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
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
                        <span>You</span>
                    </a>
					<div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
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
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form>
						
                        <div class="form-group">
                                <label>Testing Description</label>
                                <textarea cols="30" rows="4" class="form-control" id="testing_description"  name="testing_description"></textarea>
                                <span id="desc_info" class="info text-danger"></span>

                            </div>

                            <div class="form-group">
                            <label>Testing Fees</label>
                                  <div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Rs</span>
											</div>
                                            <input type="number" class="form-control" id="testing_charge"  name="testing_charge">
											<div class="input-group-append">
												<span class="input-group-text">.00</span>
											</div>                                      
                                        </div>
                                        <span id="charge_info" class="info text-danger"></span>
                                    </div>
                             <input type="hidden" name="testid" id="testid" 
                                         value="<?php echo $_GET['test_id'];   ?>">


                          <div class="form-group">
                                <label class="display-block">Blog Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input test_status " type="radio" name="test_status" id="test_status"  value="Active" >
									<label class="form-check-label" for="blog_active">
									Active
									</label>
                                    </div>
								<div class="form-check form-check-inline">
									<input class="form-check-input test_status" type="radio" name="test_status" id="test_status"  value="inactive" checked>
									<label class="form-check-label" for="blog_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                            <input class="btn btn-primary submit-btn" type="button" id="change" value="Save Changes">
                               
                            </div>
                      
                        </form>
                    </div>
                </div>
            </div>
			
    <div class="sidebar-overlay" data-reff=""></div>
     <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
  
    <script src="assets/js/app.js"></script>



<script>
$(document).ready(function () {

// change test to database
$(document).on('click', '#change', function () {

var test_id = $('#testid').val();
var testing_charge = $('#testing_charge').val();
var testing_description = $('#testing_description').val();
var testing_status = $('.test_status:checked').val();

var valid;
valid = validateContact();

if (valid) {

    swal({
title: "Are you sure?",
text: "You wanna change this Testing!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Change It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
        url: "adminquery/update_testings.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {
            'testing_charge': testing_charge,
            'testing_description': testing_description,
            'test_id': test_id,
            'testing_status': testing_status,

            
        },
        success: function (data) {
        if (data == 'Testing Updated Successfully') {
            swal("Success", "Updated Successfully :)", "success");

            $('#curpass').val('');
            $('#newpass').val('');
            $('#conpass').val('');
        } else {
           //our handled error
            swal("Sorry", "Failed to Updated Testing. Try it by correct password :(", "error");
        }
    },
    error: function (data) {
           //other errors that we didn't handle
        swal("Sorry", "Failed to send order. Please try later :(", "error");
    }


    });

});


 
};

// check validations
function validateContact() {
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    if (!$("#testing_charge").val()) {
        $("#charge_info").html("(Required)");
     //   $("#testing_charge").css('background-color', '#FFFFDF');
        valid = false;
    }
    if (!$("#testing_description").val()) {
        $("#desc_info").html("(Required)");
       // $("#testing_description").css('background-color', '#FFFFDF');
        valid = false;
    }
  


    return valid;
}

});

});





</script>









</body>


<!-- edit-department24:07-->
</html>
