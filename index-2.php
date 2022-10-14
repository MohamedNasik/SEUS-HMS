<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
         session_start();
         include ('auth/dbconnection.php');

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

     //  redirect to main page according to the user role 

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
        header("location: index.php");
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



            
             
            // morris js starts
            $stmt = $conn->prepare("SELECT DATE_FORMAT(apt_date, '%d-%b') as apt_date,  sum(if(type='Consultation',1,0)) AS `Consultation`,
            sum(if(type='Check Report',1,0)) AS `Check Report` FROM appointment WHERE type IN ('Consultation','Check Report') AND  apt_date BETWEEN ADDDATE(NOW(),-180) AND NOW()
             AND doctor_status='1' GROUP BY apt_date");

            // apt_date>= (CURDATE() - INTERVAL 30 DAY ) AND NOW()
            // DATE_FORMAT(apt_date, '%d-%b-%Y')

            // $stmt->bind_param("s",$_POST['data_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $chart_data = '';

            while($row = mysqli_fetch_array($result)){
            $apt_date= $row['apt_date'];
                $Check_Report= $row['Check Report'];
                $Consultation= $row['Consultation'];

                      
                $chart_data .= "{ apt_date:'".$apt_date."', Consultation:'".$Consultation."',Check_Report:'".$Check_Report."'}, ";
            }

            $chart_data = substr($chart_data, 0, -2);


            // dONUT cHART starts
            $stmt1 = $conn->prepare("SELECT decease_name, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name");
            $stmt1->execute();
            $result1 = $stmt1->get_result();

            $data = array(); // define array
           while($row = mysqli_fetch_array($result1)){
            $data[] = array(
            'label'  => $row["decease_name"],
            'value'  => $row["Consultations"]
          );  
      }

      $json_data = json_encode($data);  // convert to json array



            // VERTICLE cHART appointments starts
            $stmt2 = $conn->prepare("SELECT sum(if(doctor_status='1',1,0)) AS `confirm`,sum(if(doctor_status='3',1,0)&& if(admin_status='1',1,0) ) AS `in progress`,
            sum(if(doctor_status='3',1,0) && if(admin_status='0',1,0) && if(patient_status='0',1,0)) AS `cancel`, sum(if(doctor_status='3',1,0)&& if(admin_status='3',1,0)&& if(patient_status='3',1,0) ) AS `notattended`, count(apt_id) as total FROM appointment WHERE doctor_status IN ('1','3', '3', '0') AND  apt_date=curdate() ");
           
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $chart_data1 = '';

            while($row = mysqli_fetch_array($result2)){

                $confirm= $row['confirm'];
                $inprogress= $row['in progress'];
                $total= $row['total'];
                $not_attended= $row['notattended'];
           
                $cancel= $row['cancel'];
           
                $myurl[] = "$total,$confirm,$not_attended,$inprogress, $cancel";
           
            }

            // $chart_data1 = substr($chart_data1, 0, -2);
             implode(',', $myurl);


//  lab status all
// VERTICLE cHART appointments starts

$stmt3 = $conn->prepare("SELECT sum(if(lab_status='1',1,0)) AS `done`,sum(if(lab_status='0',1,0) ) AS `pending`,
 count(pres_id) as total FROM testing_schedule WHERE lab_status IN ('1','0') ");

$stmt3->execute();
$result3 = $stmt3->get_result();


while($row = mysqli_fetch_array($result3)){

    $perform= $row['done'];
    $pending= $row['pending'];
    $total= $row['total'];


    $myurl1[] = "$total,$perform,$pending";

}

// $chart_data1 = substr($chart_data1, 0, -2);
 implode(',', $myurl1);


        ?>
<!-- index22:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/chart/morris.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/chart/Chart.css">
    <link rel="stylesheet" type="text/css" href="assets/chart/Chart.min.css">
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
                <!-- <li class="nav-item dropdown d-none d-sm-block"> -->
                <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                <!-- <div class="dropdown-menu notifications"> -->
                <!-- <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div> -->
                <!-- <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                <!-- <div class="topnav-dropdown-footer">
                            <a href="activities.php">View all Notifications</a>
                        </div> -->
                <!-- </div> -->
                <!-- </li> -->
                <!-- <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li> -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
                            <span class="status online"></span>
                        </span>
                        <span>You</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                            Profile</a>
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                        <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                        Profile</a>
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
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <?php 
                    include ('auth/dbconnection.php');
                    $sql= mysqli_query($conn,"SELECT * FROM users WHERE role_id='1' "); 
                   $num_rows=mysqli_num_rows($sql);
                   // echo $num_rows;
                    ?>
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $num_rows;  ?></h3>
                                <span class="widget-title1">Admins <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <?php 
                    include ('auth/dbconnection.php');
                    $sql= mysqli_query($conn,"SELECT * FROM users WHERE role_id='2' "); 
                   $num_rows=mysqli_num_rows($sql);
                   // echo $num_rows;
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $num_rows;  ?></h3>
                                <span class="widget-title2">Doctors <i class="fa fa-check"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <?php 
                    include ('auth/dbconnection.php');
                    $sql= mysqli_query($conn,"SELECT * FROM users WHERE role_id='3' "); 
                   $num_rows=mysqli_num_rows($sql);
                   // echo $num_rows;
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-flask" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $num_rows;  ?></h3>
                                <span class="widget-title3">Laboratorist <i class="fa fa-check"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <?php 
                    include ('auth/dbconnection.php');
                    $sql= mysqli_query($conn,"SELECT * FROM users WHERE role_id='4' "); 
                   $num_rows=mysqli_num_rows($sql);
                   // echo $num_rows;
                    ?>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-user" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?php echo $num_rows;  ?></h3>
                                <span class="widget-title4">Receptionists <i class="fa fa-check"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Patients In (Last 6 Months)</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <li><i class="fa fa-circle old-users" style="color:#00a65a"
                                                    aria-hidden="true"></i> OPD </li>
                                            <li></li>
                                            <li><i class="fa fa-circle current-users" style="color:#f56954"
                                                    aria-hidden="true"></i> REPORT</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="chart" id="bar-chart" style="height: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Patients In (Per Month)</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <li><i class="fa fa-circle old-users" style="color:#5551ca"
                                                    aria-hidden="true"></i> ALL </li>

                                        </ul>
                                    </div>
                                </div>
                                <canvas id="myChart" width="455" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Statistical Analysis for Deceases found</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <!-- <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
											<li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="chart" id="sales-chart" style="height: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="card member-panel">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a
                                    href="today_appointments.php" class="btn btn-primary float-right">View all</a>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive" id="user_data">

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4 class="card-title d-inline-block">Hospital Management</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <!-- <li><i class="fa fa-circle old-users" style="color:#5551ca"
                                                    aria-hidden="true"></i> ALL </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="hospital-barchart"> </div>


                                <div class="bar-chart">
                            
                                    <div class="item">
                                        <div class="bar">
                                            <canvas id="charts" width="455" height="412"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- 
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Doctors</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">MBBS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">BMBS</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">MBBS</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.php" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MBBS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="doctors.php" class="text-muted">View all Doctors</a>
                            </div>
                        </div>
                    </div> -->
                </div>


                <div class="row">
                    <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                        <div class="card member-panel">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Patient Payment </h4> <a
                                    href="patient_test_payments.php" class="btn btn-primary float-right">View all</a>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive" id="tests_data">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4 class="card-title d-inline-block">Lab Management</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <!-- <li><i class="fa fa-circle old-users" style="color:#5551ca"
                                                    aria-hidden="true"></i> ALL </li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="hospital-barchart"> </div>


                                <div class="bar-chart">
                            
                                    <div class="item">
                                        <div class="bar">
                                            <canvas id="chart_test" width="455" height="412"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
<!-- 

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block"> Patients Payments </h4> <a href="patients.php"
                                    class="btn btn-primary float-right">View all</a>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table mb-0 new-patient-table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img width="28" height="28" class="rounded-circle"
                                                        src="assets/img/user.jpg" alt="">
                                                    <h2>John Doe</h2>
                                                </td>
                                                <td>Johndoe21@gmail.com</td>
                                                <td>+1-202-555-0125</td>
                                                <td><button
                                                        class="btn btn-primary btn-primary-one float-right">Fever</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img width="28" height="28" class="rounded-circle"
                                                        src="assets/img/user.jpg" alt="">
                                                    <h2>Richard</h2>
                                                </td>
                                                <td>Richard123@yahoo.com</td>
                                                <td>202-555-0127</td>
                                                <td><button
                                                        class="btn btn-primary btn-primary-two float-right">Cancer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img width="28" height="28" class="rounded-circle"
                                                        src="assets/img/user.jpg" alt="">
                                                    <h2>Villiam</h2>
                                                </td>
                                                <td>Richard123@yahoo.com</td>
                                                <td>+1-202-555-0106</td>
                                                <td><button
                                                        class="btn btn-primary btn-primary-three float-right">Eye</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img width="28" height="28" class="rounded-circle"
                                                        src="assets/img/user.jpg" alt="">
                                                    <h2>Martin</h2>
                                                </td>
                                                <td>Richard123@yahoo.com</td>
                                                <td>776-2323 89562015</td>
                                                <td><button
                                                        class="btn btn-primary btn-primary-four float-right">Fever</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div>
            </div>

    <div id="delete_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to Cancel this Appointment?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="cancelid" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="take" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to take this payment?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="cancelid" class="btn btn-success">Take it</button>
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

    <script src="assets/chart/morris.js"></script>
    <script src="assets/chart/raphael.min.js"></script>

    <script src="assets/chart/Chart.js"></script>
    <script src="assets/chart/Chart.min.js"></script>

    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>




    <script>
        $(function () {
            "use strict";

            //DONUT CHART starts
            var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: ["#3c8dbc", "#00a65a", "#95D7BB", "#67C69D", "#39B580", "0BA462"],
                data:  <?php echo $json_data; ?>,

                hideHover: 'auto'
                });


        //BAR CHART starts
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: [<?php echo $chart_data; ?>],

            barColors: ['#00a65a', '#f56954'],
            xkey: 'apt_date',
            ykeys: ['Consultation', 'Check_Report'],
            labels: ['Consultation', 'Check Report'],
            hideHover: 'auto'
                });




        //  horizontal bar starts
        var chart = new Chart('charts', {
            type: 'horizontalBar',
            data: {
                labels: ['Today','Discharged','Not Attended', 'In Progress', 'Cancelled'],
                datasets: [

                    {
                        data: [<?php echo implode(',', $myurl); ?>],

                        backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(199, 155, 80, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(199, 155, 80, 1)'

            ],
            borderWidth: 1,
                label: 'ToDay'
            }
    ]
  },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
});


// tests charts
    //  horizontal bar starts
    var chart = new Chart('chart_test', {
            type: 'horizontalBar',
            data: {
                labels: ['Total Tests', 'Do Tests', 'Pendings'],
                datasets: [

                    {
                        data: [<?php echo implode(',', $myurl1); ?>],
                backgroundColor: '#c46998',
                label: 'Prescription Tests'
            }
    ]
  },
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
});
            });



    </script>

    <script>
// fetch line chart
        $(document).ready(function () {
            $.ajax({
                url: "adminquery/fetch/line.php",
                type: "GET",
                success: function (data) {
                    console.log(data);

                    var apt_date = [];
                    var Consultation = [];

                    for (var i in data) {
                        Consultation.push(data[i].Consultation);
                        apt_date.push(data[i].apt_date);
                    }

                    var chartdata = {
                        labels: apt_date,
                        datasets: [
                            {
                                label: "Consultation",
                                fill: false,
                                lineTension: 0.1,
                                backgroundColor: "rgba(59, 89, 152, 0.75)",
                                borderColor: "rgba(59, 89, 152, 1)",
                                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                                data: Consultation
                            }


                        ]
                    };
                    var ctx = document.getElementById('myChart');

                    //   var ctx = $("#line-chart");

                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: chartdata
                    });
                },
                error: function (data) {

                }
            });
        });


    </script>


    <script>
// payment table fetch
        $(document).ready(function () {

            payment_data();
            load_data();
            function load_data() {
                $.ajax({
                    url: "table/table.php", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method

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

            $("#cancelid").attr('apt_id', $(this).attr('data_id'));

            $("#delete_appointment").modal({ show: 'true' });

        });

        load_data();

// load appointments
        function load_data() {
            $.ajax({
                url: "table/table.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method

                success: function (data) {

                    $('#user_data').html(data);

                }

            });
        }
//  cancel apts
        $("#cancelid").click(function () {

            var data_id = $("#cancelid").attr('apt_id');
            $.ajax({
                data: { 'data_id1': data_id, },
                type: "POST",
                url: "table/apt status.php",
                success: function (data) {
                    //   console.log(data);
                    $('#success_mes').html(data);

                    $("#delete_appointment").modal('hide');
                    load_data();


                }
            });

            setInterval(function () {
                $('#user_data').load("sidebar/apt_table admin.php").fadeIn("slow");
            }, 500);

        });


    </script>


    <script>
// load payment table
        $(document).ready(function () {

            payment_data();
            function payment_data() {
                $.ajax({
                    url: "table/payment_table.php", // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method

                    success: function (data) {

                        $('#tests_data').html(data);

                    }

                });

            }

        });

    </script>








</body>


<!-- index22:59-->

</html>