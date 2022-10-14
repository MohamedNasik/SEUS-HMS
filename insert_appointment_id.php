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



    if(!isset($_SESSION['p_id'])){
        header('location:index.php');
        }



$p_id=$_SESSION['p_id'];
// $patientname=$_SESSION['patientname'];


include ('auth/dbconnection.php');

?>


<!-- invoices23:24-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">


    <!-- Data table css -->
    <link href="assets/new datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />




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
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
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
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Enter Appointment Date  </h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">                        
                            <button class="btn btn-white" onclick="location.href='auth/logout_patient.php';"><i class="fa fa-edit fa-lg"></i> Logout</button>
                        
                        
                        </div>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!-- <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a> -->
                    </div>
                </div>
                <div class="row filter-row">

                                        <input class="form-control floating" id="p_id" type="hidden" name="p_id" value="<?php echo $_SESSION['p_id'] ?>">

                                        <span id="types" class="info text-danger"></span><br />
                                        <span id="error" class="info text-danger"></span><br />




                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Enter Appointment Date </label>
                                        <input class="form-control" type="date" id="dates" name="dates">
                                        <span id="type" class="info text-danger"></span><br />


                                    </div>
                                </div>



                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-success btn-block" id="search"> Search </button>
                    </div>
                </div>

                <div id="warn">  </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="list">

                        </div>
                    </div>
                </div>


                <br> <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="result">

                        </div>
                    </div>
                </div>




            </div>

            <div id="open" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                            <h3>Do you sure want to edit this Prescription?</h3>
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="activeid" class="btn btn-success">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>

        <script>


            $(document).ready(function () {

                $("#search").click(function () {
                    $('#result').html('');

                    var p_id = $('#p_id').val();
                    var dates = $('#dates').val();

                    var apt_id = {
                        
                        'p_id': p_id,
                        'dates': dates,
                    
                     }

                    var valid;
                    valid = validateContact();

                    if (valid) {

                        $.ajax({
                            url: "adminquery/fetch/fetch_apt.php", // Url to which the request is send
                            type: "POST",             // Type of request to be send, called as method
                            data: apt_id,

                            success: function (response) {

                                if ($.trim(response) === 'Not Found') {

                                    $('#list').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Failed!</strong> Prescriptions does not founds on this Appointment ID <a href="#" class="alert-link">   </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


                                } else {


                                    $('#list').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> Prescriptions founds on this Appointment ID<a href="#" class="alert-link">    </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                                    $('#result').html(response);

                                }

                                // swal("Saved!", "The appointment has been saved !!.", "success");


                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // swal("Error Saved!", "Please try again", "error");
                            }

                        });

                    };

                    // check validations
                    function validateContact() {
                        var valid = true;
                        $(".demoInputBox").css('background-color', '');
                        $(".info").html('');


                        if (!$("#p_id").val()) {
                            $("#types").html("(Required)");
                            $("#p_id").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$("#dates").val()) {
                            $("#type").html("(Required)");
                            // $("#apt_id").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        // if ($("#p_id").val() != <?php echo $p_id  ?>) {
                        //     $("#error").html("(Wrong ID)");
                        //     // $("#apt_id").css('background-color', '#FFFFDF');
                        //     valid = false;
                        // }


                        return valid;
                    }

                });




            });
// send OTP TO edit

$(document).on('click', '#rep1', function () {

$("#activeid").attr('apt_id', $(this).attr('apt_id'));
$("#activeid").attr('p_id', $(this).attr('p_id'));
$("#activeid").attr('apt_date', $(this).attr('apt_date'));
$("#activeid").attr('user_id', $(this).attr('user_id'));
$("#activeid").attr('pres_id', $(this).attr('pres_id'));


$("#open").modal({ show: 'true' });

});

$("#activeid").click(function () {

var apt_id = $("#activeid").attr('apt_id');
var p_id = $("#activeid").attr('p_id');
var date = $("#activeid").attr('apt_date');
var user_id = $("#activeid").attr('user_id');
var pres_id = $("#activeid").attr('pres_id');

$.ajax({
    data: { 
        'apt_id': apt_id, 
        'p_id': p_id, 
        'date': date, 
        'user_id': user_id, 
        'pres_id': pres_id, 



        },
    type: "POST",
    url: "doctorquery/edit_pres_confirm.php",
    success: function (data) {
        //   console.log(data);
        $('#success_mes').html(data);
        if (data === 'Success') {

        $('#list').html('<div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert"> <strong>Success!</strong> Selected Prescription No: '  + pres_id   +    ' <a href="#" class="alert-link"> OTP has sent to patient Email. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
       
        $("#open").modal('hide');

        setTimeout(function () {
          //Redirect with JavaScript
          window.location= 'prescription_verification.php?pres_id='+pres_id + '&apt_id='+apt_id+ '&apt_date=' +date;
        }, 2000);


        }else{
            $('#list').html('<div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert"> <strong>Error!</strong> <a href="#" class="alert-link"> Something went wrong. Please try again later  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }

        $("#success-alert").hide();
        $("#success-alert").fadeTo(2000, 1000).slideUp(1000, function() {
        $("#success-alert").slideUp(500);
      });

        $("#open").modal('hide');


    }
});


});








        </script>



</body>


<!-- invoices23:25-->

</html>