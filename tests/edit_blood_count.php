<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:../login.php');
            }

      //  redirect to main page according to the user role 
      if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
        header("location: ../index-2.php");
        exit;
     }

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
        header("location: ../index.php");
        exit;
     }
     
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: ../index-recep.php");
        exit;
     }

        ?>
<!-- add-schedule24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">


    <script src="../assets/ajax/jquery.min.js"></script>
    <script src="../assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="../assets/date1/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-datetimepicker.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>





</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo">
                    <img src="../assets/img/logo.png" width="35" height="35" alt=""> <span>SEUS HMS</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg"
                                                    class="img-fluid rounded-circle">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">L</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">G</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                                    added new task <span class="noti-title">Private chat module</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.php">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="../assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span>You</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                            Profile</a>
                        <a class="dropdown-item" href="../edit-profile.php">Edit Profile</a>
                        <a class="dropdown-item" href="../settings.php">Settings</a>
                        <a class="dropdown-item" href="../auth/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="../profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                        Profile</a>
                    <a class="dropdown-item" href="../edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="../settings.php">Settings</a>
                    <a class="dropdown-item" href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Patient Testings</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Blood Count Testings for Mr. <?php echo $_GET['username'];  ?>
                            </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="../assets/img/logo-dark.png" class="inv-logo" alt="">

                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Prescription ID # <?php echo $_GET['presid'];  ?>
                                        </h3>
                                        <ul class="list-unstyled">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5 class="mb-0"> Lab Assistant :
                                                <strong><?php echo  $_SESSION['usernames']   ?></strong></h5>
                                        </li>
                                        <!-- <li><span>Nurse</span></li>
                                        <li>Employee ID: NS-0001</li>
                                        <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="row">

                            </div>

                            <?php
require_once "../auth/dbconnection.php";
// get test id for edit blood count
$stmt = $conn->prepare("SELECT * FROM testing_report WHERE pres_id = ? AND test_id='1' ");
$stmt->bind_param("s",$_GET['presid'] );
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {

    $testing_report_id = $row['testing_report_id'];
    $remark = $row['remark'];

    $testing_results = json_decode($row['testing_results'],true);

    if (is_array($testing_results) || is_object($testing_results)) {
        $testing_results = array_merge(...$testing_results);

            ?>
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">

                                    <form id="form_appoint" method="POST">
                                        <div class="row">


                                            <div class="col-lg-12">
                                                <label>Blood Count Recoder </label>
                                                <div class="card-box">
                                                    <div class="card-block">
                                                        <!-- <h5 class="text-bold card-title">Striped Rows</h5> -->
                                                        <div class="table-responsive">
                                                            <table class="table table-striped mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Modules</th>
                                                                        <th>Results</th>
                                                                        <th>Unit</th>
                                                                        <th>Ref. Ranges</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="rows">

                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>WBC</td>
                                                                        <td>

                                                                            <input type="text" id="1" class="con_password" value="<?php echo $testing_results['WBC'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            10^9/L
                                                                        </td>
                                                                        <td>4.0 - 10.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>2</td>
                                                                        <td>Lymph#</td>
                                                                        <td>

                                                                            <input type="text" id="2" class="con_password" value="<?php echo $testing_results['lymph'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            10^9/L
                                                                        </td>
                                                                        <td>0.8 - 4.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>3</td>
                                                                        <td>Mid#</td>
                                                                        <td>

                                                                            <input type="text" id="3" class="con_password" value="<?php echo $testing_results['Mid'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            10^9/L
                                                                        </td>
                                                                        <td>0.1 - 1.5</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>4</td>
                                                                        <td>Gran#</td>
                                                                        <td>

                                                                            <input type="text" id="4" class="con_password" value="<?php echo $testing_results['Gran'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            10^9/L
                                                                        </td>
                                                                        <td>2.0 - 7.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>5</td>
                                                                        <td>Limph%</td>
                                                                        <td>

                                                                            <input type="text" id="5" class="con_password" value="<?php echo $testing_results['Limp'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            %
                                                                        </td>
                                                                        <td>20.0 - 40.0</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>6</td>
                                                                        <td>Mid%</td>
                                                                        <td>

                                                                            <input type="text" id="6" class="con_password" value="<?php echo $testing_results['Mids'] ?>">

                                                                        </td>
                                                                        <td>
                                                                            % </td>
                                                                        <td>3.0 - 15.0</td>
                                                                    </tr>

                                                                    <td>7</td>
                                                                    <td>RBC</td>
                                                                    <td>

                                                                        <input type="text" id="7" class="con_password" value="<?php echo $testing_results['RBCB'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        10^12/L
                                                                    </td>
                                                                    <td>3.50 - 5.50</td>
                                                                    </tr>

                                                                    <td>8</td>
                                                                    <td>HGB</td>
                                                                    <td>

                                                                        <input type="text" id="8" class="con_password" value="<?php echo $testing_results['HGB'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        g/dL
                                                                    </td>
                                                                    <td>11.0 - 16.0</td>
                                                                    </tr>
                                                                    <td>9</td>
                                                                    <td>HTC</td>
                                                                    <td>

                                                                        <input type="text" id="9" class="con_password" value="<?php echo $testing_results['HCT'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        %
                                                                    </td>
                                                                    <td>37.0 - 54.0</td>
                                                                    </tr>


                                                                    <td>10</td>
                                                                    <td>MCV</td>
                                                                    <td>

                                                                        <input type="text" id="10" class="con_password" value="<?php echo $testing_results['MCV'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        fL
                                                                    </td>
                                                                    <td>80.0 - 100.0</td>
                                                                    </tr>

                                                                    <td>11</td>
                                                                    <td>MCH</td>
                                                                    <td>

                                                                        <input type="text" id="11" class="con_password" value="<?php echo $testing_results['MCH'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        pg
                                                                    </td>
                                                                    <td>27.0 - 34.0</td>
                                                                    </tr>

                                                                    <td>12</td>
                                                                    <td>MCHC</td>
                                                                    <td>

                                                                        <input type="text" id="12" class="con_password" value="<?php echo $testing_results['MCHC'] ?>">

                                                                    </td>
                                                                    <td>
                                                                        g/dL
                                                                    </td>
                                                                    <td>32.0 - 36.0</td>
                                                                    </tr>

                                                                    <td>13</td>
                                                                    <td>RDW-CV</td>
                                                                    <td>

                                                                        <input type="text" id="13" class="con_password" value="<?php echo $testing_results['RDW'] ?>">


                                                                    </td>
                                                                    <td>
                                                                        %
                                                                    </td>
                                                                    <td>11.0 - 16.0</td>
                                                                    </tr>





                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="presid"  value="<?php echo   $_GET['presid'];  ?>">
                                                    <input type="hidden" id="pid"  value="<?php echo   $_GET['pid'];  ?>">
                                                    <input type="hidden" id="testing_report_id"  value="<?php echo   $testing_report_id  ?>">

                                                    <br>

                                                    <div class="row">


                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>Remark <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="remark" name="remark"
                                                                    cols="30"
                                                                    rows="5"> <?php echo $remark  ?> </textarea>



                                                            </div>
                                                        </div>




                                                        <div class="col-sm-12">


                                                            <p>
                                                                <strong><span id="days"
                                                                        class="info text-danger"></span></strong> </p>
                                                            <center>
                                                                <div id="success_mes" class="text text-success"> </div>
                                                            </center>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>


                            </div>


                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="schedule"
                                    value="Update Test" id="test">
                            </div>
                            <br>

                            </form>
                        </div>
                    </div>
                </div>

                <?php       
              
            } } } else {
                echo '<center class="info text-danger"> No any reports found on this Test </center>';
            
            }
            ?>


                <?php

if( $_SESSION['role_id']=='1'){
    include ('../sidebar/adminsidebar.php');
            }  if( $_SESSION['role_id']=='2'){
                include ('../sidebar/doctorsidebar.php');
            }
          if( $_SESSION['role_id']=='3'){
            include ('../sidebar/laboratorist.php');
        }
?>

   

        <div id="add_event" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Event</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Event Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label>Event Date <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        <div class="sidebar-overlay" data-reff=""></div>

        <script src="../assets/ajax/jquery.min.js"></script>
        <script src="../assets/ajax/jquery-3.4.1.min.js"></script>
        <script src="../assets/js/jquery-3.2.1.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/select2.min.js"></script>
        <script src="../assets/js/moment.min.js"></script>
        <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="../assets/js/app.js"></script>




        <script>

$('.con_password').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});




            //    start query
            $(document).ready(function () {

                // save comment to database
                $(document).on('click', '#test', function () {


                    var presid = $('#presid').val();
                    var pid = $('#pid').val();
                    var testname = "Blood Count";
                    var remark = $('#remark').val();
                    var testing_report_id = $('#testing_report_id').val();

                    if (remark === "") {
                        remark = "No any remarks found";
                    } else {
                        var remark = remark;
                    }


                    var datas = {
                        'pressid': presid,
                        'ppid': pid,
                        'testname': testname,
                        'remark': remark,
                        'testing_report_id': testing_report_id,


                    }

                    var modess = $('#rows tr').map(function () {
                        let $tr = $(this);

                        return [{
                         
                            "WBC": $(this).find('#1').val(),
                            "lymph": $(this).find('#2').val(),
                            "Mid": $(this).find('#3').val(),
                            "Gran": $(this).find('#4').val(),
                            "Limp": $(this).find('#5').val(),
                            "Mids": $(this).find('#6').val(),
                            "RBCB": $(this).find('#7').val(),
                            "HGB": $(this).find('#8').val(),
                            "HCT": $(this).find('#9').val(),
                            "MCV": $(this).find('#10').val(),
                            "MCH": $(this).find('#11').val(),
                            "MCHC": $(this).find('#12').val(),
                            "RDW": $(this).find('#13').val(),
                        }]
                        console.log(modess);
                    });

                    var edit_timetable = JSON.stringify($.makeArray(modess));
                    var edit_datas = JSON.stringify(datas);





                    var valid;
                    valid = validateContact();

                    if (valid) {

                        $.ajax({
                            url: "../testquery/edit_bloodcount.php", // Url to which the request is send
                            method: "POST",             // Type of request to be send, called as method
                            data: {
                                index3: edit_timetable,
                                index4: edit_datas
                            },
                            //dataType:'json',             
                            cache: false,



                            success: function (data) {

                                $('#specilization').val('');
                                $('#remark').val('');

                                $('#success_mes').fadeIn().html(data);

                                $("success_mes").fadeIn().html(data);
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

                        if (!$("#1").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#1").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#2").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#2").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#3").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#3").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#4").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#4").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$("#5").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#5").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#6").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#6").css('background-color', '#FFFFDF');
                            valid = false;
                        }


                        if (!$("#7").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#7").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#8").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#8").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$("#9").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#9").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#10").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#10").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$("#11").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#11").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$("#12").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#12").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$("#13").val()) {
                            $("#days").html("(All are mandetory fields)");
                            $("#13").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        // if (!$("#14").val()) {
                        //     $("#days").html("(All are mandetory fields)");
                        //     $("#14").css('background-color', '#FFFFDF');
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