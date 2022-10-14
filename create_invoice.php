<!DOCTYPE html>
<html lang="en">
<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }


include ('doctorquery/fetch_select.php');

?>

<!-- invoice-view24:07-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Invoice</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
             
                        </div>
                    </div>
                </div>

<?php
  include ('auth/dbconnection.php');

   $stmt = $conn->prepare("SELECT * FROM testing_schedule as t INNER JOIN prescription AS p ON t.pres_id=p.pres_id INNER JOIN users as u ON u.user_id=p.user_id INNER join doctor_specialist as ds ON ds.user_id=u.user_id  AND p.pres_id=? ");
   $stmt->bind_param("s", $_GET['pre_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  ;
   while($row = $result->fetch_assoc()) {
    $username= $row['fname'].' '.$row['lname'];
    $pres_id= $row['pres_id'];

    $specilization= $row['specilization'];
    $pres_date=   date('dS F Y', strtotime($row['date']));
    $sub_date=   date('dS F Y', strtotime($row['submit_date']));
   }
 ?>

                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row custom-invoice">
                                    <div class="col-6 col-sm-6 m-b-20">
                                        <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                        <ul class="list-unstyled">
                                           <strong> <li>SEUS Hospital</li>  </strong>
                                            <li>No, 22 Kahagolla</li>
                                            <li>Diyatalawa</li>
                                            <li>Srilanka</li>
                                        </ul>
                                    </div>
                                    <div class="col-6 col-sm-6 m-b-20">
                                        <div class="invoice-details">
                                            <h3 class="text-uppercase">Invoice</h3>
                                            <ul class="list-unstyled">
                                                <li>Date: <span>  <?php  echo   date('dS F Y', strtotime(date('Y-m-d', time()))); ?>
</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 m-b-20">
										
											<h5>Invoice to:</h5>
											<ul class="list-unstyled">
												<li>
													<h5><strong><a href="#"><?php  echo $_GET['pname'];   ?></a></strong></h5>
												</li>
												<li><span>Prescription ID : </span> <a href="#"><?php  echo $pres_id  ?></a></li>
												<li>Test Submitted Date : <a href="#"><?php   echo $sub_date    ?></a></li>
											
											</ul>
										
                                    </div>
                                    <div class="col-sm-6 col-lg-6 m-b-20">
										<div class="invoices-view">
											<span class="text-muted">Doctor Details:</span>
											<ul class="list-unstyled invoice-payment-details">
												<li>
													<h5>Doctor Name :   <span><a href="#"><?php   echo $username    ?></a></span></h5>
												</li>
												<li>Specilization :    <span><a href="#"><?php   echo     $specilization   ?></a></span></li>
												<li>Prescription Date :  <span><a href="#"><?php   echo $pres_date    ?></a></span></li>
											
											</ul>
										</div>
                                    </div>
                                </div>
                                <form>
                         
                             
                         <div class="table-responsive">
                         
                         
                         <table class="datatable table table-stripped ">
                                     <thead>
                                     <tr>
                                     <th>Test ID</th>
                         
                                   <th>Test Name</th>
                                   <th>Payment Status</th>
                               </tr>
                                     </thead>
                                     <tbody>
                                  
                         <?php
                         include ('auth/dbconnection.php');
                         
                         $stmt = $conn->prepare("SELECT * FROM testing_schedule as t INNER JOIN prescription AS p ON t.pres_id=p.pres_id INNER JOIN users as u ON u.user_id=p.user_id INNER JOIN testings as ts ON ts.test_id=t.test_id  AND p.pres_id=? ");
                         $stmt->bind_param("s", $_GET['pre_id']);
                         $stmt->execute();
                         $result = $stmt->get_result();
                         if($result->num_rows === 0)  ;
                         while($row = $result->fetch_assoc()) {
                             $test_id= $row['test_id'];
                         
                         $testing_perform= $row['testing_perform'];
                         // $date=   date('dS F Y', strtotime($row['submit_date']));
                         
                         ?>
                         
                                     <tr>
                                     <td><?php echo $test_id;   ?></td>
                         
                                     <td><a href="#"><?php echo $testing_perform;   ?></a></td>
                                  
                         
                                         <td>
                         
 <?php    if( $row['payment_status']=='1' ) {   ?>
<span class="custom-badge status-blue">Willing to pay </span>
<?php   } elseif( $row['payment_status']=='0' ) {   ?>
    <span class="custom-badge status-orange">Pay later</span>
<?php  }  elseif( $row['payment_status']=='3' ) {   ?>
    <span class="custom-badge status-red">Cancelled</span>
    <?php  }  elseif( $row['payment_status']=='2' ) {   ?>
        <span class="custom-badge status-green">Paid</span>
    <?php } ?>
                         
                         </td>
                         
                                    
                                     </tr>
                                 
                         <?php           }
                         
                         
                         ?>                                 
                                     </tbody>
                                 </table>
                         
                                                     </div>
                                                     <div class="row">
                                                     <div class="col-sm-12">
                                                 <h4 class="page-title">Create Invoice</h4>
                                             </div>
                                                         <div class="col-md-12 col-sm-12">
                                                             <div class="table-responsive">
                                                                 <table class="table table-hover table-white">
                                                                     <thead>
                                                                         <tr>
                                                                             <th class="col-sm-1">Test ID</th>
                                                                             <th class="col-md-6">Test Name</th>
                                                                             <th style="width:100px;">Amount</th>
                                                                 
                         
                                                                             <th> Action</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody id="rows">
                                                                         <tr>
                                                                             <td>
                                                                                 <input class="form-control test_id" type="text" style="width:200px" id="test_id" onblur="checkname(this);" onkeyup="checkname(this);" onchange="checkname(this);">
                                                                             </td>
                                                                             <td>
                                                                             <input  type="text" style="width:300px" class="form-control test_name"  readonly="" id="test_name"  onblur="checkname();" onkeyup="checkname();" onchange="checkname();">
                                                                             </td>
                                                                             <td>
                                                                                 <input  type="text" style="min-width:100px" class="form-control amount" name="amount" readonly="">
                                                                             </td>
                                                                        
                                                                             <td><center> <a href="javascript:void(0)" class="text-success font-18" title="Add" id="add"><i class="fa fa-plus"></i></a> </center> </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                                 
                                                             </div>
                                                             <div class="table-responsive">
                                                                 <table class="table table-hover table-white">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td></td>
                                                                             <td></td>
                                                                             <td></td>
                                                                             <td></td>
                                                                             <td class="text-right">Total</td>
                                                                             <td style="text-align: right; padding-right: 30px;width: 230px">
                                                                             <input class="form-control text-right form-amt" value="0" readonly="" type="text" id="sub"></td>
                                                                         </tr>
                                                                   
                                                                   
                                                                         <tr>
                                                                             <td colspan="5" style="text-align: right; font-weight: bold">
                                                                                 Grand Total
                                                                             </td>
                                                                             <td style="text-align: right; padding-right: 30px; font-weight: bold; font-size: 16px;width: 230px">
                                                                             <span id="total_price"></span>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                  
                                                         <center>    <span id="test_id_info" class="info text-danger"></span>  </center>

                                                             <!-- <div class="row">
                                                                 <div class="col-md-12">
                                                                     <div class="form-group">
                                                                         <label>Other Information</label>
                                                                         <textarea class="form-control" id="description"></textarea>
                                                                     </div>
                                                                 </div>
                                                             </div> -->
                                                         </div>
                                                     </div>
                                                <input type="hidden" id="p_id" value="<?php  echo $_GET['id'];     ?>">
                                                <input type="hidden" id="pres_id" value="<?php  echo  $pres_id     ?>">
                                                <input type="hidden" id="name" value="<?php  echo  $_GET['pname']     ?>">


                                                     <div class="text-center m-t-20">
                                                         <input type="button" class="btn btn-primary submit-btn" name="pay"value="Generate Invoice" id="pay">
                                                     </div>
                                                 </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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



    <script>

function checkname(el)
    {  
    var test_id = $(el).val();//get that value  
    $.ajax({
        type: 'post',
        url: "adminquery/fetch_test_name.php", // request file the 'check_email.php'
        data: {'test_id': test_id,},
    success: function (data) {
     //get closest tr and find class with .test_name 
      $(el).closest('tr').find('.test_name').val(data);
        }
       });


    var testid = $(el).val();//get that value  
    $.ajax({
        type: 'post',
        url: "adminquery/fetch_test_name.php", // request file the 'check_email.php'
        data: {'testid': testid,},
    success: function (data) {
     //get closest tr and find class with .test_name 
      $(el).closest('tr').find('.amount').val(data);
   

        }
       });

       sumIt();

     } 

function sumIt() {
var total = 0, val;
  
$('.amount').each(function() {
 val = $(this).val();
 val = isNaN(val) || $.trim(val) === "" ? 0 : parseFloat(val);
 total += val;
  });
  $('#total_price').html(Math.round(total));
  $('#sub').val(Math.round(total));
}

$(function() {

  $(document).on('change', '.amount', sumIt);
  sumIt() // run when loading
});


//  Add text boxes 

$(document).ready(function(){


var count=0;
$(document).on('click','#add',function() {
    debugger;

    count++; 

    var html= '';
    html += '<tr id="trrows">';

    html += '<td id="testid"> <input id="test_id" class="form-control test_id" type="text" style="width:200px" onblur="checkname(this);" onkeyup="checkname(this);" onchange="checkname(this);" onblur="sum(this);" onkeyup="sum(this);" onchange="sum(this);"> </td>';
    html += '<td id="testname"> <input id="test_name"  type="text" style="width:300px" class="form-control test_name"  readonly="" onblur="checkname();" onkeyup="checkname();" onchange="checkname();"> </td>';
    html += '<td id="amounts">  <input id="amount" name="amount" type="text" style="min-width:150px" class="form-control amount"  readonly="" > </td>';
    html += '<td><center> <a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove" id="remove"><i class="fa fa-trash-o"></i></a></center> </td>';
    html +=  '</tr>';

    $('#rows').append(html);
    sumIt();

});

$(document).on('click','.remove',function() {
$(this).closest("#trrows").remove();

sumIt();

});


});

//  generate bill 

$(document).on('click', '#pay', function () {

var test_id = new Array();
$('input[id="test_id"]').each(function() {
    test_id.push(this.value);
});

var amount = new Array();
$('input[name="amount"]').each(function() {
    amount.push(this.value);
});

var p_id = $('#p_id').val();
var pres_id = $('#pres_id').val();
// var description=$('#description').val();
var name = $('#name').val();

var valid;
valid = validateContact();

if (valid) {

    swal({
title: "Are you sure?",
text: "You wanna proceed this Payment!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Proceed It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
        url: "payment/test_payments.php", // Url to which the request is send
        method: "POST",             // Type of request to be send, called as method
        data: {   
    'test_id': test_id,
    'amount': amount,
    'p_id': p_id,  
    'pres_id': pres_id
    // 'description':description
    },     
      //  cache: false,


        success: function (data) {
        if (data == 'error') {
  
    //our handled error
    swal("Sorry", "Something Went Wrong. Please try again later:(", "error");
        

        } else {

swal("Success", "Invoice has been Generated :)", "success");

$('input[id=pay]').prop('disabled',true);

setTimeout(function () {
//Redirect with JavaScript
//  window.location.href= 'invoice-view.php?id=<?php  echo $_GET['pre_id']  ?>&name=<?php echo $_GET['pname']  ?>';
 window.location.href= 'invoice-view.php?payid='+data + '&name='+name;

}, 3000);
        
        
        }
    },
    error: function (data) {
           //other errors that we didn't handle
        swal("Sorry", "Failed to Proceed. Please try later :(", "error");
    }

    });

});

};

// check validations
function validateContact() {
debugger;
    var valid = true;
    $(".demoInputBox").css('background-color', '');
    $(".info").html('');

//list of test_id inputs
var testIdList = 
document.getElementsByClassName('test_id')
for(let i= 0 ; i<testIdList.length; i++){
    if (!testIdList.item(i).value) {
        $("#test_id_info").html("(All field are Required)");
    $("#test_id").css('background-color', '#FFFFDF');
    valid = false;
        }
        }


var testIdLists = 
document.getElementsByClassName('amount')
for(let i= 0 ; i<testIdList.length; i++){
    if (!testIdLists.item(i).value) {
    $("#test_id_info").html("(All field are Required)");
    $("#amount").css('background-color', '#FFFFDF');
    valid = false;
        }
        }
       
        
  
    return valid;
}


});









</script>



    
</body>


<!-- invoice-view24:07-->
</html>