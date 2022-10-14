<!DOCTYPE html>
<html lang="en">
           
<?php
        // Initialize the session
         session_start();


         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
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
    




        ?>



<?php 

//index.php
include ('auth/dbconnection.php');

//  donut chart appointments all

$stmt1 = $conn->prepare("SELECT type, count(*) Consultations from appointment WHERE doctor_status='1' AND user_id='".$_SESSION['user_id']."' group by type ");
$stmt1->execute();
$result1 = $stmt1->get_result();

$data = array(); // define array
while($row = mysqli_fetch_array($result1)){
$data[] = array(
    'label'  => $row["type"],
    'value'  => $row["Consultations"]
);  
}

$json_data = json_encode($data);  // convert to json array



// morris js appointments (consultation + check report)

$stmt = $conn->prepare("SELECT DATE_FORMAT(apt_date, '%d-%b') as apt_date,  sum(if(type='Consultation',1,0)) AS `Consultation`,
sum(if(type='Check Report',1,0)) AS `Check Report` FROM appointment WHERE type IN ('Consultation','Check Report') 
 AND doctor_status='1' AND user_id='".$_SESSION['user_id']."' group by apt_date  limit 7");


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



//  donut chart deceases

$stmt2 = $conn->prepare("SELECT decease_name, count(*) Consultations from prescription  WHERE decease_name !='Reconsultation Need'  group by decease_name");
$stmt2->execute();
$result2 = $stmt2->get_result();

$data = array(); // define array
while($row = mysqli_fetch_array($result2)){
$data[] = array(
'label'  => $row["decease_name"],
'value'  => $row["Consultations"]
);  
}

$json_data1 = json_encode($data);  // convert to json array

//  today

 // VERTICLE cHART appointments

 $stmt2 = $conn->prepare("SELECT sum(if(doctor_status='1',1,0)) AS `confirm`,sum(if(doctor_status='3',1,0)&& if(admin_status='1',1,0) ) AS `pending`,
 sum(if(doctor_status='0',1,0)) AS `cancel` FROM appointment WHERE doctor_status IN ('1','3','0') AND  apt_date=curdate() AND user_id='".$_SESSION['user_id']."' ");

 $stmt2->execute();
 $result2 = $stmt2->get_result();
 $chart_data1 = '';

 while($row = mysqli_fetch_array($result2)){

     $confirm= $row['confirm'];
     $pending= $row['pending'];

     $cancel= $row['cancel'];

     $myurl[] = "$confirm,$pending, $cancel";

 }

 // $chart_data1 = substr($chart_data1, 0, -2);
  implode(',', $myurl);





?>




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


    <script src="assets/datatable/dataTables.bootstrap.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script> -->




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
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span> SEUS HMS
                    </span>
      
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
            
            <!-- Notification start -->
   
            <!--Notification end -->

                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a> -->
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
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
						<a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        
<?php
include ('sidebar/doctorsidebar.php');
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
                                <span class="widget-title2">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
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
                                <span class="widget-title3">Laboratorist <i class="fa fa-check" aria-hidden="true"></i></span>
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
                                <span class="widget-title4">Receptionists <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
		
				<div class="row">
                <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Patients In (Last 7 Days)</h4>
									<div class="float-right">
										<ul class="chat-user-total">
											<li><i class="fa fa-circle old-users" style="color:#00a65a" aria-hidden="true"></i>OPD</li> <li></li>
                                            <li><i class="fa fa-circle old-users" style="color:#f56954" aria-hidden="true"></i>REPORT</li>

                                        </ul>
									</div>
								</div>	
                                <div class="chart" id="bar-chart" style="height: 300px;"></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
                                <h4>Appointment per Type</h4>
									<div class="float-right">
									<ul class="chat-user-total">      
											<li><i class="fa fa-circle old-users" style="color:#f56954"  aria-hidden="true"></i> Consult</li>
                                            <li><i class="fa fa-circle old-users" style="color:#3c8dbc" aria-hidden="true"></i> Report</li>

                                        </ul>
									</div>
								</div>	
                                <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>                                </div>
							</div>
                        </div>
                        

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Today Appointment </h4>
									<div class="float-right">
										<!-- <ul class="chat-user-total">
											<li><i class="fa fa-circle old-users" style="color:#00a65a" aria-hidden="true"></i>OPD</li> <li></li>
                                            <li><i class="fa fa-circle old-users" style="color:#f56954" aria-hidden="true"></i>REPORT</li>
                                        </ul> -->
									</div>
								</div>	
                                <canvas id="chart_test" width="455" height="300"></canvas>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
                                <h4>Statistical Analysis for<code> DECEASE </code>found</h4>
									<div class="float-right">
									<!-- <ul class="chat-user-total">      
											<li><i class="fa fa-circle old-users" style="color:#f56954"  aria-hidden="true"></i> Consult</li>
                                            <li><i class="fa fa-circle old-users" style="color:#3c8dbc" aria-hidden="true"></i> Report</li>
                                        </ul> -->
									</div>
								</div>	
                                <div class="chart" id="sales-charts" style="height: 300px; position: relative;"></div>                                </div>
							</div>
						</div>



                    </div>
          

	

                
				<div class="row">
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card member-panel">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Upcoming Appointments</h4> 
							</div>
							<div class="card-body p-0">
								<div class="table-responsive" id="user_data">

                                
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

    <script src="assets/chart/moment.js"></script>
    <script src="assets/chart/Chart.js"></script>
    <script src="assets/chart/Chart.min.js"></script>

    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>



    <script src="assets/chart/morris.js"></script>
    <script src="assets/chart/raphael.min.js"></script>


    <script src="assets/js/app.js"></script>



    
    <script>
  $(function () {
    "use strict";

//     var ctx = document.getElementById('myChart');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)',
//                 'rgba(54, 162, 235, 0.2)',
//                 'rgba(255, 206, 86, 0.2)',
//                 'rgba(75, 192, 192, 0.2)',
//                 'rgba(153, 102, 255, 0.2)',
//                 'rgba(255, 159, 64, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255, 99, 132, 1)',
//                 'rgba(54, 162, 235, 1)',
//                 'rgba(255, 206, 86, 1)',
//                 'rgba(75, 192, 192, 1)',
//                 'rgba(153, 102, 255, 1)',
//                 'rgba(255, 159, 64, 1)'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });




//BAR CHART
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


    //DONUT CHART appointment all
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954"],
      data:  <?php echo $json_data; ?>,
      hideHover: 'auto'
    });


    //DONUT CHART deceases
    var donut = new Morris.Donut({
                element: 'sales-charts',
                resize: true,
                colors: ["#3c8dbc", "#00a65a", "#95D7BB", "#67C69D", "#39B580", "0BA462"],
                data:  <?php echo $json_data1; ?>,

                hideHover: 'auto'
                });

//   today managements


    //  horizontal bar
    var chart = new Chart('chart_test', {
            type: 'horizontalBar',
            data: {
                labels: ['Discharge', 'Pending', 'Cancelled'],
                datasets: [

                    {
                        data: [<?php echo implode(',', $myurl); ?>],


                // data: [50, 30,70],
                backgroundColor: '#c46998',
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






});


</script>




<script>

$(document).ready(function () {
    
    unseen_notification();

    function unseen_notification(view=''){

$.ajax({
          url: "adminquery/load_not.php", // Url to which the request is send
          method: "POST",             // Type of request to be send, called as method
          data:{ view: view },
          dataType: "json",
          success: function (data) {

        $('.notification-list').html(data.notification);
    if(data.unseen_notification > 0){
$('.count').html(data.unseen_notification);

    }
          }

      });

}

unseen_notification();



load_data();
function load_data(){
    $.ajax({
              url: "table/doctable.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
            
              success: function (data) {

                  $('#user_data').html(data);
        
              }

          });

}



});


</script>








</body>



</html>