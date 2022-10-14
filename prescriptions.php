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





include ('doctorquery/fetch_select.php');
$getapt= $_GET['aptid'];
?>



<!-- salary-view23:28-->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">


    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/select/jquery-editable-select.min.css"> -->
    <link rel="stylesheet" href="assets/summernote/summernote.css">

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
                        <h4 class="page-title">Patient Prescription</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <a href="doctor_recommendations.php?pname=<?php echo $_GET['pname']?>&p_id=<?php echo $_GET['p_id']?> "
                            class="btn btn-success btn-rounded"><i class="fa fa-user-md"> </i> Doctor Recomedations </a>

                            <a href="patient_activations.php?p_id=<?php echo $_GET['p_id']  ?>&aptid=<?php echo $_GET['aptid'] ?> "
                            class="btn btn-primary btn-rounded"><i class="fa fa-list"></i> Past Prescription Details</a>
                           
                        <a href="#" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#take"><i
                                class="fa fa-user"> </i> Add Another Doctor</a>

                    </div>
                </div>

                <?php
include ('auth/dbconnection.php');
$query="SELECT * FROM appointment as ap INNER JOIN users as u ON ap.user_id=u.user_id  AND ap.No= '".$_GET['no']."' INNER JOIN check_report as cr ON cr.user_id=ap.user_id AND cr.p_id=ap.p_id AND cr.check_date=ap.apt_date AND u.user_id= '".$_SESSION['user_id']."'";

$results =mysqli_query($conn,$query);
if(mysqli_num_rows($results) > 0){
    while($row =mysqli_fetch_array($results))
    {
        $p_id=$row["p_id"];
?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                        <h4 class="payslip-title">Medical Prescription for 
                            <a href="#" data-toggle="modal" data-target="#patient" > <strong> <?php echo $row['patient_name'];  ?> </strong>   </a> </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">

                                </div>

                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Appointment ID #<?php echo $row['apt_id'];  ?></h3>
                                        <ul class="list-unstyled">
                                            <li>Past Priscription : <span><?php echo $row['pres_id'];    ?></span></li>
                                            <input type="hidden" id="pres" value="<?php echo $row['pres_id'];    ?>">
                                            <li>Apt Date: <span><?php echo $row['apt_date'];    ?></span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5 class="mb-0"><strong>Dr.</strong> <?php echo $row['fname'].' '.$row['lname']  ;  ?> </h5>
                                        </li>
                                        <li><span><?php echo $row['specilization'];  ?> </span></li>
                                        <li>Doctor ID: <?php echo $row['user_id'];  ?> </li>
                                        <!-- <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
                                </div>
                            </div>

                            <!-- TAB START -->

                            <div class="col-md-12">
                                <div id="warn"> </div>
                                <div class="card-box">
                                    <!-- <h4 class="card-title">Rounded justified</h4> -->
                                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                        <li class="nav-item"><a class="nav-link active"
                                                href="#solid-rounded-justified-tab1" data-toggle="tab">Diagnosis </a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"
                                                data-toggle="tab">Medical Prescribings</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3"
                                                data-toggle="tab">Testings</a></li>
                                    </ul>

                                    <form method="post" id="prescriptionn" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="solid-rounded-justified-tab1">


                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Remark for past
                                                            testings  <span class="text-danger">*</span></strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="history" name="history"
                                                            class="form-control summernote"
                                                            placeholder="Enter your remark here"></textarea>
                                                        <span id="history-info" class="info text-danger"></span>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Complaints (if any) <span class="text-danger">*</span>
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="complaints" name="complaints"
                                                            class="form-control summernote"
                                                            placeholder="Enter your remark here"></textarea>
                                                        <span id="complaints-info" class="info text-danger"></span>

                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Special
                                                            Investigations <span class="text-danger">*</span> </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="investigations"
                                                            name="investigations" class="form-control summernote"
                                                            placeholder="Enter your remark here"></textarea>
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
                                                                    hidden Remark ( any Critical Symtoms) <span class="text-danger">*</span>
                                                                </strong></label>
                                                            <div class="col-md-10">
                                                                <textarea rows="5" cols="5" id="hidden" name="hidden"
                                                                    class="form-control summernote"
                                                                    placeholder="Enter your remark here"></textarea>
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
                                                            <option value="Reconsultation Need">Reconsultation Need
                                                            </option>


                                                            <?php    
                                             require_once 'auth/dbconnection.php';
                                             $sql = "SELECT * FROM deceases";
                                             if($result = mysqli_query($conn, $sql)){
                                             if(mysqli_num_rows($result) > 0){
                                             while($row = mysqli_fetch_array($result)){  ?>
                                                            <option value="<?php echo $row['deseace_name']; ?>">
                                                                <?php echo $row['deseace_name']; ?></option>
                                                            <?php     }}}     ?>
                                                        </select>
                                                        <span id="typeposs" class="info text-danger"></span><br />
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Write Decease Name
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter your decease name here" id="decease">
                                                    </div>
                                                </div> -->


                                            </div>
                                            <div class="tab-pane" id="solid-rounded-justified-tab2">
                                                <div class="col-lg-12">
                                                    <!-- <div class="card-box"> -->
                                                    <div class="card-block">
                                                        <!-- <h5 class="text-bold card-title">Striped Rows</h5> -->
                                                        <!-- <form method="post" id="prescriptionn" enctype="multipart/form-data">   -->

                                                        <strong> Please provide the medicine is avilable <span class="text-danger">*</span> </strong> <br>
                                                        <br>

                                                        <div class="form-group">
                                                            <!-- <label class="display-block">Schedule Status</label> -->
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input passed" type="radio" name="passed" id="needs" value="need medicine">
                                                                <label class="form-check-label" for="product_active"> Need </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input passed" type="radio" name="passed" id="noneed" value="no need medicine"  checked>
                                                                <label class="form-check-label" for="product_inactive"> Not Need </label>
                                                            </div>
                                                        </div>

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered mb-0" id="medical">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Medicine Name</th>
                                                                        <th>Morning</th>
                                                                        <th>Noon</th>
                                                                        <th>Night</th>
                                                                        <th>Period</th>

                                                                        <th> </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="rows">

                                                                </tbody>
                                                            </table>
                                                            <br><br>
                                                            <div align="right">
                                                                <button type="button" name="add" id="add" class="btn btn-success btn-xs add" disabled="disabled"> + </button>
                                                            </div>

                                                            <input type="hidden" value="<?php echo $_GET['aptid'] ?>" id="getapt" name="getapt" class="btn btn-primary">
                                                            <input type="hidden" value="<?php echo $_GET['p_id'] ?>" id="getpid" name="getpid" class="btn btn-primary">

                                                            <input type="hidden" value="<?php echo $_GET['no'] ?>" id="no"
                                                    name="no" class="btn btn-primary">
                                                            <!-- <textarea rows="5" cols="5" id="dietadvice" name="dietadvice" class="form-control" placeholder="Enter your remark here"></textarea> -->


                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-md-12"><strong> Remark
                                                                    (Diet Advice) <span class="text-danger">*</span> </strong></label> <br> <br>
                                                            <div class="col-md-10">
                                                                <textarea rows="5" cols="5" id="dietadvice" name="dietadvice" class="form-control summernote" placeholder="Enter your remark here"></textarea>
                                                                <span id="dietadvice_info" class="info text-danger"></span><br />

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="solid-rounded-justified-tab3">
                                                <strong> Please provide the teasting is avilable  <span class="text-danger">*</span></strong> <br> <br>

                                                <div class="form-group">
                                                    <!-- <label class="display-block">Schedule Status</label> -->
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pass" type="radio" name="pass" id="yes" value="need testings">
                                                        <label class="form-check-label" for="product_active">  Need </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pass" type="radio" name="pass" id="no" value="no need testings" checked>
                                                        <label class="form-check-label" for="product_inactive"> Not Need </label>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-12"><strong> Mark the Specic
                                                            Testing Needs <span class="text-danger">*</span> </strong> </label> <br> <br>
                                                    <div class="col-lg-12">
                                                        <div class="checkbox">


                                                            <?php
include ('auth/dbconnection.php');

$stmt = $conn->prepare("SELECT * FROM testings");
// $stmt->bind_param("s", $_GET['pre_id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0)  ;
while($row = $result->fetch_assoc()) {

    // $date=   date('dS F Y', strtotime($row['submit_date']));
    
    ?>
                                                            <label width="40%">
                                                                <input type="checkbox" class="getvalue" name="getvalue"
                                                                    id="getvalue"
                                                                    value="<?php echo  $row['testing_name']; ?>"
                                                                    disabled="disabled">
                                                                <?php echo  $row['testing_name']; ?>
                                                            </label>

                                                            <?php   }?>

                                                            <br>
                                                            <span id="check_yes" class="info text-danger"></span>
                                                            <div class="form-group row">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row"> 
                                                    <label class="col-form-label col-md-12"><strong> Remark <span class="text-danger">*</span>
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="testing_remark"
                                                            name="testing_remark" class="form-control summernote"
                                                            placeholder="Enter your remark here"></textarea>
                                                        <span id="remark_info" class="info text-danger"></span>
                                                    </div>
                                                </div>



                                                <br>

                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Reconsultation Date 
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-6">
                                                        <input type="date" class="form-control" id="reconsult_date">
                                                    </div>
                                                </div>
                                                <br>
                                                <span id="medicine-info" class="info text-danger"></span>
                                                <span id="mediciness" class="info text-danger"></span>
                                                <span id="meds" class="info text-danger"></span>

                                                <span id="test_id_info" class="info text-danger"></span>


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

                </div>
            </div>
        </div>
    </div>
    </div>

    <?php     }

}
else{

}  ?>

  


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

                            <input type="hidden" name="" id="p_ids" value="<?php echo $_GET['p_id'] ?>">


                            <label class="col-form-label col-md-12"><strong> Remark of the patient</strong></label> <br>
                            <br>
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


<!--  prescribe another doctor -->
<div id="patient" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <center> <span class="dash-widget-bg1"><i class="fa fa-user"></i> </span>
                        <h3> Patient Details</h3>
                    </center>
                </div>
                <?php 

$stmt8 = $conn->prepare("SELECT * FROM patients WHERE p_id = ? ");
$stmt8->bind_param("s",$p_id);
$stmt8->execute();
$result8 = $stmt8->get_result();
if($result8->num_rows > 0){
    while($row =mysqli_fetch_array($result8))
    {
    $today = new DateTime();
    $birthdate = new DateTime($row["dob"]);
   $interval = $today->diff($birthdate);
                                    
                                            ?>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                    
                                            
<ul>
                <li>Name : <span><?php echo  $row['prefix'].'  '. $row['p_fname'].' '.$row['p_lname'];   ?></span></li>
          
                <li>Age : <span><?php echo  $interval->format("%Y Year, %M Months, %d Days Old");    ?></span></li>
                <li>Gender : <span><?php echo  $row['p_gender'];   ?></span></li>


                <li>Address : <span><?php if($row['p_address'] != ""){ echo $row['p_address'] ;   }else{ echo 'Address Not Inserted';     }   ?></span></li>

    </ul>
<?php  
            }}

?>

                

                        </div>
                    </div>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <!-- <button type="submit" id="recommend" class="btn btn-primary">Save it</button> -->
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
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 300,
                tabsize: 2
            });

            $('input[type="file"]').imageuploadify();
        });

        // disable date
        $(function () {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('#reconsult_date').attr('min', maxDate);
        });



    </script>




    <script>
        $(document).ready(function () {

            var count = 0;
            $(document).on('click', '#add', function () {
                count++;

                var html = '';
                html += '<tr id="trrows">';

                html += '<td id="medicinename"> <select  name="med_name[]" id="med_name[]" class="form-control med_name" ><option value=""> Select Medicine</option> <?php echo fill_select_box($conn, "0");  ?></select></td>';
                html += '<td id="mor"> <input type="text" name="morning[]" id="morning[]" class="form-control morning" /> </td>';
                html += '<td id="noo"> <input type="text" name="noon[]" id="noon[]" class="form-control noon" /> </td>';
                html += '<td id="nigh"> <input type="text" name="night[]" id="night[]" class="form-control night" /> </td>';
                html += '<td id="period"> <input type="text" name="period[]" id="period[]" class="form-control period" /> </td>';
                html += '<td> <button type="button" name="remove" id="remove" class="btn btn-danger btn-xs remove" >  -  </button> </td>';
                html += '</tr>';

                $('#rows').append(html);

            });

            $(document).on('click', '.remove', function () {
                $(this).closest("#trrows").remove();
            });


            $(document).on('click', 'select.med_name', function () {
      $('select[name*="med_name[]"] option').attr('disabled',false);
      $('select[name*="med_name[]"]').each(function(){
        var $this = $(this);
        $('select[name*="med_name[]"]').not($this).find('option').each(function(){
             if($(this).attr('value') == $this.val())
             $(this).attr('disabled',true);
        });
      });
    });






        });



    </script>

    <script>


        $(function () {
            $("input[name='pass']").click(function () {
                if ($("#yes").is(":checked")) {


                    $(".getvalue").removeAttr("disabled");
                    $(".getvalue").focus();
                } else {

                    $(".getvalue").attr("disabled", "disabled");
                    $('.getvalue').prop('checked', false); 
                }
            });
        });

        $(function () {
            $("input[name='passed']").click(function () {
                if ($("#needs").is(":checked")) {


                    $(".add").removeAttr("disabled");
                    $(".add").focus();
                } else {

                    $(".add").attr("disabled", "disabled");
                }
            });
        });


        $(document).ready(function () {


            $('#specilization').change(function () {

                var doc_spec_id = $(this).val();

                $.ajax({
                    url: "adminquery/fetch_doctor_names.php", // Url to which the request is send
                    method: "POST",             // Type of request to be send, called as method
                    data: { doc_spec_id: doc_spec_id },
                    dataType: "text",

                    success: function (data) {
                        $("#doctor_name").html(data);

                    }

                });


            });

            $(document).on('click', '#submit', function () {


                var hidden = $("#hidden").val();
                var testts = $('#testing_remark').val();

                //  select testings

                var need_test = $(".pass:checked").val();

                if (need_test == 'no need testings') {
                    if (testts == '') {
                        testts = 'No remarks found';
                    } else {
                        testts = $('#testing_remark').val();
                    }
                    // var testings= 'no need testings';
                    var testings = {
                        "testingremark": testts,
                        "testings": 'No need testings'
                    };
                } else {


                    var test = [];
                    $.each($('input[class="getvalue"]:checked'), function () {
                        test.push($(this).val());

                    });

                    var test = test.join(", ");

                    var testings = {
                        "testingremark": $('#testing_remark').val(),
                        "testings": $(".getvalue:checked").map(function () {
                            return $(this).val();
                        }).get()
                    };

                }


                if (hidden == '') {
                    hidden = 'No hidden remarks found';
                } else {
                    hidden = $("#hidden").val();
                }


                var investigations = {
                    "past_history": $('#history').val(),
                    "complaints": $('#complaints').val(),
                    "special_investigations": $('#investigations').val(),
                    //   "decease": $('#decease').val(),
                    "prescription_id": $("#pres").val(),
                    "hidden": hidden
                };



                var getapt = $('#getapt').val();
                var getpid = $('#getpid').val();
                var decease = $('#decease').val();
                var dietadvice = $('#dietadvice').val();
                var reconsult_date = $('#reconsult_date').val();
                var no = $('#no').val();


                var ids = {
                    'getapt': getapt,
                    'getpid': getpid,
                    'decease': decease,
                    'dietadvice': dietadvice,
                    'reconsult_date': reconsult_date,
                    'no': no,

                }

                // select medicine

                var need_medicine = $(".passed:checked").val();

                // if ($("#noneed").is(":checked")) {
                    if (need_medicine == 'no need medicine') {

                    var medical = 'No need Medicines';
                    var modess = { 'medical': medical }

                } else {



                    var modess = $('#rows tr').map(function () {
                        let $tr = $(this);

                        return [{

                            "medname": $(this).find('.med_name').val(),
                            "morning": $(this).find('.morning').val(),
                            "noon": $(this).find('.noon').val(),
                            "night": $(this).find('.night').val(),
                            "period": $(this).find('.period').val(),

                        }]
                        console.log(modess);
                    });

                }

                var ids = JSON.stringify(ids);
                //var medical = JSON.stringify(modess);
                var medical = JSON.stringify($.makeArray(modess));
                var testing_details = JSON.stringify($.makeArray(testings));
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
                                url: "adminquery/prescription.php", // Url to which the request is send
                                method: "POST",             // Type of request to be send, called as method
                                data: {
                                    index1: medical,
                                    index2: ids,
                                    index3: testing_details,
                                    index4: investigations

                                },
                                //dataType:'json',             
                                cache: false,

                                success: function (data) {
                                    if ($.trim(data) === 'Saved') {

                                        swal("Success", "Priscription has been Saved :)", "success");

                                        setTimeout(function () {
                                            //Redirect with JavaScript
                                            window.location.href = 'index.php';
                                        }, 2000);

                                        $('#curpass').val('');
                                        $('#newpass').val('');
                                        $('#conpass').val('');
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
                        $("#meds").html("(Some field are empty. Please fill it !!!!)");

                        $("#complaints").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if (!$("#history").val()) {
                        $("#history-info").html("(History field is required, Please fill it !!!!)");
                        $("#meds").html("(Some field are empty. Please fill it !!!!)");

                        $("#history").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if (!$("#investigations").val()) {
                        $("#investigations-info").html("(Investigations field is required, Please fill it !!!!)");
                        $("#meds").html("(Some field are empty. Please fill it !!!!)");

                        $("#investigations").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if ($("#decease").val() == 'Select') {
                        $("#typeposs").html("(Please select appropriate type)");
                        //    $("#specilization").css('background-color', '#FFFFDF');
                        valid = false;
                    }


                    if (!$("#dietadvice").val()) {
                        $("#dietadvice_info").html("(Dietadvice field is required, Please fill it !!!!)");
                        $("#dietadvice").css('background-color', '#FFFFDF');
                        valid = false;
                    }



                    var testIdList =
                        document.getElementsByClassName('morning')
                    for (let i = 0; i < testIdList.length; i++) {
                        if (!testIdList.item(i).value) {
                            $("#test_id_info").html("(Remove the empty fields in Medicine Table)");
                            $("#morning[]").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    }

                    var testIdLists =
                        document.getElementsByClassName('med_name')
                    for (let i = 0; i < testIdList.length; i++) {
                        if (!testIdLists.item(i).value) {
                            $("#test_id_info").html("(Remove the empty fields in Medicine Table)");
                            $("#med_name[]").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    }

                    var testIdLists =
                        document.getElementsByClassName('noon')
                    for (let i = 0; i < testIdList.length; i++) {
                        if (!testIdLists.item(i).value) {
                            $("#test_id_info").html("(Remove the empty fields in Medicine Table)");
                            $("#noon[]").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    }

                    var testIdLists =
                        document.getElementsByClassName('night')
                    for (let i = 0; i < testIdList.length; i++) {
                        if (!testIdLists.item(i).value) {
                            $("#test_id_info").html("(Remove the empty fields in Medicine Table)");
                            $("#night[]").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    }

                    var testIdLists =
                        document.getElementsByClassName('period')
                    for (let i = 0; i < testIdList.length; i++) {
                        if (!testIdLists.item(i).value) {
                            $("#test_id_info").html("(Remove the empty fields in Medicine Table)");
                            $("#period[]").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                    }

                    if ($("#yes").is(":checked")) {

                        if (!$("#testing_remark").val()) {
                            $("#remark_info").html("(Testing remark field is required, Please fill it !!!!)");
                            // $("#testing_remark").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        var checkboxs = document.getElementsByName("getvalue");
                        var okay = false;
                        for (var i = 0, l = checkboxs.length; i < l; i++) {
                            if (checkboxs[i].checked) {
                                okay = true;
                                break;
                            }
                        }
                        if (okay) {
                        }
                        else {
                            $("#check_yes").html("(Select Testings)");
                            valid = false;
                        }

                    }

                    if ($("#needs").is(":checked")) {

                        if (!$(".morning").val()) {
                            $("#mediciness").html("(Some field are empty in medicine table, Please fill it !!!! or select No need)");
                            $(".morning").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$(".noon").val()) {
                            $("#mediciness").html("(Some field are empty in medicine table, Please fill it !!!! or select No need)");
                            $(".noon").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$(".med_name").val()) {
                            $("#mediciness").html("(Some field are empty in medicine table, Please fill it !!!! or select No need)");
                            $(".med_name").css('background-color', '#FFFFDF');
                            valid = false;
                        }
                        if (!$(".night").val()) {
                            $("#mediciness").html("(Some field are empty in medicine table, Please fill it !!!! or select No need)");
                            $(".night").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                        if (!$(".period").val()) {
                            $("#mediciness").html("(Some field are empty in medicine table, Please fill it !!!! or select No need)");
                            $(".period").css('background-color', '#FFFFDF');
                            valid = false;
                        }

                    }





                    return valid;
                }

            });

        });
    </script>



    <script>

        $(document).ready(function () {

            $(document).on('click', '#recommend', function () {

                var specilization = $('#specilization').val();
                var doctor_name = $('#doctor_name').val();
                var doc_description = $('#doc_description').val();
                var p_id = $('#p_ids').val();

var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "doctorquery/doctor_recommend.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'specilization': specilization,
                            'doctor_name': doctor_name,
                            'p_id': p_id,
                            'doc_description': doc_description,

                        },

                        success: function (response) {
                            $('#warn').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> You have prescribed,<a href="#" class="alert-link"> Dr. ' + response + ' </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                            $('#doc_description').val('');

                            $("#take").modal('hide');



                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error Saved!", "Please try again", "error");
                        }

                    });
                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    if ($("#specilization").val() == 'Select Specilization') {
                        $("#spec").html("(Select Type)");
                        valid = false;
                    }

                    if ($("#doctor_name").val() == 'Select Doctor') {
                        $("#type").html("(Select Doctor Name)");
                        valid = false;
                    }

                    if (!$("#doc_description").val()) {
                        $("#descrip").html("(Required)");
                        $("#doc_description").css('background-color', '#FFFFDF');
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