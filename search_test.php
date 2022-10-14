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
    <link rel="stylesheet" type="text/css" href="assets/datatable/bs4/dataTables.bootstrap4.min.css">

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
                        <h4 class="page-title">Search Test Payments ?</h4>
                    </div>
                </div>
             



				<div class="profile-tabs">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Search by All</a></li>
						<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Search between Dates</a></li>
						<!-- <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li> -->
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Search Test Payments</h3>
                            <div class="experience-box">
                        


<div id="warn"> </div>

<div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">All Test Payments available here</h6>
                             
                                <div class="table-responsive">
                                <table id="example" style="width:100%" class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th>Invoice No</th>
                                            <th>Patient Name</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <th>Invoice No</th>
                                            <th>Patient Name</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>

                                            </tr>
                                        </tbody>
                                    </table>
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
                                <h6 class="card-title text-bold">Search between available dates</h6>
                           
                                <div class="table-responsive">
                                    <table id="examples" style="width:100%" class="table table-hover">
                                    <thead>
                                            <tr>
                                            <th>Invoice No</th>
                                            <th>Patient Name</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <th>Invoice No</th>
                                            <th>Patient Name</th>
                                            <th>Payment Date</th>
                                            <th>Action</th>

                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>


    <script type="text/javascript" language="javascript">

$(document).ready(function () {

    fetch_Data();

function fetch_Data() {

    var data = $('#example').DataTable({
        "retrieve": true,
        "processing": true, // did false 
        "serverSide": true,
        "order": [],
        "searching" : true,
        "ajax": "adminquery/view_test_payment.php"

    });

}


// date between dates
fill_datatables();

function fill_datatables(startdate = '' , enddate='')
{
var dataTable = $('#examples').DataTable({
"processing" : true,
"serverSide" : true,
"order" : [],
"searching" : true,
"ajax" : {
url:"adminquery/view_test_payment_date.php",
type:"GET",
data:{
    startdate:startdate,enddate:enddate
}
}
});
}

$('#searchs').click(function(){
var startdate = $('#start').val();
var enddate = $('#end').val();

if(startdate != '' ||  enddate != '')
{
$('#examples').DataTable().destroy();
fill_datatables(startdate,enddate);
}
else
{
$('#examples').DataTable().destroy();
fill_datatables();
}
});








    /**---------EDIT A ROW ----------------*/
    $(document).on('click', '#rep1', function () {

        $("#activeid").attr('apt_id', $(this).attr('data_id'));
        $("#activeid").attr('p_id', $(this).attr('data_id1'));
        $("#activeid").attr('apt_date', $(this).attr('data_id2'));
        $("#activeid").attr('user_id', $(this).attr('user_id'));
        $("#activeid").attr('No', $(this).attr('No'));

        $("#active_appointment").modal({ show: 'true' });

    });

// aprove apt
    $("#activeid").click(function () {

        var data_id = $("#activeid").attr('apt_id');
        var p_id = $("#activeid").attr('p_id');
        var date = $("#activeid").attr('apt_date');
        var user_id = $("#activeid").attr('user_id');
        var No = $("#activeid").attr('No');
    

        $.ajax({
            data: {
                'data_id': data_id,
                'p_id': p_id,
                'date': date,
                'user_id': user_id, 
                'No': No, 
                
            },
            type: "POST",
            url: "table/apt status.php",
            success: function (data) {
                //   console.log(data);
                $('#success_mes').html(data);
                if (data === 'Records was updated successfully.') {

                    $('#warn').html('<div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert"> <strong>Success!</strong> Appointment as been approved <a href="#" class="alert-link"> We have notified by Email. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert"> <strong>Error!</strong> <a href="#" class="alert-link"> Something went wrong. Please try again later  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

                $("#success-alert").hide();
                $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function () {
                    $("#success-alert").slideUp(500);
                });
                $("#active_appointment").modal('hide');
                $('#example').DataTable().destroy();
                fill_datatable();


            }
        });


    });



    /**---------EDIT A ROW ----------------*/
    $(document).on('click', '#rep2', function () {

        $("#cancelid").attr('apt_id', $(this).attr('data_id'));
$("#cancelid").attr('p_id', $(this).attr('data_id1'));
$("#cancelid").attr('apt_date', $(this).attr('data_id2'));
$("#cancelid").attr('user_id', $(this).attr('user_id'));
$("#cancelid").attr('No', $(this).attr('No'));

        $("#delete_appointment").modal({ show: 'true' });

    });

// cancel apt
    $("#cancelid").click(function () {

        var data_id = $("#cancelid").attr('apt_id');
var p_id = $("#cancelid").attr('p_id');
var date = $("#cancelid").attr('apt_date');
var user_id = $("#cancelid").attr('user_id');
var No = $("#cancelid").attr('No');

        $.ajax({
            data: {
                'data_id1': data_id,
'p_id': p_id, 
'date': date, 
'user_id': user_id, 
'No': No 
            },
            type: "POST",
            url: "table/apt status.php",
            success: function (data) {
                $('#success_mes').html(data);
                if (data === 'Records was updated successfully.') {

                    $('#warn').html('<div class="alert alert-warning alert-dismissible fade show" id="success-alert" role="alert"> <strong>Cancelled!</strong> Appointment as been cancelled <a href="#" class="alert-link"> We have notified by Email. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                } else {
                    $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert"> <strong>Error!</strong> <a href="#" class="alert-link"> Something went wrong. Please try again later  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }

                $("#success-alert").hide();
                $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function () {
                    $("#success-alert").slideUp(500);
                });

                $("#delete_appointment").modal('hide');
                $('#example').DataTable().destroy();

                fill_datatable();


            }
        });



    });


});


</script>







</body>


<!-- profile23:03-->
</html>