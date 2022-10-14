<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
         require_once 'auth/dbconnection.php';

?>

<!-- patients23:17-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="assets/datatables/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/datatables/css/datatables.min.css"/>





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

  if( $_SESSION['role_id']=='2'){
                include ('sidebar/doctorsidebar.php');
            }
      
?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title"> Patient Prescription Information</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <div class="card-block">
                                <h5 class="text-bold card-title">Medicines Prescribed</h5>
								<div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Medicine Name</th>
												<th>Morning</th>
                                                <th>Noon</th>
                                                <th>Night</th>
                                                <th>Period</th>
											</tr>
										</thead>
										<tbody>
<?php 

   $stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND user_id=? ");
   $stmt->bind_param("sss", $_GET['patient_id'], $_GET['aptid'], $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  exit('No rows');
   while($row = $result->fetch_assoc()) {
    $remark=$row['remark'];

    $medRecords = json_decode($row['med_records'],true);
    if (is_array($medRecords) || is_object($medRecords)) {
        foreach($medRecords as $key => $object) {

?>
											<tr>
                                            <td><?php echo $object['medname'] ?></td>
												<td><?php echo $object['morning'] ?></td>
												<td><?php echo $object['noon'] ?></td>
                                                <td><?php echo $object['night'] ?></td>
                                                <td><?php echo $object['period'] ?></td>
											
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
                            <br>
                            <div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th colspan='2'>Remark (Diet Advice):</th>
                                                </tr>
                                                <tr>
												<td>      <?php echo  $remark    ?></td>
                                             </tr>
											</tr>
										</thead>
										<tbody>
                                        </tbody>
</table>
</div>
                        </div>
                        
                    </div>
                   
                    <div class="col-lg-6">
                        <div class="card-box">
                            <div class="card-block">
                                <h5 class="text-bold card-title">Testings Prescribed</h5>
								<div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Testings</th>
												<th>Testings Remark</th>
											
											</tr>
										</thead>
										<tbody>
<?php 

   $stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND user_id=? ");
   $stmt->bind_param("sss", $_GET['patient_id'], $_GET['aptid'], $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  exit('No rows');
   while($row = $result->fetch_assoc()) {
     
    $medRecords = json_decode($row['testing_details'],true);
    if (is_array($medRecords) || is_object($medRecords)) {
         foreach($medRecords as $key => $object) {

           $tests=  $object['testings'];
           if( $tests=='No need testings'){
               $tests ='No need testings';
           }else{ 
           $tests=  implode(" , ",$tests);// Use of implode function  s
           }
   
?>
											<tr>
												<td><?php echo $tests ?></td>
												<td><?php echo $object['testingremark'] ?></td>
											
											</tr>	
   <?php 
         } } }


?>
										</tbody>
									</table>
								</div>
                            </div>
                        </div>
                    </div>
                    </div>



          

		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					
                    <div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						
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

  


    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <!-- <script src="assets/js/moment.min.js"></script> -->
    <script src="assets/js/app.js"></script>

    <script src="assets/datatables/js/dataTables.bootstrap.js"></script>
    <!-- <script src="assets/datatables/js/jquery.dataTables.min.js"></script> -->
    <script src="assets/datatables/js/datatables.min.js"></script>

<script>


$(document).ready( function () {
    $('#myTable').DataTable();
} );



</script>
</body>


<!-- patients23:19-->
</html>