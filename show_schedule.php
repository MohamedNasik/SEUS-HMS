<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
         session_start();
         include 'auth/dbconnection.php';

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>


<!-- profile22:59-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

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
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                </div>


                <?php

$sql="SELECT user_id,username,address,specilization,image, contact,email, gender FROM users WHERE role_id= 2 AND user_id= ? ";
$stmt=$conn->prepare( $sql );
$stmt->bind_param( 's',$_GET['userid']);


$res=$stmt->execute();
if( $res ){
    $stmt->store_result();
    $stmt->bind_result($user_id,$username,$address,$specilization,$image,$contact,$email,$gender);

    while( $stmt->fetch() ){
        /* 
            You store the filename ( possibly path too ) 
            so you need to read the file to find it's
            raw data which you will use a simage source
        */
        $filepath="profile/blog/";
       
        ?>


                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                    <?php
                                
                                printf( 
                                    '<img class="inline-block avatar" src="data:image/png;base64, %s" alt="user" />',
                                         base64_encode(file_get_contents($filepath.$image ) )
                                );

                                ?>
                                        <!-- <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a> -->
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"> Dr. <?php echo $username  ?></h3>
                                                <small class="text-muted">Gynecologist</small>
                                                <div class="staff-id">User ID : <?php echo $user_id  ?></div>
                                                <div class="staff-msg"><a href="chat.php" class="btn btn-primary">Send Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $contact  ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $email  ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text">3rd March</span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo $address  ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $gender  ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>


                <?php               }
            $stmt->free_result();
            $stmt->close();
            $conn->close();
        }
 
?>				<div class="profile-tabs">
					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Weekly Schedule</h3>
                            <div class="experience-box">
                                             
                         <div class="col-lg-12">
                            <div class="card-block">
                            <form method="POST" id="doctor_form">
                            <div class="row">     
                            <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Specilization <span class="text-danger">*</span></label>
                                        <select class="select" id="specilization" name="specilization">
                                            <option value="Select">Select</option>
                                        </select>
                                        <span id="typeposs" class="info text-danger"></span><br />
                                    </div>
                               </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Specilization <span class="text-danger">*</span></label>
                                        <select class="select" id="specilization" name="specilization">
                                            <option value="Select">Select</option>
                                        </select>
                                        <span id="typeposs" class="info text-danger"></span><br />
                                    </div>
                               </div>
                        
                               <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" id="username" name="username">
                                        <span id="username_info" class="info text-danger"></span>
                                    </div>
                                </div>

                        
                            </div>

                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="Register"
                                    value="Create Doctor" id="Register">
                            </div>
                            <center>  <div id="success_mes" class="text text-success">    </div>  </center> <br>

                        </form>
<!-- FORM ENDS -->
							
                     
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
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/select2.min.js"></script>

</body>


<!-- profile23:03-->
</html>