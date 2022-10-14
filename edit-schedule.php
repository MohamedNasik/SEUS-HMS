<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>
<!-- add-schedule24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
     <script src="assets/date1/js/bootstrap-datetimepicker.min.js"></script>
     <link rel="stylesheet" type="text/css" href="assets/date1/css/bootstrap-datetimepicker.min.css"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>
    <script type="text/javascript" src="assets/ajax/validate.min.js"></script>




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
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                 
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Schedule</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <form id="form_appoint" method="POST">
                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specilization type</label>
                                        <select class="select" id="specilization" name="specilization">
                                     <option value="Select Specilization">Select Specilization</option>

                                     <?php    

require_once 'auth/dbconnection.php';

    $sql = "SELECT * FROM doctorspecilization";
        if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          
                ?>
                                            <option value="<?php echo $row['specilization']; ?>">
                                            <?php echo $row['specilization']; ?></option>
                                       
        <?php  }}}?>
                                       
                                        </select>
                                        <span id="spec" class="info text-danger"></span><br />

                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Doctor Name</label>
                                        <select class="select" id="doctor_name" name="doctor_name">
                                            <option value="Select Doctor">Select</option>         
                                  
                                        </select>
                                        <span id="type" class="info text-danger"></span><br />
                                    </div>
                                </div>

                              



                    <div class="col-lg-12">
                    <label>Doctor Name</label>
                        <div class="card-box">
                            <div class="card-block">
                                <!-- <h5 class="text-bold card-title">Striped Rows</h5> -->
								<div class="table-responsive">
									<table class="table table-striped mb-0">
										<thead>
											<tr>
												<th>Days</th>
												<th>Time (From)</th>
												<th>Time (To)</th>
											</tr>
										</thead>
										<tbody id="rows">
											<tr>
												<td>MonDay</td>
												<td>
                                <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="mon_start" name="mon_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                </td>
												<td>      <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="mon_end" name="mon_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
											<tr>
												<td>TuesDay</td>
												<td>      <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="tues_start" name="tues_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td>      <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="tues_end" name="tues_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
											<tr>
												<td>WednesDay</td>
												<td>      <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="wed_start" name="wed_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td>      <div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="wed_end" name="wed_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                </td>
											</tr>
                                            <tr>
												<td>ThursDay</td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="thur_start" name="thur_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="thur_end" name="thur_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
                                            <tr>
												<td>FriDay</td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="fri_start" name="fri_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="fri_end" name="fri_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
                                            <tr>
												<td>SaturDay</td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="sat_start" name="sat_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="sat_end" name="sat_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
                                            <tr>
												<td>SunDay</td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="sun_start" name="sun_start">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
												<td><div class="col-md-12">
                                    <div class="form-group"> 
                                        <select class="select" id="sun_end" name="sun_end">
                                            <option value="Select Date">Select</option>  
                                            <option value="09.00 A.M">09.00 A.M</option> 
                                            <option value="10.00 A.M">10.00 A.M</option>  
                                            <option value="11.00 A.M">11.00 A.M</option>
                                            <option value="12.00 P.M">12.00 P.M</option>
                                            <option value="01.00 P.M">01.00 P.M</option>
                                            <option value="02.00 P.M">02.00 P.M</option>
                                            <option value="03.00 P.M">03.00 P.M</option>
                                            <option value="04.00 P.M">04.00 P.M</option>
                                            <option value="05.00 P.M">05.00 P.M</option>
                                            <option value="06.00 P.M">06.00 P.M</option>
                                            <option value="07.00 P.M">07.00 P.M</option>
                                            <option value="02.00 P.M">08.00 P.M</option>
                                            <option value="Not Available">Not Available</option>
                                           
                                        </select>
                                    </div>
                                </div></td>
											</tr>
										</tbody>
									</table>
								</div>
                            </div>
                        </div>
                    </div>


                    <!-- <input id="timepicker" width="276" /> -->

                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Available Days</label>
                                        <select class="select" id="available_days" name="available_days" multiple>
                                       
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                        <span id="days" class="info text-danger"></span><br />

                                    </div>
                                </div> -->
                            </div>
                            
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div class="time-icon">
                                            <input type="text" class="form-control" id="datetimepicker3"
                                                name="datetimepicker3">
                                        </div>
                                        <span id="datetimepicker3-info" class="info text-danger"></span><br />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div class="time-icon">
                                            <input type="text" class="form-control" id="datetimepicker4"
                                                name="datetimepicker4">
                                        </div>
                                        <span id="datetimepicker4-info" class="info text-danger"></span>
                                        <span id="errorr" class="info text-danger"></span><br />

                                    </div>
                                </div>
                            </div> -->


                            <div class="form-group">
                                <label class="display-block">Schedule Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="status" value="Active">
                                    <label class="form-check-label" for="product_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"  id="status" value="Inactive" checked>
                                    <label class="form-check-label" for="product_inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <!-- <button type="button" class="btn btn-primary submit-btn">Create Schedule</button> -->
                                <input type="button" class="btn btn-primary submit-btn" name="schedule"
                                    value="Create Schedule" id="schedule">
                            </div>
                            <br>
                            <center>  <div id="success_mes" class="text text-success">    </div>  </center> <br>

                        </form>
                    </div>
                </div>
            </div>
            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.php">See all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="assets/date/js/gijgo.min.js"></script>
    
    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets/date/js/gijgo.min.js"></script> -->
    <script src="assets/date1/js/bootstrap-datetimepicker.min.js"></script>

   
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
  
    <script src="assets/js/app.js"></script>
   
    <!-- <script>
        $(function () {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker4').datetimepicker({
                format: 'LT'
            });
        });
    </script> -->

    <!-- <script>
        $('#timepicker').timepicker();
    </script> -->


    <script>

        //    start query
        $(document).ready(function () {

            $('#specilization').change(function () {

                 var doc_spec_id=$(this).val();

$.ajax({
            url: "adminquery/fetch_doctor_name.php", // Url to which the request is send
            method: "POST",             // Type of request to be send, called as method
            data: {doc_spec_id:doc_spec_id  },
            dataType:"text",

            success: function (data) {
                $("#doctor_name").html(data);

            }

        });


    });



            // save comment to database
            $(document).on('click', '#schedule', function () {

                var doctor_name = $('#doctor_name').val();
                var specilization = $('#specilization').val();
                // var available_days = $('#available_days').val();
                // var datetimepicker3 = $('#datetimepicker3').val();
                // var datetimepicker4 = $('#datetimepicker4').val();


                var modess = $('#rows tr').map(function() {
                let $tr = $(this);

                return [ { 
                //     getapt,
                //   getpid,
               "monday_start": $(this).find('#mon_start').val(),
               "monday_end": $(this).find('#mon_end').val(),
               "tuesday_start":$(this).find('#tues_start').val(),
               "tuesday_end":$(this).find('#tues_end').val(),
               "wednesday_start":$(this).find('#wed_start').val(),
               "wednesday_end":$(this).find('#wed_end').val(),
               "thursday_start": $(this).find('#thur_start').val(),
               "thursday_end": $(this).find('#thur_end').val(),
               "friday_start": $(this).find('#fri_start').val(),
               "friday_end": $(this).find('#fri_end').val(),
               "saturday_start": $(this).find('#sat_start').val(),
               "saturday_end": $(this).find('#sat_end').val(),
               "sunday_start": $(this).find('#sun_start').val(),
               "sunday_end": $(this).find('#sun_end').val(),
                 } ]
                 console.log(modess);
                       });



                var status = $('#status').val();

var datas={ 
                            'doctor_name': doctor_name,
                            'specilization': specilization,
                      
                            'status': status,
                        
}
var datas = JSON.stringify(datas);
var timetable = JSON.stringify( $.makeArray(modess) );




                var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "adminquery/addschedule.php", // Url to which the request is send
                        method: "POST",             // Type of request to be send, called as method
              data:{
                   index1: timetable, 
                   index2: datas
              },
              //dataType:'json',             
                    cache: false,



                        success: function (response) {

                            $('#doctor_name').val('');
                            $('#specilization').val('');
                            $('#status').val('');

                            $('#success_mes').fadeIn().html(response);

                            $("success_mes").fadeIn().html(response);
                            setTimeout(function () {
                                $('#success_mes').fadeOut("Slow");
                            }, 2000);

                        }

                    });
                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    //   if (!$("#doctor_name").val("Select")) {
                    //       $("#userName-info").html("(required)");
                    //       $("#userName-info").css('background-color', '#FFFFDF');
                    //       valid = false;
                    //   }
                    // if ($("#datetimepicker3").val()>$("#datetimepicker4").val()) {
                    //     $("#errorr").html("(Time is invalid)");
                    //     $("#datetimepicker3").css('background-color', '#FFFFDF');
                    //     valid = false;
                    // }

                    // if (!$("#datetimepicker4").val()) {
                    //     $("#datetimepicker4-info").html("(Required)");
                    //  //   $("#datetimepicker4").css('background-color', '#FFFFDF');
                    //     valid = false;
                    // }

                    // if (!$("#datetimepicker3").val()) {
                    //     $("#datetimepicker3-info").html("(Required)");
                    //  //   $("#datetimepicker3").css('background-color', '#FFFFDF');
                    //     valid = false;
                    // }
                    if ($("#doctor_name").val() == 'Select Doctor') {
                        $("#type").html("(Select Doctor Name)");
                        // $("#selectsss").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if ($("#specilization").val() == 'Select Specilization') {
                        $("#spec").html("(Select specilization)");
                        // $("#password1").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    // if ($("#available_days").val() == 'Select') {
                    //     $("#days").html("(Required)");
                    //     //     $("#datetimepicker3").css('background-color', '#FFFFDF');
                    //     valid = false;
                    // }
                  


                    return valid;
                }

            });


        });


    </script>


</body>


<!-- add-schedule24:07-->

</html>