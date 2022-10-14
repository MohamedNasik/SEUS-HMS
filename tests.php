<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }


       //  redirect to main page according to the user role 
       if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
        header("location: index-2.php");
        exit;
     }

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
        header("location: index.php");
        exit;
     }
     


     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: index-recep.php");
        exit;
     }


         require_once 'auth/dbconnection.php';

        ?>

<!-- doctors23:12-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->



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

          if( $_SESSION['role_id']=='3'){
            include ('sidebar/laboratorist.php');
        }
?>



      <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Patient Testings</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white" data-toggle="modal" data-target="#exampleModal" data_id= <?php echo $_GET['presid'] ?>><i class="fa fa-money fa-lg"></i> Payment for this patient</button>
                        
                            <button class="btn btn-white" onclick="location.href='test_select.php?presid=<?php echo $_GET['presid'] ?>&name=<?php echo $_GET['name'] ?>&pid=<?php echo $_GET['id']  ?>';"><i class="fa fa-edit fa-lg"></i> Edit Test Results</button>
                        
                        
                        </div>
                    </div>
                </div>






                <?php 
require_once ('auth/dbconnection.php');
   $stmt = $conn->prepare("SELECT * FROM prescription as p , users as u WHERE p.pres_id = ? AND p.user_id=u.user_id");
   $stmt->bind_param("s", $_GET['presid']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0) ;
   while($row = $result->fetch_assoc()) {
   // $doctor=$row['username'];
    $medRecords = json_decode($row['testing_details'],true);
    $med = $row['fname'].' '. $row['lname'];
    $date = $row['date'];


    if (is_array($medRecords) || is_object($medRecords)) {
         foreach($medRecords as $key => $object) {

           $tests=  $object['testings'];
           if( $tests=='No need testings'){
               $tests ='No need testings';
           }else{ 
           $tests=  implode(" , ",$tests);// Use of implode function  s
           }
   
?>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Testings Prescriptions for Mr. <?php echo $_GET['name'];  ?></h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                
                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Prescription ID # <?php echo $_GET['presid'];  ?>  </h3>
                                        <ul class="list-unstyled">
                                            <li>Prescription Date: <span> <?php echo $row['date'];  ?>  </span></li>
                                            <br>
                                            <li>
                                            <h5 class="mb-0">Recommended By: Dr.<strong><?php echo $med   ?></strong></h5></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">                                  
                                        <li>
                                            <h5 class="mb-0"><strong>SEUS Hospital </strong></h5></li>
                                        <li><span>No. 22, Bandarawela</span></li>
                                        <li><span>Sri Lanka</span></li>

                                       
                                    </ul>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <h5 class="text-bold card-title"> Patient Selection</h5>
                                        <div class="table-responsive" id="user_data">
   
                               
                                </div>
                                    </div>
                                </div>
                                </div>  


                   <div class="row">
                     <div class="col-lg-12">
                   
                            <div class="card-block">
                                <h5 class="text-bold card-title">Testings Prescribed By Doctor</h5>
								<div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Testings</th>
												<th>Testings Remark</th>
											
											</tr>
										</thead>
										<tbody>

											<tr>
												<td><?php echo $tests ?></td>
												<td><?php echo $object['testingremark'] ?></td>
											
											</tr>	
   <?php 
         }
}   
}

  

?>
										</tbody>
									</table>
								
                                    </div>
                            </div>
                        </div>
                    </div>

<br>

                            <div class="row">
                                <div class="col-sm-12">
                                    <form method="post"> 
						
                            <div class="m-t-20 text-center">

                            <input type="hidden" id="id" value="<?php echo $_GET['presid'];  ?>">
                            <input type="button" class="btn btn-primary submit-btn" name="finish"
                                    value="Finish" id="finish">                            </div>
                        </form>
                                </div>


                        

                                <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="card-title">Available Tests</h4>
								

									<nav aria-label="breadcrumb">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="tests/blood count.php?name=<?php echo $_GET['name'] ?>&presid=<?php  echo $_GET['presid']  ?>&pid=<?php  echo $_GET['id']  ?>">Blood Count</a></li>
											<li class="breadcrumb-item"><a href="tests/urine.php?name=<?php echo $_GET['name'] ?>&presid=<?php  echo $_GET['presid']  ?>&pid=<?php  echo $_GET['id']  ?>">Urine</a></li>

										</ol>
									</nav>
                                </div>
                            </div>



                                
                                <!-- <div class="col-sm-6">
                                    <div>
                                        <h4 class="m-b-10"><strong>Deductions</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="float-right">$0</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Provident Fund</strong> <span class="float-right">$0</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>ESI</strong> <span class="float-right">$0</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Loan</strong> <span class="float-right">$300</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Total Deductions</strong> <span class="float-right"><strong>$59698</strong></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                                <div class="col-sm-12">
                                    <!-- <p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- active test -->
		<div id="active" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to Active this Test?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="activeid"  class="btn btn-primary">Active</button>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div id="deactive" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to Deactive this Test?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="cancelid"  class="btn btn-danger">Dective</button>
						</div>
					</div>
				</div>
			</div>
		</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header d-block">
        <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-center" id="exampleModalLabel">Payment Status of <?php echo $_GET['name'];    ?> (Patient) </h5>
      </div>

      <div class="modal-body">
      <table class="datatable table table-stripped ">
                                    <thead>
                                    <tr>
                                  
                                  <th>Test Name</th>
                                  <th>Payment Status</th>
                              </tr>
                                    </thead>
                                    <tbody>
                                 
                                <?php
  include ('auth/dbconnection.php');

   $stmt = $conn->prepare("SELECT * FROM testing_schedule as t INNER JOIN prescription AS p ON t.pres_id=p.pres_id INNER JOIN users as u ON u.user_id=p.user_id  AND p.pres_id=? ");
   $stmt->bind_param("s", $_GET['presid']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  ;
   while($row = $result->fetch_assoc()) {

    $testing_perform= $row['testing_perform'];
   // $date=   date('dS F Y', strtotime($row['submit_date']));

 ?>

									<tr>

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
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>




    </div>

    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>

<script>

$(document).ready(function () {

load_data();

function load_data(){

var pres= <?php echo $_GET['presid'];   ?>;


    $.ajax({
        url: "tests/test_table.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
              data: { 
                  'pres': pres,
                   
                   },                    
          
              success: function (data) {

                  $('#user_data').html(data);
        
              }

          });

}
});



</script>

<script>



/**---------EDIT A ROW ----------------*/
$(document).on('click', '#rep2', function () {

$("#activeid").attr('user_id', $(this).attr('data_id'));

$("#active").modal({ show: 'true' });

});


/**---------EDIT A ROW ----------------*/
$(document).on('click', '#rep1', function () {

$("#cancelid").attr('user_id', $(this).attr('data_id'));

$("#deactive").modal({ show: 'true' });

});


load_data();

function load_data(){

var pres= <?php echo $_GET['presid'];   ?>;


    $.ajax({
        url: "tests/test_table.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
              data: { 
                  'pres': pres,
                   
                   },                    
          
              success: function (data) {

                  $('#user_data').html(data);
        
              }

          });

}


$("#activeid").click(function () {

var data_id = $("#activeid").attr('user_id');
console.log(data_id);
$.ajax({
    data: { 'data_id': data_id, },
    type: "POST",
    url: "testquery/test_status.php",
    success: function (data) {
        //   console.log(data);
        $('#success_mes').html(data);

        $("#active").modal('hide');
        load_data()
     
    }
});

});



$("#cancelid").click(function () {

var dataid = $("#cancelid").attr('user_id');
$.ajax({
    data: { 'dataid': dataid, },
    type: "POST",
    url: "testquery/test_status.php",
    success: function (data) {
        //   console.log(data);
        $('#success_mes').html(data);

        $("#deactive").modal('hide');
        load_data()
     
    }
});

});


</script>


<script>

      //    start query
      $(document).ready(function () {

// save comment to database
$(document).on('click', '#finish', function () {

    var id = $('#id').val();

swal({
title: "Are you sure?",
text: "You wanna save update all these Testings!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-success",
confirmButtonText: "Yes, Save It!",
closeOnConfirm: false
},
function(isConfirm){
if (!isConfirm) return;
$.ajax({
            url: "testquery/finish.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: {
                'id': id,
              
            },

            success: function (data) {
            if($.trim(data) === 'Success' ){                  
            swal("Success", "Successfully Updated:)", "success");
            $('input[id=finish]').prop('disabled',true);

            setTimeout(function () {
          //Redirect with JavaScript
             window.location.href= 'index-lab.php';
}, 3000);

        } else {
           //our handled error
            swal("Sorry", "All the tests should be updated. Try it later :(", "error");
        }
    },

    error: function (data) {
           //other errors that we didn't handle
        swal("Sorry", "Failed to send order. Please try later :(", "error");
    }


        });

});


     
 

  

});



});







</script>








</body>


<!-- doctors23:17-->
</html>