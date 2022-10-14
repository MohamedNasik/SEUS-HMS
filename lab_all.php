<!DOCTYPE html>
<html lang="en">

<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }
?>



<!-- tables-datatables23:59-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"  href="assets/vendor/DataTables/buttons.datatables.min.css">    


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
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php

if( $_SESSION['role_id']=='1'){
    include ('sidebar/adminsidebar.php');
            }  if( $_SESSION['role_id']=='2'){
                include ('sidebar/doctorsidebar.php');
            }
          if( $_SESSION['role_id']=='4'){
            include ('sidebar/receptionist.php');
        }
?>
     <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Lab Assistants </h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                                <p class="content-group">
                                    These users are  <code> already registered </code> with the system.
                                </p>
								<div class="table-responsive">
                                <table id="example" class="table table-hover">
                         <thead>
                                     <tr>
                                     <th align="center"> ID</th>
                                        <th align="center">Lab Asst. name</th>
                                        <!-- <th align="center">Email</th> -->
                                        <th align="center">Address</th>
                                        <th align="center">Gender</th>
                                        <th align="center">DOB</th>                            
                                        <th align="center">Contact</th> 
                                        <!-- <th align="center">Action</th>  -->
                                    </tr>
                            </thead>
                          </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="delete_user" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Patient?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="cancelid"  class="btn btn-danger">Delete</button>
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

           

        <div id="active_appointment" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to Active this Appointment?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="activeid" class="btn btn-success">Active</button>
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
    <script src="assets/vendor/DataTables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script type="text/javascript" src="assets/vendor/DataTables/buttons.print.min.js"></script>
    <script src="assets/vendor/DataTables/jszip.min.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>





<script type="text/javascript" language="javascript" >

$(document).ready(function() { 
    
load_data();
function load_data(){
var table = $('#example').DataTable( { 

"retrieve": true, // did false 
"processing": true, // did false 
"serverSide": true, 
"ajax": "adminquery/fetch/users/fetch_all_lab.php",
dom: 'lBfrtip',
buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
   "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]


});
}



});


</script>



</body>
</html>