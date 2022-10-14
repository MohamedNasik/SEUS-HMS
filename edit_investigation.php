<!DOCTYPE html>
<html lang="en">

<?php

session_start();

$p_id=$_SESSION['p_id'];
// $patientname=$_SESSION['patientname'];

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



include ('doctorquery/fetch_select.php');
$getapt= $_GET['aptid'];
?>



<!-- salary-view23:28-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/summernote/summernote.css">


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">
    <script src="assets/sweetalert/bestsweet.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>
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
                        <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                            Profile</a>
                        <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                        <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
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
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.html">Settings</a> -->
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
                    <div class="col-sm-5 col-4">
                    <h4 class="page-title">Patient Prescription for # <?php echo $_GET['pres_id']  ?></h4>
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

 <?php
include ('auth/dbconnection.php');
$query="SELECT * FROM appointment WHERE apt_id= '".$_GET['aptid']."' AND user_id=  '".$_SESSION['user_id']."' AND p_id= '". $_SESSION['p_id'] ."' AND apt_date='".$_GET['apt_date']."' AND admin_status='1'";
$results =mysqli_query($conn,$query);
if(mysqli_num_rows($results) > 0){
    while($row =mysqli_fetch_array($results))
    {
?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Medical Prescription for <strong>
                                    <?php echo $row['patient_name'];  ?> </strong> </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">

                                </div>

                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Appointment ID #<?php echo $row['apt_id'];  ?></h3>
                                        <ul class="list-unstyled">
                                            <li>Patient ID: <span><?php echo $row['p_id'];    ?></span></li>
                                            <li>Apt Date: <span><?php echo $row['apt_date'];    ?></span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <?php     }

}
else{

}  ?>

                            <!-- TAB START -->

                            <div class="col-md-12">
                                <div id="warn"> </div>
                                <div class="card-box">
                                    <!-- <h4 class="card-title">Rounded justified</h4> -->
                                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                        <li class="nav-item"><a class="nav-link active"
                                                href="#solid-rounded-justified-tab1"
                                                data-toggle="tab">Investigations</a></li>
                                        <!-- <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"
                                                data-toggle="tab">Medical Prescribings</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3"
                                                data-toggle="tab">Testings</a></li> -->
                                    </ul>


<?php
include ('auth/dbconnection.php');
$query="SELECT * FROM prescription WHERE apt_id= '".$_GET['aptid']."' AND user_id=  '".$_SESSION['user_id']."' AND pres_id='".$_GET['pres_id']."' ";
$results =mysqli_query($conn,$query);
if(mysqli_num_rows($results) > 0){
    while($row =mysqli_fetch_array($results))
    {
     $row['decease_name'];
        $investigations = json_decode($row['investigations'],true);

        if (is_array($investigations) || is_object($investigations)) {
            foreach($investigations as $key => $object) {
        
?>


                                    <form method="post" id="prescriptionn" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="solid-rounded-justified-tab1">
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Presenting
                                                            Complaints </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="complaints" name="complaints"
                                                            class="form-control summernote"
                                                            placeholder="Enter your remark here">   <?php echo $object['complaints'] ?></textarea>
                                                        <span id="complaints-info" class="info text-danger"></span>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Past History
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="history" name="history"
                                                            class="form-control summernote"
                                                            placeholder="Enter your remark here"> <?php echo $object['history'] ?></textarea>
                                                        <span id="history-info" class="info text-danger"></span>

                                                    </div>
                                                </div>




                                                <input type="hidden" value="<?php echo $row['apt_id'] ?>" id="getapt"
                                                    name="getapt" class="btn btn-primary">
                                                <input type="hidden" value="<?php echo $row['p_id'] ?>" id="getpid"
                                                    name="getpid" class="btn btn-primary">

                                                    <input type="hidden" value="<?php echo $row['pres_id'] ?>" id="pres_id"
                                                    name="pres_id" class="btn btn-primary">

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Investigations
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="investigations"
                                                            name="investigations" class="form-control summernote"
                                                            placeholder="Enter your remark here"><?php echo $object['investigations'] ?></textarea>
                                                        <span id="investigations-info" class="info text-danger"></span>

                                                    </div>
                                                </div>

                                                <p>

                                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                                        data-target="#collapseExample" aria-expanded="false"
                                                        aria-controls="collapseExample">
                                                        <i class="fa fa-plus lg"> Hidden Remark</i>
                                                    </button>
                                                </p>
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-md-12"><strong> Write
                                                                    hidden Remark ( any Critical Symtoms)
                                                                </strong></label>
                                                            <div class="col-md-10">
                                                                <textarea rows="5" cols="5" id="hidden" name="hidden"
                                                                    class="form-control summernote"
                                                                    placeholder="Enter your remark here"><?php echo $object['hidden'] ?></textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Select Deseace Name <span
                                                                class="text-danger">*</span></label>
                                                        <select class="select" id="decease" name="decease">
                                                            <option value="Select">Select</option>

                                                            <?php    
                                             require_once 'auth/dbconnection.php';
                                             $sql = "SELECT * FROM deceases";
                                             if($result = mysqli_query($conn, $sql)){
                                             if(mysqli_num_rows($result) > 0){
                                             while($rows = mysqli_fetch_array($result)){ 
                                                 $des=$rows['deseace_name'];
                                                }}} 
                                                 ?>
                                                            <option value="<?php echo $row['decease_name']; ?>"  <?php if( $row['decease_name'] == $des) echo 'selected="selected"'; ?>>
                                                                <?php echo $row['decease_name']; ?></option>
                                                            <?php        ?>
                                                        </select>
                                                        <span id="typeposs" class="info text-danger"></span><br />
                                                    </div>
                                                </div>

                                                <div class="m-t-20 text-center">
                                                    <input type="button" name="submit" id="submit"
                                                        class="btn btn-primary" value="Enter Prescription">
                                                </div>

                                            </div>
                                  
                               
                                        </div>

                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                    <!-- tab finish -->

                    <center>
                        <div id="result" class="text text-success"> </div>
                    </center> <br>

                    <div class="col-sm-12">
                    </div>

                    <?php     }} }

}
else{

}  ?>


                </div>
            </div>
        </div>
    </div>
    </div>



    <div id="take" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <center> <span class="dash-widget-bg1"><i class="fa fa-user-md"></i> </span>
                        <h3> Sure to Prescribe another Doctor ?</h3>
                    </center>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <strong> <label>Specilization type</label></strong>
                                    <select class="select specilization" id="specilization" name="specilization">
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
                                    <strong> <label>Doctor Name</label></strong>
                                    <select class="select" id="doctor_name" name="doctor_name">
                                        <option value="Select Doctor">Select Doctor</option>
                                    </select>
                                    <span id="type" class="info text-danger"></span><br />
                                </div>
                            </div>



                            <label class="col-form-label col-md-12"><strong> Remark of the patient</strong></label> <br> <br>
                            <div class="col-md-12">
                                <textarea rows="5" cols="5" id="doc_description" name="doc_description"
                                    class="form-control" placeholder="Enter your remark here"></textarea>
                                <span id="descrip" class="info text-danger"></span><br />

                            </div>

                        </div>
                    </div>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" id="recommend" class="btn btn-primary">Save it</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <!-- <script src="assets/select/jquery-editable-select.min.js"></script> -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/summernote/summernote.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/tagsinput.js"></script>


<script>

    $(document).ready(function() {
      $('.summernote').summernote({
        height: 300,
        tabsize: 2
      });
	  
	   $('input[type="file"]').imageuploadify();
    });



</script>


    <script>


        $(document).ready(function () {

    
            $(document).on('click', '#submit', function () {

                var hidden = $("#hidden").val();

                if (hidden == '') {
                    hidden = 'No hidden remarks found';

                } else {
                    hidden = $("#hidden").val();
                }

                // select doctor
                var investigations = {
                    "complaints": $('#complaints').val(),
                    "history": $('#history').val(),
                    "investigations": $('#investigations').val(),
                    "hidden": hidden
                };


                var getapt = $('#getapt').val();
                var getpid = $('#getpid').val();
                var decease = $('#decease').val();
                var pres_id = $('#pres_id').val();


                var ids = {
                    'getapt': getapt,
                    'getpid': getpid,
                    'decease': decease,
                    'pres_id': pres_id,

                }



                var ids = JSON.stringify(ids);
                var investigations = JSON.stringify($.makeArray(investigations));

                var valid;
                valid = validateContact();
                if (valid) {
                    swal({
                        title: "Are you sure?",
                        text: "You wanna save this Prescription!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, Save It!",
                        closeOnConfirm: false
                    },
                        function (isConfirm) {
                            if (!isConfirm) return;


                            $.ajax({
                                url: "adminquery/prescription/1/update_investigation.php", // Url to which the request is send
                                method: "POST",             // Type of request to be send, called as method
                                data: {
                                    index2: ids,
                                    index4: investigations

                                },
                                //dataType:'json',             
                                cache: false,



                                success: function (data) {


                                    $("success_mes").html(data);

                                    if ($.trim(data) === 'Saved') {

                                        swal("Success", "Prescription has been saved :)", "success");

                                        // setTimeout(function () {
                                        //     //Redirect with JavaScript
                                        //     window.location.href = 'insert_appointment_id.php';
                                        // }, 2000);

                                    } else {
                                        //our handled error
                                        swal("Sorry", "Failed to insert Prescription.  :(", "error");
                                    }
                                },
                                error: function (data) {
                                    //other errors that we didn't handle
                                    swal("Sorry", "Failed to send order. Please try later :(", "error");
                                }


                            });
                        });


                };

                //check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');


                    if (!$("#complaints").val()) {
                        $("#complaints-info").html("(Complaints field is required, Please fill it !!!!)");
                        $("#complaints").css('background-color', '#FFFFDF');
                        valid = false;
                    }


                    if (!$("#history").val()) {
                        $("#history-info").html("(History field is required, Please fill it !!!!)");
                        $("#history").css('background-color', '#FFFFDF');
                        valid = false;
                    }



                    if (!$("#investigations").val()) {
                        $("#investigations-info").html("(Investigations field is required, Please fill it !!!!)");
                        $("#investigations").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if ($("#decease").val() == 'Select') {
                        $("#typeposs").html("(Please select appropriate type)");
                        //    $("#specilization").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    return valid;
                }

            });

        });
    </script>


</body>


<!-- salary-view23:28-->

</html>