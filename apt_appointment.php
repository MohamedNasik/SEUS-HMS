<!DOCTYPE html>
<html lang="en">

<?php

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

<!-- tables-datatables23:59-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">



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
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i clas
                    s="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a> -->

                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span>You</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php">My Profile</a>
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
                    <a class="dropdown-item" href="profile.php">My Profile</a>
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
                        <h4 class="page-title">Today Appointments</h4>
                    </div>
                </div>
                <div id="warn"> </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Today appointments available here</h6>
                                <p class="content-group">
                                    Click the button under the <code> Change </code> table.
                                </p>
                                <div class="table-responsive">
                                    <table id="example" style="width:100%" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Apt ID</th>
                                                <th>Patient</th>
                                                <th>Type</th>
                                                <th>Apt.Date</th>
                                                <th>Status</th>
                                                <th>Change</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Apt ID</th>
                                                <th>Patient</th>
                                                <th>Type</th>
                                                <th>Apt.Date</th>
                                                <th>Status</th>
                                                <th>Change</th>


                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="unattended_appointment" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to change to Un attended patient?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="cancelid"  class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="active_appointment" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to Active this Patient?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="activeid" class="btn btn-success">Active</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
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
                    "ajax": "adminquery/fetch/appointment/fetch_doc_today.php"

                });



            }

/**---------EDIT A ROW ----------------*/
$(document).on('click', '#rep1', function () {

$("#activeid").attr('apt_id', $(this).attr('data_id'));
$("#activeid").attr('p_id', $(this).attr('data_id1'));
$("#activeid").attr('apt_date', $(this).attr('data_id2'));
$("#activeid").attr('user_id', $(this).attr('user_id'));
$("#activeid").attr('No', $(this).attr('No'));


$("#active_appointment").modal({ show: 'true' });

});


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
url: "doctorquery/apt status.php",
success: function (data) {
    //   console.log(data);
    $('#success_mes').html(data);
    if (data === 'Records was updated successfully.') {

    $('#warn').html('<div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert"> <strong>Success!</strong> Appointment as been approved <a href="#" class="alert-link"> We have notified by Email. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }else{
        $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert"> <strong>Error!</strong> <a href="#" class="alert-link"> Something went wrong. Please try again later  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }

    $("#success-alert").hide();
    $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function() {
    $("#success-alert").slideUp(500);
  });
    $("#active_appointment").modal('hide');
    $('#example').DataTable().destroy();
    fetch_Data();


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



$("#unattended_appointment").modal({ show: 'true' });

});



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
    url: "doctorquery/apt status.php",
    success: function (data) {
        $('#success_mes').html(data);
        if (data === 'Records was updated successfully.') {

$('#warn').html('<div class="alert alert-warning alert-dismissible fade show" id="success-alert" role="alert"> <strong>Cancelled!</strong> Appointment as been cancelled <a href="#" class="alert-link"> We have notified by Email. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
}else{
    $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert"> <strong>Error!</strong> <a href="#" class="alert-link"> Something went wrong. Please try again later  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
}

$("#success-alert").hide();
        $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function() {
        $("#success-alert").slideUp(500);
      });

        $("#unattended_appointment").modal('hide');
        $('#example').DataTable().destroy();

        fetch_Data();


    }
});



});







        });


    </script>



</body>

</html>