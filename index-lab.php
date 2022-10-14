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




// dONUT cHART starts

$stmt1 = $conn->prepare("SELECT testing_perform, sum(if(lab_status='1',1,0)) AS `tests` from testing_schedule 
WHERE lab_status IN ('1')   group by testing_perform");
$stmt1->execute();
$result1 = $stmt1->get_result();

$data = array(); // define array
while($row = mysqli_fetch_array($result1)){
$data[] = array(
'label'  => $row["testing_perform"],
'value'  => $row["tests"]
);  
}

$json_data = json_encode($data);  // convert to json array


// VERTICLE cHART test status starts

$stmt2 = $conn->prepare("SELECT sum(if(patient_status='1',1,0)&& if(lab_status='0',1,0) ) AS `pending`,sum(if(patient_status='1',1,0)&& if(lab_status='1',1,0) ) AS `done`,sum(if(testing_perform='Blood Count',1,0)&& if(lab_status ='0',1,0) ) AS `Blood Count`,
sum(if(testing_perform='Urine',1,0)&& if(lab_status ='0',1,0) ) AS `Urine`  FROM testing_schedule WHERE lab_status IN ('0','0','1','0')");

$stmt2->execute();
$result2 = $stmt2->get_result();
$chart_data1 = '';

while($row = mysqli_fetch_array($result2)){

    $pending= $row['pending'];
    $Urine= $row['Urine'];
    $Blood_Count= $row['Blood Count'];
    $done= $row['done'];


    $myurl[] = "$done,$pending,$Urine,$Blood_Count";

}

// $chart_data1 = substr($chart_data1, 0, -2);
 implode(',', $myurl);



        ?>
<!-- index22:59-->

<head>
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
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>SEUS HMS </span>

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
include ('sidebar/laboratorist.php');

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
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Patients In</h4>
                                    <div class="float-right">
                                        <!-- <ul class="chat-user-total">
                                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
                                            <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
                                        </ul> -->
                                    </div>
                                </div>
                               <canvas id="myChart" width="400" height="263"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Total Test Done</h4>
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

<!-- second row -->

           


                </div>

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 col-xl-12">
                        <div class="card member-panel">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block">Pending Testings</h4> 
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive" id="user_data">

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
           
            </div>

<!-- delete test schedule -->
    <div id="delete_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to Cancel this Appointment?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="cancelid" class="btn btn-danger">Cancle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- confirm test schedule -->

    <div id="confirm_appointment" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to Confirm this Appointment?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="confirmid" class="btn btn-success"> Confirm </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="sidebar-overlay" data-reff=""></div>

    <div class="sidebar-overlay" data-reff=""></div>

<script src="assets/ajax/jquery.min.js"></script>
<script src="assets/ajax/jquery-3.4.1.min.js"></script>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>

<!-- add from website -->
<script src="assets/chart/moment.js"></script>
<script src="assets/chart/Chart.js"></script>
<script src="assets/chart/Chart.min.js"></script>

<!-- Add from  teplate -->
<script src="assets/js/Chart.bundle.js"></script>
<script src="assets/js/chart.js"></script>

<!-- Old one -->
<script src="assets/chart/morris.js"></script>
<script src="assets/chart/raphael.min.js"></script>


<script src="assets/js/app.js"></script>




    <script>
        $(function () {
            "use strict";



   //  horizontal bar
   var chart = new Chart('myChart', {
            type: 'horizontalBar',
            data: {
                labels: ['Completed','Total Pendings', 'Urine Pending', 'Blood Count Pending'],
                datasets: [

                    {
                        data: [<?php echo implode(',', $myurl); ?>],

                        backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(235, 190, 86, 0.2)',
                'rgba(145, 106, 44, 0.2)'
         
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(235, 190, 86, 1)',
                'rgba(145, 116, 44, 1)'
              
            ],
            borderWidth: 1,
                label: 'Test Pending Status'
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




//  number of test

    //DONUT CHART
    var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: ["#3c8dbc", "#00a65a", "#95D7BB", "#67C69D", "#39B580", "0BA462"],
                data:  <?php echo $json_data; ?>,

                hideHover: 'auto'
                });




            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                    { y: '2006', a: 50, b: 51 },
                    { y: '2007', a: 75, b: 65 },
                    { y: '2008', a: 50, b: 40 },
                    { y: '2009', a: 75, b: 65 },
                    { y: '2010', a: 50, b: 40 },
                    { y: '2011', a: 75, b: 65 },
                    { y: '2012', a: 100, b: 70 }
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['IN', 'OUT'],
                hideHover: 'auto'
            });
        });

    </script>


    <script>

        $(document).ready(function () {

            load_data();

            function load_data() {
                $.ajax({
                    url: "table/lab_table.php", // Url to which the request is send
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

            $("#cancelid").attr('testing_schedule_id', $(this).attr('data_id'));

            $("#delete_appointment").modal({ show: 'true' });

        });

        $(document).on('click', '#rep3', function () {

            $("#confirmid").attr('testing_schedule_id', $(this).attr('data_id'));

            $("#confirm_appointment").modal({ show: 'true' });

        });


        load_data();

        function load_data() {
            $.ajax({
                url: "table/lab_table.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method

                success: function (data) {

                    $('#user_data').html(data);

                }

            });
        }
        $("#cancelid").click(function () {

            var data_id = $("#cancelid").attr('testing_schedule_id');
            $.ajax({
                data: { 'data_id': data_id, },
                type: "POST",
                url: "table/test_status.php",
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

        $("#confirmid").click(function () {

            var datas = $("#confirmid").attr('testing_schedule_id');
            $.ajax({
                data: { 'datas': datas, },
                type: "POST",
                url: "table/test_status.php",
                success: function (data) {
                    //   console.log(data);
                    $('#success_mes').html(data);

                    $("#confirm_appointment").modal('hide');
                    load_data();


                }
            });

            setInterval(function () {
                $('#user_data').load("sidebar/apt_table admin.php").fadeIn("slow");
            }, 500);

        });




    </script>

</body>


<!-- index22:59-->

</html>