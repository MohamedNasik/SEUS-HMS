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

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>



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
               

                    <?php  if(base64_decode($_GET['type'])=="Check Report") {  ?>

                    <div class="col-sm-7 col-8 text-right m-b-30">
                        
                        <div class="btn-group btn-group-sm">
                        <a href="check_appointments.php?user=<?php echo $_GET['userid'] ?>&p_id=<?php echo $_GET['pid'] ?>"> <button class="btn btn-white">  <i class="fa fa-flask fa-md"></i>Check Report</button> </a>
                        </div>
<?php  

$no= base64_decode($_GET['no']);
$pid= base64_decode($_GET['pid']);
$userid= base64_decode($_GET['userid']);


$stmt7 = $conn->prepare("SELECT * FROM opd_payments WHERE No=?  and p_id=? AND user_id=?");
$stmt7->bind_param("sss",$no,$pid,$userid);
$stmt7->execute();
$result7 = $stmt7->get_result();

if(mysqli_num_rows($result7)>0){
  while($row = $result7->fetch_assoc()) {
    
  if($row['status']=='1'){ 

?>

                        <div class="btn-group btn-group-sm">
                           <a href="#"> <button class="btn btn-white btn-warning" id="cancel" name="cancel"><i class="fa fa-money fa-md"></i>  Cancel Payment</button></a>
                        </div>
<?php  }else{  ?>
    <div class="btn-group btn-group-sm">
                           <!-- <a href="#"> <button class="btn btn-white btn-warning" id="cancel" name="cancel"><i class="fa fa-money fa-md"></i>  Cancel Payment</button></a> -->
                           <a href="#"> <button class="btn btn-white btn-warning" data-toggle="modal" data-target="#myModals" name="pay" id="pays"><i class="fa fa-money fa-md"></i>  Cancel Payment</button></a>

                       
                        </div>


<?php   }}}else{    ?>
    <div class="btn-group btn-group-sm">
                           <a href="#"> <button class="btn btn-white btn-warning" id="cancel" name="cancel"><i class="fa fa-money fa-md"></i>  Cancel Payment</button></a>
                        </div>



    <?php  }  ?>
                    </div>
                    <?php  }?>

                </div>
<?php

$p_ids= base64_decode($_GET['pid']);

 //i dont see your password colom name, so i guess it password
 $stmt = $conn->prepare("SELECT * FROM patients WHERE p_id =? ");
 $stmt->bind_param("s", $p_ids);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows === 0);
 while($row = $result->fetch_assoc()) {
 $username = $row["p_fname"].' '.$row["p_lname"]  ;

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
                                        <?php 
                                        $result = mysqli_query($conn,"
                                        SHOW TABLE STATUS LIKE 'opd_payments' ");  $data = mysqli_fetch_assoc($result); $next_increment = $data['Auto_increment'];
                                        
                                        ?>
                                        <h3 class="text-uppercase">Payslip #<?php echo $next_increment;    ?></h3>
                                        <input type="hidden" id="payment_ids" value=" <?php echo $next_increment;   ?>">
                                        <ul class="list-unstyled">
                                        <li>Appointment No : <span>  <?php echo base64_decode($_GET['apt_id']);    ?></span></li>
                                            <li>Date: <span>  <?php echo base64_decode($_GET['date']);    ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5 class="mb-0"><strong>Dr. <?php echo base64_decode($_GET['name']);    ?></strong></h5></li>
                                        <li><span><?php echo base64_decode($_GET['special']);    ?></span></li>
                                        <!-- <li>Employee ID: NS-0001</li> -->
                                        <!-- <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
                                </div>
                            </div>
                            <?php  if(base64_decode($_GET['type'])=="Check Report") {  ?>

<?php    

$apt_id= base64_decode($_GET['apt_id']);
$date= base64_decode($_GET['date']);
$pid= base64_decode($_GET['pid']);
$userid= base64_decode($_GET['userid']);

$cur_date = date('Y-m-d');




  $stmt5 = $conn->prepare("SELECT * FROM check_report WHERE apt_id=? AND check_date=?  and p_id=? AND user_id=?");
  $stmt5->bind_param("ssss",$apt_id,$date,$pid,$userid);
  $stmt5->execute();
  $result5 = $stmt5->get_result();  
  if($result5->num_rows > 0){ ?>

<h4 class="m-b-10"><strong>Prescription ID selected</strong> <strong><a href="" data-toggle="modal" data-target="#take"><i class="fa fa-edit"> </i> Edit ID </a> </strong></h4>
<?php  }else{ ?>
  
                            
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
                                                                  $pid= base64_decode($_GET['pid']);
                                                                  $userid= base64_decode($_GET['userid']);
                                                              
                                                        $sql = "SELECT pres_id FROM prescription WHERE p_id='".$pid."' AND user_id='".$userid."' ";
                                                        if($result = mysqli_query($conn, $sql)){
                                                        if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_array($result)){
                                                                ?>

                                                      <option value="<?php echo $row['pres_id']; ?>">
                                                       <?php echo $row['pres_id']; ?></option>
                                                              <?php     }}}     ?>
                                                          </select>
                                                         <span id="errors" class="info text-danger"></span>
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


 <?php }   } ?>
<br>

<?php 
$special= base64_decode($_GET['special']);

$stmt1 = $conn->prepare("SELECT * FROM doctorspecilization WHERE specilization=? ");
$stmt1->bind_param("s",$special  );
$stmt1->execute();
$result1 = $stmt1->get_result();
if(mysqli_num_rows($result1)>0){
while($row = $result1->fetch_assoc()) {
$fees= $row['fees'];
$doc_spec_id= $row['doc_spec_id'];

  }}

  $no= base64_decode($_GET['no']);
  $pid= base64_decode($_GET['pid']);
  $userid= base64_decode($_GET['userid']);


  $stmt11 = $conn->prepare("SELECT * FROM opd_payments WHERE No=?  and p_id=? AND user_id=?");
  $stmt11->bind_param("sss",$no,$pid,$userid);
  $stmt11->execute();
  $result11 = $stmt11->get_result();

?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <h4 class="m-b-10"><strong>Billing</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>

                                        
                                                <tr>
                                                    <td><strong>Doctor Channelling Charge</strong> <span class="float-right">Rs.  <?php echo  $fees;  ?></span></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" id="no" value="<?php echo  base64_decode($_GET['no']);  ?>">
                                <input type="hidden" id="apt_date" value="<?php echo  base64_decode($_GET['date']);  ?>">

                        <input type="hidden" id="apt_id" value="<?php echo  base64_decode($_GET['apt_id']);  ?>">
                        <input type="hidden" id="user_id" value="<?php echo  base64_decode($_GET['userid']);  ?>">
                        <input type="hidden" id="p_id" value="<?php echo  base64_decode($_GET['pid']);  ?>">
                        <input type="hidden" name="fees" id="fees" value="<?php echo $fees   ?>">
                        <input type="hidden" name="doc_spec_id" id="doc_spec_id" value="<?php echo $doc_spec_id   ?>">

                        <?php  
  if(mysqli_num_rows($result11)>0){
    while($row = $result11->fetch_assoc()) {
      

    $msg= "(Payment Proceeded)"; ?>

                                <div class="col-sm-12">
                                <a href="#">   <p><strong> <?php echo $msg  ?></strong> </p>  </a>                            
                                </div>
                                <div class="m-t-20 text-center">

                                <?php    if($row['status']=='1'){  ?>
           <input type="button" class="btn btn-primary submit-btn" data-toggle="modal" data-target="#myModal" name="pay"value="Paid" id="pays">

<?php   }  if($row['status']=='4'){ ?>

<input type="button" class="btn btn-primary submit-btn" name="pay"value="Pay" id="pay" >
<?php   }  elseif($row['status']=='2'){ ?>
    <input type="button" class="btn btn-danger submit-btn" name="pay"value="Refunded"  >
<?php } ?>
                            </div>
                                
  <?php } }else{  ?>
                             <div class="col-sm-12">
                                    <p><strong>Net Total: Rs.  <?php echo $english_format_number = number_format($fees);  ?></strong> </p>                             
                                </div>
                                <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="pay"value="Pay" id="pay">


                            </div>  








  <?php  } ?>




                            </div>
                            <div class="col-sm-7 col-8 text-right m-b-30">

<div class="btn-group btn-group-sm">
       <a href="payment/opd_payment.php?print=1&no=<?php echo base64_decode($_GET['no']);   ?>"> <button class="btn btn-white" id="print" name="cancel"><i class="fa fa-print"></i> Print</button></a>
    </div> </div>
                        </div>
                        
                    </div>
                </div>
            </div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="alert alert-success alert-dismissible">
            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>You </strong> Successfully paid !
          </div>
    </div>
  </div>

  <div class="modal fade" id="myModals" role="dialog">
    <div class="modal-dialog">
        <div class="alert alert-warning alert-dismissible">
            <a  class="close" data-dismiss="modal" aria-label="close">&times;</a>
            <strong>You </strong> Cancelled Payment !
          </div>
    </div>
  </div>



<!--  prescribe another doctor -->
<div id="take" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <center> <span class="dash-widget-bg1"><i class="fa fa-user-md"></i> </span>
                        <h3> Sure to Edit this ID ?</h3>
                    </center>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-body">
               

                    <div class="row">
                                <div class="col-sm-12">
                                   
                                        <h4 class="m-b-10"><strong>Enter the Prescription ID for report checking</strong></h4>
                                        <table class="table table-bordered">
                                        <thead>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                    <div class="form-group">
                                                         <label>Prescription ID <span class="text-danger">*</span></label>
                                                         <select class="select" id="enter_press" name="enter_press">
                                                                 <option value="Select">Select</option>
                                                              <?php  
                                                               $pid= base64_decode($_GET['pid']);
                                                               $userid= base64_decode($_GET['userid']);
 
                                                              
                                                        $sql = "SELECT pres_id FROM prescription WHERE p_id='".$pid."' AND user_id='".$userid."' ";
                                                        if($result = mysqli_query($conn, $sql)){
                                                        if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_array($result)){
                                                                ?>

                                                      <option value="<?php echo $row['pres_id']; ?>">
                                                       <?php echo $row['pres_id']; ?></option>
                                                              <?php     }}}     ?>
                                                          </select>
                                                         <span id="errors" class="info text-danger"></span>
                                                     </div>                                 
                                                    </td> 
                                                </tr>
                                                <tr>
                                                    <td><strong> </strong> <span class="float-right"><input type="button" name="enter_pres_but" id="enter_pres_buts" class="btn btn-primary" value="Submit"></span></td>                                        
                                                </tr>                                          
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>








                    </div>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
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
var apt_date = $('#apt_date').val();

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
            // 'payment_id': payment_id,     
            'user_id': user_id,     
            'fees': fees,     
            'apt_id': apt_id,     
            'p_id': p_id,     
            'doc_spec_id': doc_spec_id,     
            'no': no,     
            'apt_date': apt_date,     

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

// var no_payment_id = $('#payment_ids').val();
var no_payment_id = "no";

var user_id = $('#user_id').val();
var apt_id = $('#apt_id').val();
var p_id = $('#p_id').val();
var docspecid = $('#doc_spec_id').val();
var no = $('#no').val();
var apt_date = $('#apt_date').val();
var fees = $('#fees').val();



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
            'user_id': user_id,
            'apt_id': apt_id,
            'p_id': p_id,
            'docspecid': docspecid,
            'no_payment_id': no_payment_id,
            'no': no,
            'apt_date': apt_date,     
            'fees': fees,     

        },
        success: function (data) {
        if (data == 'Payment Proceeds') {
            swal("Success", "Payment has been Updated :)", "success");
            setTimeout(function () {
          //Redirect with JavaScript
          window.location.href= 'patient_payments.php';
}, 1500);

        } 
        
        else {
           //our handled error
           swal("Sorry", "Failed to proceed. Select Prescription ID :(", "error");
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
var user_id = $('#user_id').val();
var p_id = $('#p_id').val();
var apt_date = $('#apt_date').val();

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
            'apt_date': apt_date,

        },
        success: function (data) {
        if (data == 'Successfully saved') {
            swal("Success", "Prescription ID#  "+ pres_id + " has been saved :)", "success");
            $("#take").modal('hide');
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

                    if ($("#enter_pres").val() == 'Select') {
                        $("#errors").html("(Select Prescription)");
                        valid = false;
                    }
                    return valid;
                }

});

// 

// enter prescription

$(document).on('click', '#enter_pres_buts', function () {
var apt_date = $('#apt_date').val();

var apt_id = $('#apt_id').val();
var user_id = $('#user_id').val();
var p_id = $('#p_id').val();
var pres_id = $('#enter_press').val();

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
            'apt_date': apt_date,

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



                    if ($("#enter_press").val() == 'Select') {
                        $("#errors").html("(Select Prescription)");
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