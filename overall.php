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
            $stmt = $conn->prepare("SELECT DATE_FORMAT(apt_date, '%M') as apt_date, sum(if(doctor_status='1',1,0)) AS `completed`, sum(if(admin_status='1',1,0) AND if(doctor_status='3',1,0)) AS `progress`,  sum(if(admin_status='0',1,0)) AS `cancel`,
            sum(if(admin_status='3',1,0)) AS `not` FROM appointment WHERE  doctor_status AND admin_status IN ('1','0','3')  AND  apt_date BETWEEN ADDDATE(NOW(),-365) AND NOW()
              GROUP BY DATE_FORMAT(apt_date, '%M')");

            // apt_date>= (CURDATE() - INTERVAL 30 DAY ) AND NOW()
            // DATE_FORMAT(apt_date, '%d-%b-%Y')

            // $stmt->bind_param("s",$_POST['data_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $chart_data = '';

            while($row = mysqli_fetch_array($result)){
            $apt_date= $row['apt_date'];
           
                $completed= $row['completed'];
                $cancel= $row['cancel'];
                $not= $row['not'];
                $progress= $row['progress'];

                      
                $chart_data .= "{ apt_date:'".$apt_date."', completed:'".$completed."', progress:'".$progress."', not:'".$not."',cancel:'".$cancel."'}, ";
            }

            $chart_data = substr($chart_data, 0, -2);



            // dONUT cHART starts
            $stmt1 = $conn->prepare("SELECT decease_name, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need' AND date BETWEEN ADDDATE(NOW(),-365) AND NOW()  group by decease_name");
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

//  new chart

        // morris js starts
        $stmt2 = $conn->prepare("SELECT decease_name, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name");

        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $chart_datas = '';
        $labels = '';

        while($row = mysqli_fetch_array($result2)){
       
            $decease_name= $row['decease_name'];
            $Consultations= $row['Consultations'];
   

                  
            $chart_datas .= "'".$Consultations."', ";
            $labels .= "'".$decease_name."', ";

        }

        $chart_datas = substr($chart_datas, 0, -2);
        $labels = substr($labels, 0, -2);

// ended



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
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                <h4>Patients IN (Last One Year)</h4>
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
                </div>

                
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                <h4>OPD Patients In (Last 1 Year) [Category wise]</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                        <li><i class="fa fa-circle old-users" style="color:#00a65a"
                                                    aria-hidden="true"></i> Completed </li>
                                            <li></li>
                                            <li><i class="fa fa-circle current-users" style="color:#808080"
                                                    aria-hidden="true"></i> In Progress</li>
                                                    <li><i class="fa fa-circle current-users" style="color:#FFA500"
                                                    aria-hidden="true"></i> Not Attended</li>     
                                                    <li><i class="fa fa-circle current-users" style="color:#f56954"
                                                    aria-hidden="true"></i> Cancelled</li>
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
                    <!-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
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
                    </div> -->

    

                    <!-- <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Statistical Analysis for Deceases found</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                       
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="polar-charts" width="450" height="300"></canvas>
                            </div>
                        </div>
                    </div> -->

       



                </div>




                <div class="row">
               


                <div class="col-6 col-md-6 col-lg-6 col-xl-6">
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

                    <div class="col-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4 class="card-title d-inline-block">Lab Management</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                     
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






        //BAR CHART starts
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data: [<?php echo $chart_data; ?>],

            barColors: ['#00a65a', '#808080','#FFA500','#f56954'],
            xkey: 'apt_date',
            ykeys: ['completed','progress','not', 'cancel'],
            labels: ['Completed','In Progress', 'Not Attended','Cancelled'],
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




</body>

</html>