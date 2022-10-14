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
include ('sidebar/adminsidebar.php');

?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Invoice</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <!-- <button class="btn btn-white">PDF</button> -->
                            <!-- <a class="btn btn-white" href="view_test_payment.php"><i class="fa fa-back fa-lg"></i> Back to menu</a> -->
                        </div>
                    </div>
                </div>

<?php
  include ('auth/dbconnection.php');

   $stmt = $conn->prepare("SELECT * FROM test_invoices as ti INNER JOIN testings AS t ON ti.test_id=t.test_id INNER JOIN prescription as p ON p.pres_id=ti.pres_id INNER JOIN users as u ON u.user_id=ti.user_id AND ti.test_payment_id=? ");
   $stmt->bind_param("s", $_GET['test_payment_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  ;
   while($row = $result->fetch_assoc()) {

    $username= $row['fname'].' '.$row['lname'];
    $testing_name= $row['testing_name'];
    $pres_id= $row['pres_id'];
    $invoice_id=$row['test_payment_id']; 
    $payment_date=   date('dS F Y', strtotime($row['payment_date']));
    $date=   date('dS F Y', strtotime($row['date']));

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
                                            <h3 class="text-uppercase">Invoice No. #<a href="#"><?php echo $invoice_id;   ?></a> </h3>
                                            <ul class="list-unstyled">
                                                <li>Invoice Date: <span> <a href="#"><?php echo $payment_date    ?> </a></span></li>
                                                <li>Cashier: <span> <a href="#"><?php echo $username    ?> </a></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 m-b-20">

                                            <ul class="list-unstyled">
											
                                                <li><strong> <span>Patient Name : </span> <a href="#"><?php  echo $_GET['username'];   ?></a>  </strong> </li>

												<li><span>Prescription No. : </span> <a href="#"><?php  echo $pres_id;  ?></a></li>
											
											</ul>
										
                                    </div>
                                    <div class="col-sm-6 col-lg-6 m-b-20">
										<div class="invoices-view">
<?php 
$result = mysqli_query($conn, "SELECT SUM(charge) AS value_sum FROM test_invoices WHERE test_payment_id= '".$_GET['test_payment_id']."' "); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];  
?>

											<ul class="list-unstyled invoice-payment-details">
												<li>
													<h5>Total Amount: <span class="text-right">Rs. <?php echo $sum   ?></span></h5>
												</li>
												<li>Prescription Date: <span><?php echo $date  ?></span></li>
										
											</ul>
										</div>
                                    </div>
                                </div>
                            
                                       
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                            <th></th>

                                                <th></th>
                                 
                                          
                                                <th>Test Name</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>   
                                                 <th></th>
                                                 <th></th>

                                                <th>Unit Test Charge</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>   
                                                 <th></th>
                                                 <th></th>
                                                <th>Total Amout</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
  include ('auth/dbconnection.php');

   $stmt = $conn->prepare("SELECT * FROM test_invoices as ti INNER JOIN testings AS t ON ti.test_id=t.test_id INNER JOIN prescription as p ON p.pres_id=ti.pres_id INNER JOIN users as u ON u.user_id=ti.user_id AND ti.test_payment_id=? ");
   $stmt->bind_param("s", $_GET['test_payment_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  ;
   while($row = $result->fetch_assoc()) {
       
    $charge= $row['charge'];
    $testing_name= $row['testing_name'];
    $pres_id= $row['pres_id'];
    $invoice_id=$row['test_payment_id']; 
    $payment_date=   date('dS F Y', strtotime($row['payment_date']));
    $date=   date('dS F Y', strtotime($row['date']));
    // $descriptions= $row['descriptions'];

    
   
 ?>
                                            <tr>
                                                <td></td>
                                                <td></td>                                          
                                                <td><?php  echo  $testing_name   ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php  echo  $charge   ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php  echo  $charge   ?></td>
                                            </tr>
                                       

   <?php  }  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <div class="row invoice-payment">
                                        <div class="col-sm-7">
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="m-b-20">
                                                <h6>Total due</h6>
                                                <div class="table-responsive no-border">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th>Subtotal:</th>
                                                                <td class="text-right">Rs. <?php echo $sum   ?></td>
                                                            </tr>
                                                      
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td class="text-right text-primary">
                                                                  <strong>   <h5>Rs. <?php echo $sum   ?></h5> </strong>
																</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="invoice-info">
                                       <strong>  <h5>Other information</h5> </strong>
                                        <p class="text-muted"><?php echo $descriptions  ?></p>
                                    </div> -->

                                    <!-- <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <a class="btn btn-white" href="view_test_pdf.php?test_payment_id=<?php echo $_GET['test_payment_id']  ?>&pid=<?php echo $_GET['pid']  ?>&username=<?php echo $_GET['username']  ?>"><i class="fa fa-back fa-lg"></i> Back to menu</a>
                        </div>
                    </div> -->
                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- invoice-view24:07-->
</html>