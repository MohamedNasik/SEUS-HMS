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
                    <?php  if($_GET['type']=="Check Report") {  ?>

                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                        <a href="check_appointments.php"> <button class="btn btn-white">  <i class="fa fa-flask fa-md"></i>Check Report</button> </a>
                        </div>
                        <div class="btn-group btn-group-sm">
                           <a href="#"> <button class="btn btn-white btn-warning" id="cancel" name="cancel"><i class="fa fa-money fa-md"></i>  Cancel Payment</button></a>
                        </div>
                    </div>
                    <?php  }?>

                </div>
<?php
 //i dont see your password colom name, so i guess it password
 $stmt = $conn->prepare("SELECT * FROM patients WHERE p_id =? ");
 $stmt->bind_param("s",$_GET['pid'] );
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows === 0);
 while($row = $result->fetch_assoc()) {
 $username = $row['p_fname'].' '.$row['p_lname'];

 }

?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Payslip for  <?php echo $username    ?>   </h4>
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
                                        <li>Appointment No : <span>  <?php echo $_GET['apt_id'];    ?></span></li>

                                            <li>Date: <span>  <?php echo $_GET['date'];    ?></span></li>
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
                            <?php  if($_GET['type']=="Check Report") {  ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="desable">
                                        <h4 class="m-b-10"><strong>Enter the Prescription ID for report checking</strong></h4>
                                        <table class="table table-bordered">
                                        <thead>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                    <div class="form-group">
                                                         <label>Prescription ID <span class="text-danger">*</span></label>
                                                         <select class="select" id="enter_pres" name="enter_pres">
                                                                 <option value="Select">Select</option>
                                                              <?php    
                                                        $sql = "SELECT pres_id FROM prescription WHERE p_id='".$_GET['pid']."'";
                                                        if($result = mysqli_query($conn, $sql)){
                                                        if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_array($result)){
                                                                ?>

                                                      <option value="<?php echo $row['pres_id']; ?>">
                                                       <?php echo $row['pres_id']; ?></option>
                                                              <?php     }}}     ?>
                                                          </select>
                                                         <span id="error" class="info text-danger"></span>
                                                     </div>                                 
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td><strong> </strong> <span class="float-right"><input type="button" name="enter_pres_but" id="enter_pres_but" class="btn btn-primary" value="Submit"></span></td>                                        
                                                </tr>                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php   } ?>
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
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        <input type="hidden" id="apt_id" value="<?php echo  $_GET['apt_id'];  ?>">
                        <input type="hidden" id="payment_id" value="<?php echo  $_GET['opd_id'];  ?>">
                        <input type="hidden" name="fees" id="fees" value="<?php echo $_GET['fees']   ?>">
                        <input type="hidden" name="no" id="no" value="<?php echo $_GET['no']   ?>">

                                <div class="col-sm-12">
                                    <p><strong>Net Total: Rs.  <?php echo $english_format_number = number_format($_GET['fees']);  ?></strong> </p>                             
                                </div>
                            <?php  if($_GET['status']=="2") {    ?>
                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="pay"value="Pay" id="pay">
                            </div>
                            <?php  } elseif($_GET['status']=="1"){  ?>

                            <div class="m-t-20 text-center">
                         <input type="button" class="btn btn-primary submit-btn" name="refund"value="Refund" id="refund">
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
var payment_id = $('#payment_id').val();
var fees = $('#fees').val();
var no = $('#no').val();


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
            'payment_id': payment_id,     
            'fees': fees,     

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


// update refund to 2 to database 
$(document).on('click', '#refund', function () {

var payment_id_2 = $('#payment_id').val();
var apt_id = $('#apt_id').val();
var no = $('#no').val();



    swal({
title: "Are you sure?",
text: "You wanna refund this payment!",
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
            'payment_id_2': payment_id_2,   
            'apt_id': apt_id,           
            'no': no,           

        },
        success: function (data) {
        if (data == 'Payment refund') {
            swal("Success", "Payment has been refunded :)", "success");
            setTimeout(function () {
          //Redirect with JavaScript
             window.location.href= 'patient_payments.php';
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
var user_id = <?php echo $_GET['user_id'] ?>;
var p_id = <?php echo $_GET['pid'] ?>

var valid;
valid = validateContact();
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
function validateContact() {
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

    if ($("#enter_pres").val() == $("#Select").val()) {
        $("#error").html("(Please Select Priscription ID)");
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