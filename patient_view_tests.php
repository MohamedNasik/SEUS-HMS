<!DOCTYPE html>
<html lang="en">
    
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>

<!-- invoices23:24-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
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
if( $_SESSION['role_id']=='1'){
    include ('sidebar/adminsidebar.php');
  } 
  if( $_SESSION['role_id']=='4'){
      include ('sidebar/receptionist.php');
  }
?>
        <?php
  include ('auth/dbconnection.php');

   $stmt = $conn->prepare("SELECT * FROM testing_schedule as t INNER JOIN prescription AS p ON t.pres_id=p.pres_id INNER JOIN users as u ON u.user_id=p.user_id INNER join doctor_specialist as ds ON ds.user_id=u.user_id  AND p.pres_id=? ");
   $stmt->bind_param("s", $_GET['presid']);
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


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                
                    <div class="col-sm-5 col-6">
                                <div class="col-sm-12 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                    <ul class="list-unstyled mb-0">
                                        <li>Prescription ID :   <a href="#"><?php  echo $pres_id  ?></a></li>

                                        <li>Patient Name :   <a href="#"><?php  echo $_GET['names']    ?></a></li>
                                        <li>Submitted Date :   <a href="#"><?php   echo $sub_date    ?></a></li>
                                      <br>
                                        <li>Doctor Name :   <a href="#"><?php   echo $username    ?></a></li>
                                        <li>Specilization :   <a href="#"><?php   echo     $specilization   ?></a></li>
                                        <li>Prescription Date :   <a href="#"><?php   echo $pres_date    ?></a></li>
                                                                  
                                 </ul>
                                    
                                </div>

                                

                    </div>
                    
                    <div class="col-sm-7 col-8 text-right m-b-30">
                    <!-- <a href="invoice_view.php?id=<?php echo $_GET['presid'] ?>&pname=<?php echo $_GET['names'] ?>&pid=<?php echo $_GET['pid']  ?>" class="btn btn-primary btn-rounded"><i class="fa fa-eye"> </i>  Check Invoice</a> -->

                    <?php
  include ('auth/dbconnection.php');

   $stmt1 = $conn->prepare("SELECT payment_status, count(pres_id) AS pres_id, sum(if(payment_status='2',1,0)) AS `payment_status`  FROM testing_schedule WHERE pres_id=? GROUP BY pres_id ");
   $stmt1->bind_param("s", $_GET['presid']);
   $stmt1->execute();
   $result1 = $stmt1->get_result();
   if($result1->num_rows === 0)  ;
   while($row = $result1->fetch_assoc()) {
    $payment_status= $row['payment_status'];
    $pres_id= $row['pres_id'];

    if($payment_status == $pres_id){


    }else{
?>

                        <a href="create_invoice.php?pre_id=<?php echo $_GET['presid'] ?>&pname=<?php echo $_GET['names'] ?>&id=<?php echo $_GET['pid']  ?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a>
                 <?php
    }

}
                 ?>                 
                  
                        </div>
                    
                </div>
             


<br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">


                        <table class="datatable table table-stripped ">
                                    <thead>
                                    <tr>
                                  
                                  <th>Test Name</th>
                                  <th>Patient Testing Status</th>
                                  <th>Payment Status</th>
                                   <th> Lab Status  </th>
                                  <!-- <th class="text-right">Action</th> -->
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

                                        <?php    if( $row['patient_status']=='1' ) {   ?>
                                        <span class="custom-badge status-green">Active</span>
                                        <?php   } elseif( $row['patient_status']=='0' ) {   ?>
                                            <span class="custom-badge status-red">Dropped</span>
                                            <?php   } elseif( $row['patient_status']=='3' ) {   ?>
                                                <span class="custom-badge status-green">Active</span>
                                            <?php  } ?>
                                        </td>

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

<td>
                                         <?php    if( $row['lab_status']=='0' ) {   ?>
                                        <span class="custom-badge status-red">Still Not Taken</span>
                                        <?php   } elseif( $row['lab_status']=='1' ) {   ?>
                                            <span class="custom-badge status-green">Completed</span>
                                            <?php   } elseif( $row['lab_status']=='2' ) {   ?>
                                                <span class="custom-badge status-orange">In progress</span>
                                            <?php  } ?>
                                         
                                         </td>


                                        <!-- <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-invoice.php"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="invoice-view.php"><i class="fa fa-eye m-r-5"></i> View</a>
                                                    <a class="dropdown-item" href="#"><i class="fa fa-file-pdf-o m-r-5"></i> Download</a>
													<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_invoice"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td> -->
                                    </tr>
								
   <?php           }
  

   ?>                                 
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
		<div id="delete_invoice" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Invoice?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- invoices23:25-->
</html>