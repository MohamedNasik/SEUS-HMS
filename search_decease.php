<!DOCTYPE html>
<html lang="en">
<?php

session_start();

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



    require_once "auth/dbconnection.php";

            // dONUT cHART starts
            $stmt1 = $conn->prepare("SELECT decease_name, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need' AND date BETWEEN ADDDATE(NOW(),-30) AND NOW()  group by decease_name");
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


      $stmt2 = $conn->prepare("SELECT decease_name, DATE_FORMAT(date, '%M') as dates, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name, DATE_FORMAT(date, '%M')") ;

      $stmt2->execute();
      $result2 = $stmt2->get_result();
      $chart_datas = '';
      $labels = '';
      $date = '';

      while($row = mysqli_fetch_array($result2)){
     
          $decease_name= $row['decease_name'];
          $Consultations= $row['Consultations'];
          $dates= $row['dates'];

          $chart_datas .= "'".$Consultations."', ";
          $labels .= "'".$decease_name."', ";
          $dates .= "'".$dates."', ";

      }

      $chart_datas = substr($chart_datas, 0, -2);
      $labels = substr($labels, 0, -2);
      $dates = substr($dates, 0, -2);




?>




<!-- profile22:59-->
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" type="text/css" href="assets/chart/Chart.css">
    <link rel="stylesheet" type="text/css" href="assets/chart/Chart.min.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index-2.html" class="logo">
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
                        <span>Admin</span>
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
            } 
          if( $_SESSION['role_id']=='4'){
            include ('sidebar/receptionist.php');
        }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">Search Deceases ?</h4>
                    </div>
                </div>
             



				<div class="profile-tabs">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Search between Dates</a></li>
						<!-- <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li> -->
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
                <div class="row">
            
						</div>
						<div class="tab-pane" id="bottom-tab2">
                        <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Enter start date and End date to search</h3>
                            <div class="experience-box">
                            <div class="row filter-row">


<div class="col-sm-4">
    <div class="form-group">
        <label>Start Date </label>
        <input class="form-control" type="date" id="start" name="start">
        <span id="startdate" class="info text-danger"></span><br />


    </div>
</div>

<div class="col-sm-4">
    <div class="form-group">
        <label>End Date </label>
        <input class="form-control" type="date" id="end" name="end">
        <span id="enddate" class="info text-danger"></span><br />


    </div>
</div>

<div class="col-sm-6 col-md-3">
<div class="form-group">
<label></label>

<button class="btn btn-success btn-block" id="searchs"> Search </button>
</div>
</div>  </div>

<div id="warn"> </div>
<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                           
                                <div class="row">
                                  <div class="col-md-12">
                   
                            
              <div id="result"> 

<?php

$stmt3 = $conn->prepare("SELECT decease_name, DATE_FORMAT(date, '%M, %Y') as dates, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name , DATE_FORMAT(date, '%M')");

$stmt3->execute();
$result3 = $stmt3->get_result();
$chart_datass = '';
$label1 = '';
$label2 = '';


?>

<h4 class="payslip-title">Statistical Analysis for the Month </h4>

<div class="row">
    <div class="col-sm-6 m-b-20">
        <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
        <ul class="list-unstyled mb-0">
            <li>SEUS Hospital</li>
            <li>No.22, Kahagolla Road,</li>
            <li>Bandarawela</li>
        </ul>
    </div>
 
</div>


<div class="row">
    <div class="col-sm-12">
        <div>
            <h4 class="m-b-10"><strong>Statistical Details</strong></h4>
            <div class="table-responsive" id="result">
            <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Deceases found</th>
                                            <th>Amont of patients</th>
                                   
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$query = "SELECT decease_name , DATE_FORMAT(date, '%M, %Y') as date, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name , date";
$stmt3->execute();
$result3 = $stmt3->get_result();
$chart_datass = '';
$label1 = '';
$label2 = '';

while($row = mysqli_fetch_array($result3)){
      
    $chart_datass = "".$row['decease_name']." ";
    $label1 = "".$row['Consultations']." ";
    $label2 = "".$row['dates']." ";

?>

                                        <tr>
                                            <td><?php  echo $label2     ?></td>
                                            <td><?php  echo $chart_datass     ?></td>
                                            <td><?php  echo $label1     ?></td>
                                      
                                        </tr>
                                      <?php  } ?>
                                    </tbody>
                                </table>
                                </div>
        </div>
    </div>

   


  

    <!-- <div class="col-sm-12">
        <p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
    </div> -->
</div>
<center>
<a  href="adminquery/fetch/appointment/fetch_statis.php?print=1" ><i class="fa fa-print"></i> View Results</a> </center>
          
                                
                                    

        
                            
                            </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    </div>





                      
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
        <div>
            <h4 class="m-b-12"><strong>Graph</strong></h4>
            
            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                    
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <!-- <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
											<li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li> -->
                                        </ul>
                                    </div>
                                </div>
                                <div id="can">
                                <canvas id="pie-chart" width="800" height="450"></canvas>
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
						<!-- <div class="tab-pane" id="bottom-tab3">
							Tab content 3
						</div> -->
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>

    <script src="assets/chart/morris.js"></script>
    <script src="assets/chart/raphael.min.js"></script>

    <script src="assets/chart/Chart.js"></script>
    <script src="assets/chart/Chart.min.js"></script>

    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>

    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>


    <script type="text/javascript" language="javascript">

$(function () {
    "use strict";
      new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
        labels: [<?php echo $labels; ?>],
      datasets: [{
        label: "Population",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
        data: [<?php echo $chart_datas; ?>]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted Deceases'
      }
    }
});

            });



$(document).ready(function () {

    $(document).on('click', '#searchs', function () {
        var startdate = $('#start').val();
        var enddate = $('#end').val();


    $('#result').html('');

    var valid;
    valid = validateContact();
    if (valid) {
    

    
    $.ajax({
              url:"adminquery/fetch/appointment/fetch_statis.php",// Url to which the request is send
              method: "POST", // Type of request to be send, called as method
              data:{
                startdate: startdate,
                enddate: enddate


              },
              dataType:'text',             
           
              success: function(data){
              
                $('#result').html(data);
                $('#tests').html('');
                
            },
            error: function(e){
                console.log(e);
            }

          });

        };

  // check validations
  function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                
                    if (!$("#start").val()) {
                        $("#selectid").html("(Required)");
                        // $("#pid").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#end").val()) {
                        $("#selectid").html("(Required)");
                        // $("#pid").css('background-color', '#FFFFDF');
                        valid = false;
                    }


                    return valid;
                }

});

    $(document).on('click', '#print', function () {
        var startdates = $('#start').val();
        var enddates = $('#end').val();
        var print = '1';

    // var valid;
    // valid = validateContact();
    // if (valid) {
    

    
    $.ajax({
              url:"adminquery/fetch/appointment/fetch_statis.php",// Url to which the request is send
              method: "POST", // Type of request to be send, called as method
              data:{
                startdates: startdates,
                enddates: enddates,
                print: print


              },
              dataType:'text',             
           
              success: function(data){
              
           

                
            },
            error: function(e){
                console.log(e);
            }

          });

        
  // check validations
//   function validateContact() {
//                     var valid = true;
//                     $(".demoInputBox").css('background-color', '');
//                     $(".info").html('');

                
//                     if (!$("#start").val()) {
//                         $("#selectid").html("(Required)");
//                         // $("#pid").css('background-color', '#FFFFDF');
//                         valid = false;
//                     }
//                     if (!$("#end").val()) {
//                         $("#selectid").html("(Required)");
//                         // $("#pid").css('background-color', '#FFFFDF');
//                         valid = false;
//                     }


//                     return valid;
//                 }

});








    fill_datatable();

function fill_datatable(dates = '' , doctor_name='')
{
var dataTable = $('#example').DataTable({
"processing" : true,
"serverSide" : true,
"order" : [],
"searching" : true,
"ajax" : {
url:"adminquery/fetch/appointment/fetch_appointment.1.php",
type:"GET",
data:{
dates:dates,doctor_name:doctor_name
}
}
});
}

$('#search').click(function(){
var dates = $('#dates').val();
var doctor_name = $('#doctor_name').val();

if(dates != '' ||  doctor_name != '')
{
$('#example').DataTable().destroy();
fill_datatable(dates,doctor_name);
}
else
{
$('#example').DataTable().destroy();
fill_datatable();
}
});


// 









});


</script>







</body>


<!-- profile23:03-->
</html>