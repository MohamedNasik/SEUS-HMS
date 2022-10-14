<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();
include ('auth/dbconnection.php');
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


?>

<!-- salary-view23:28-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

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
                        <span>You</span>
                    </a>
					<div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
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
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Payslip</h4>
                    </div>
                </div>
<?php

 $date=   date('dS F Y', strtotime($_GET['date']));

?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Payslip for  <?php echo $_GET['p_name'];    ?>   </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                    <ul class="list-unstyled mb-0">
                                        <li>SEUS Hospital</li>
                                        <li>No. 22, Kahagolla Road</li>
                                        <li> Bandarawela</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">

                                        <h3 class="text-uppercase">Payslip #<?php echo $_GET['opd_id'];    ?></h3>
                                        <ul class="list-unstyled">
                                        <li>Appointment No : <span>  <?php echo $_GET['aptid'];    ?></span></li>
                                            <li>Date: <span>  <?php echo $date;    ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5 class="mb-0"><strong>Dr. <?php echo $_GET['username'];    ?></strong></h5></li>
                                        <li><span><?php echo $_GET['spec'];    ?></span></li>
                                        <!-- <li>Employee ID: NS-0001</li> -->
                                        <!-- <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
                                </div>
                            </div>

<br>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <h4 class="m-b-10"><strong>Billing</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Doctor Channelling Charge</strong> <span class="float-right">Rs.  <?php echo  $_GET['fees'];  ?></span></td>
                                                
                                                </tr>
                                                <tr>
                                                    <td><strong>Appointment Type</strong> <span class="float-right">  <?php echo  $_GET['type'];  ?></span></td>
                                                
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        <input type="hidden" id="apt_id" value="<?php echo  $_GET['apt_id'];  ?>">
                        <input type="hidden" id="user_id" value="<?php echo  $_GET['userid'];  ?>">
                        <input type="hidden" id="p_id" value="<?php echo  $_GET['pid'];  ?>">
                        <input type="hidden" name="fees" id="fees" value="<?php echo $fees   ?>">
                        <input type="hidden" name="doc_spec_id" id="doc_spec_id" value="<?php echo $doc_spec_id   ?>">

                                <div class="col-sm-12">

                                    <!-- <p><strong>Net Total: Rs.  <?php echo $english_format_number = number_format($_GET['fees'] );  ?></strong> </p>                              -->
                                   <p><strong>Net Total: Rs.  <?php echo $_GET['fees'] ; 
                                  
                                //   $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                //    echo $f->format($_GET['fees']);
                                   
                            
                                   
                                   
                                   ?></strong>
                                
                                
                                </p>                             
                                </div>
                                <?php  if($_GET['status']=="2") {    ?>
                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="pay"value="Refunded" id="pay" disabled>
                            </div>
                            <?php  } elseif($_GET['status']=="1"){  ?>

                            <div class="m-t-20 text-center">
                         <input type="button" class="btn btn-primary submit-btn" name="refund"value="Paid" id="refund" disabled>
                                     </div>
                            <?php  }?> 

                        
                     
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
    <script src="assets/js/app.js"></script>
    <script src="assets/js/select2.min.js"></script>

    <script src="assets/datatable/dataTables.bootstrap.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>

<script>


//    start query
$(document).ready(function () {

// update payment to 1 to database 
$(document).on('click', '#pay', function () {

var user_id = $('#user_id').val();
var fees = $('#fees').val();
var apt_id = $('#apt_id').val();
var p_id = $('#p_id').val();
var doc_spec_id = $('#doc_spec_id').val();


    swal({
title: "Are you sure?",
text: "You wanna proceed this payment!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Proceed It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
        url: "payment/opd_payment.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {
            // 'payment_id': payment_id,     
            'user_id': user_id,     
            'fees': fees,     
            'apt_id': apt_id,     
            'p_id': p_id,     
            'doc_spec_id': doc_spec_id,     

        },
        success: function (data) {
        if (data == 'Payment Proceeds') {
            swal("Success", "Payment has been Updated :)", "success");
            setTimeout(function () {
          //Redirect with JavaScript
          window.location.href= 'patient_payments.php';
}, 1500);

        } else {
           //our handled error
            swal("Sorry", "Failed to proceed payment. Try it by later :(", "error");
        }
    },
    error: function (data) {
           //other errors that we didn't handle
        swal("Sorry", "Failed to send order. Please try later :(", "error");
    }
    });

});
});



// no need to pay database 
$(document).on('click', '#cancel', function () {
var no_payment_id = $('#payment_id').val();

swal({
title: "Are you sure?",
text: "You wanna proceed this payment!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Proceed It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
        url: "payment/opd_payment.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {
            'no_payment_id': no_payment_id,           
        },
        success: function (data) {
        if (data == 'Payment Proceeds') {
            swal("Success", "Payment has been Updated :)", "success");
            setTimeout(function () {
          //Redirect with JavaScript
          window.location.href= 'patient_payments.php';
}, 1500);

        } else {
           //our handled error
            swal("Sorry", "Failed to proceed payment. Try it by later :(", "error");
        }
    },
    error: function (data) {
           //other errors that we didn't handle
        swal("Sorry", "Failed to send order. Please try later :(", "error");
    }
    });

});

});




// enter prescription

$(document).on('click', '#enter_pres_but', function () {

var apt_id = $('#apt_id').val();
var pres_id = $('#enter_pres').val();
var user_id = <?php echo $_GET['userid'] ?>;
var p_id = <?php echo $_GET['pid'] ?>

var valid;
valid = validateContacts();
if (valid) {

    swal({
title: "Are you sure?",
text: "You wanna send this Prescription!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Update It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
        url: "payment/send_pres.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: {
            'pres_id': pres_id,   
            'apt_id': apt_id,           
            'user_id': user_id,           
            'p_id': p_id,           
        },
        success: function (data) {
        if (data == 'Successfully saved') {
            swal("Success", "Prescription ID#  "+ pres_id + " has been saved :)", "success");
            setTimeout(function () {

          //remove form
          $('#desable').html('');
        }, 1500);


        } else {
           //our handled error
            swal("Sorry", "Failed to proceed . Try it later :(", "error");
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
function validateContacts() {
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    if ($("#enter_pres").val() == $("#Select").val()) {
        $("#errors").html("(Please Select Priscription ID)");
        valid = false;
    }
        return valid;
           }

});



});



</script>






</body>



<!-- salary-view23:28-->
</html>