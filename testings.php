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

<!-- departments23:21-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">


    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

<!-- Data table css -->
<link href="assets/new datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/css/others/buttons.dataTables.min.css">




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
                <div class="col-sm-4 col-3">
                        <h4 class="page-title">Testings </h4>
                    </div>
<?php 
                    if( $_SESSION['role_id']=='1' ||  $_SESSION['role_id']=='3' ){
?>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-testings.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus">  </i>    Update Test</a>
                    </div>
<?php } ?> 

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Testing ID#</th>
                                        <th>Testing Name</th>
                                        <th>Testing Description</th>
                                        <th>Testing Charge</th>
                                  


                                    </tr>
                                </thead>
                                <tbody>
                                <?php 

$stmt = $conn->prepare("SELECT * FROM testings");
//$stmt->bind_param("sss", $_GET['patient_id'], $_GET['aptid'], $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0);
while($row = $result->fetch_assoc()) {
    ?>
                                    <tr>
                                        <td><?php echo $row['test_id']  ?></td>
                                        <td><?php echo $row['testing_name']  ?></td>
                                        <td><?php echo $row['testing_description']  ?></td>
                                        <td><?php echo $row['testing_charge']  ?></td>


                                                                     
                           

                                      

      
                                    </tr>
                         
<?php  } ?>
                                   
                               
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
		<div id="delete_department" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Department?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
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

    <!-- <script src="assets/datatables/js/dataTables.bootstrap.js"></script> -->
    <!-- <script src="assets/datatables/js/jquery.dataTables.min.js"></script> -->
    <script src="assets/datatables/js/datatables.min.js"></script>

	<!-- Data tables -->
	<script src="assets/new datatable/jquery.dataTables.min.js"></script>
	<script src="assets/new datatable/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript" src="assets/css/others/buttons.print.min.js"></script>
    <script type="text/javascript" src="assets/css/others/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/css/others/buttons.flash.min.js"></script>
    <script type="text/javascript" src="assets/css/others/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="assets/css/others/buttons.html5.min.js"></script>






    <script>


$(document).ready( function () {
    $('#myTable').DataTable({
        dom: 'lBfrtip',
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]

            });
    
} );



</script>

</body>


<!-- departments23:21-->
</html>