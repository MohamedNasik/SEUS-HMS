<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }


            if(!isset($_SESSION['p_id'])){
                header('location:index.php');
                }
        
                    //  redirect to main page according to the user role 
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
        header("location: index-2.php");
        exit;
     }


     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
        header("location: index-lab.php");
        exit;
     }

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: index-recep.php");
        exit;
     } 
        
        
        $p_id=$_SESSION['p_id'];
        // $patientname=$_SESSION['patientname'];
        


?>
<!-- edit-employee24:07-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
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
          
           
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>You</span>
                    </a>
					<div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
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
                <div class="col-sm-5 col-4">
                        <h4 class="page-title">Patient Summery Profile</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">                        
                            <button class="btn btn-white" onclick="location.href='auth/logout_patient.php';"><i class="fa fa-edit fa-lg"></i> Logout</button>
                        
                        
                        </div>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!-- <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a> -->
                    </div>

                    
                </div> <br><br>
                <div class="row">
                <?php 
         require_once 'auth/dbconnection.php';

$stmt = $conn->prepare("SELECT * FROM prescription as p INNER JOIN users as u ON p.user_id=u.user_id AND p.p_id = ? AND p.user_id=? ORDER BY p.pres_id DESC");
$stmt->bind_param("ss", $_GET['p_id'], $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
 

    $investigations = json_decode($row['investigations'],true);

    if (is_array($investigations) || is_object($investigations)) {
        foreach($investigations as $key => $object) {
?>


              <div class="col-md-6 col-lg-6 col-xl-4">
                  <div class="card shadow">
                      <div class="card-body text-center">
                      <i class="fa fa-medkit fa-4x text-primary"></i>
                      <h4 class="mt-3 text-xl" >Prescription ID : <?php echo $row['pres_id']   ?> </h4>
                      <h5 class="mt-1 text-xl" >Doctor name : Dr. <?php echo $row['fname'].' '.$row['lname']   ?> </h5>
                          <!-- <a href="first_prescription.php?aptid=<?php  echo $_GET['aptid']; ?>&p_id=<?php  echo $_GET['p_id']; ?>" class="btn btn-primary "> <i class="fa fa-eye">  View  </i></a> -->
                         <button onclick="location.href='check.php?aptid=<?php  echo $row['apt_id']; ?>& p_id=<?php  echo $row['p_id']; ?>& date=<?php  echo $row['date']; ?>';" class="btn btn-primary btn-primary-one float-center"><?php echo $row['decease_name']  ?></button> 
                        </div>
                  </div>
              </div>

        
              <?php }}}  }else{

echo 'No records found';

        } ?>
              
                
                </div>
            </div>
	
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- edit-employee24:07-->
</html>
