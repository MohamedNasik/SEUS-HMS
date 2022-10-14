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
$query="SELECT * FROM appointment WHERE apt_id= '".$_GET['aptid']."' AND user_id=  '".$_SESSION['user_id']."' AND p_id= '". $_SESSION['p_id'] ."' AND apt_date='".$_GET['apt_date']."' AND admin_status='1' ";
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
                            <?php }} ?>


                            <!-- TAB START -->

                            <div class="col-md-12">
                                <div id="warn"> </div>
                                <div class="card-box">
                                    <!-- <h4 class="card-title">Rounded justified</h4> -->
                                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                        <li class="nav-item"><a class="nav-link active"
                                                href="#solid-rounded-justified-tab1" data-toggle="tab">Testing
                                                Details</a></li>


                                    </ul>


                                    <?php
                                   
                                   include ('auth/dbconnection.php');
                                   $query="SELECT * FROM prescription WHERE apt_id= '".$_GET['aptid']."' AND user_id=  '".$_SESSION['user_id']."' AND pres_id='".$_GET['pres_id']."' ";
                                   $results =mysqli_query($conn,$query);
                                   if(mysqli_num_rows($results) > 0){
                                       while($row =mysqli_fetch_array($results))
                                       {      
                                        $medRecords = json_decode($row['testing_details'],true);

                                        $date = (new DateTime($row['reconsult_date']))->format('Y-m-d');


                                        if (is_array($medRecords) || is_object($medRecords)) {
                                            foreach($medRecords as $key => $object) {
            
                                           
                                           ?>


                                    <form method="post" id="prescriptionn" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="solid-rounded-justified-tab1">

                                                <strong> Please provide the teasting is avilable </strong> <br> <br>

                                                <div class="form-group">
                                                    <!-- <label class="display-block">Schedule Status</label> -->
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pass" type="radio" name="pass"
                                                            id="yes" value="need testings">
                                                        <label class="form-check-label" for="product_active">
                                                            Need
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input pass" type="radio" name="pass"
                                                            id="no" value="no need testings">
                                                        <label class="form-check-label" for="product_inactive">
                                                            Not Need
                                                        </label>
                                                    </div>
                                                </div>
                                                <br>

                                                <input type="hidden" value="<?php echo $row['apt_id'] ?>" id="getapt"
                                                    name="getapt" class="btn btn-primary">
                                                <input type="hidden" value="<?php echo $row['p_id'] ?>" id="getpid"
                                                    name="getpid" class="btn btn-primary">

                                                <input type="hidden" value="<?php echo $row['pres_id'] ?>" id="pres_id"
                                                    name="pres_id" class="btn btn-primary">


                                                <div class="form-group row">
                                                    <label class="col-form-label col-lg-12"><strong> Mark the Specic
                                                            Testing Needs </strong> </label> <br> <br>
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

?>



                                                            <label width="40%">
<?php

$tests=  $object['testings'];
if( $tests=='No need testings'){
 ?>

                                                                <label width="40%">
                                                                    <input type="checkbox" class="getvalue"
                                                                        name="getvalue" id="getvalue"
                                                                        value="<?php echo  $row['testing_name']; ?>">
                                                                    <?php echo  $row['testing_name']; ?>
                                                                </label>

                                                                <?php  

}else{ 


?>

                                                                <input type="checkbox" class="getvalue" name="getvalue"
                                                                    id="getvalue"
                                                                    value="<?php echo  $row['testing_name'] ?>"
                                                                    <?php 
               
                                                                    if (in_array($row['testing_name'], $object['testings'])){  echo "checked";}  ?>>


                                                                <?php echo  $row['testing_name'] ?>
                                                            </label>

                                                            <?php }  }?>
                                                            <span id="check_yes" class="info text-danger"></span>

                                                            <!-- <br><br> -->
                                                            <div class="form-group row">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Remark
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" cols="5" id="testing_remark"
                                                            name="testing_remark" class="form-control summernote"
                                                            placeholder="Enter your remark here"><?php echo $object['testingremark'] ?></textarea>
                                                        <span id="remark_info" class="info text-danger"></span>

                                                    </div>
                                                </div>



                                                <br>
                                                <div class="form-group row">
                                                    <label class="col-form-label col-md-12"><strong> Reconsultation Date
                                                        </strong></label> <br> <br>
                                                    <div class="col-md-6">

                                                        <input type="date" class="form-control" id="reconsult_date"
                                                            value="<?php echo $date ?>" name="date" />


                                                    </div>
                                                </div>
                                                <br>
                                                <span id="medicine-info" class="info text-danger"></span>
                                                <span id="mediciness" class="info text-danger"></span>

                                                <span id="test_id_info" class="info text-danger"></span>



  <?php
     } }} } 
?>


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



    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

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
        $(function () {
            $("input[name='pass']").click(function () {
                if ($("#yes").is(":checked")) {


                    $(".getvalue").removeAttr("disabled");
                    $(".getvalue").focus();
                } else {

                    $(".getvalue").attr("disabled", "disabled");
                }
            });
        });

        $(document).ready(function () {

            $(document).on('click', '#submit', function () {

                var testts = $('#testing_remark').val();

                var need_test = $(".pass:checked").val();

                if (need_test == 'no need testings') {
                    if (testts == '') {
                        testts = 'No remarks found';
                    } else {
                        testts = $('#testing_remark').val();
                    }
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




                var getapt = $('#getapt').val();
                var getpid = $('#getpid').val();
                var pres_id = $('#pres_id').val();
                var reconsult_date = $('#reconsult_date').val();


                var ids = {
                    'getapt': getapt,
                    'getpid': getpid,
                    'reconsult_date': reconsult_date,
                    'pres_id': pres_id,

                }


                var ids = JSON.stringify(ids);
                var testing_details = JSON.stringify($.makeArray(testings));


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
                                url: "adminquery/prescription/1/update_test_prescription.php", // Url to which the request is send
                                method: "POST",             // Type of request to be send, called as method
                                data: {
                                    index2: ids,
                                    index3: testing_details,

                                },
                                //dataType:'json',             
                                cache: false,



                                success: function (data) {
                                    if ($.trim(data) === 'Saved') {

                                        swal("Success", "Prescription has been saved :)", "success");

                                        // setTimeout(function () {
                                        //     //Redirect with JavaScript
                                        //     window.location.href = 'insert_appointment_id.php';
                                        // }, 2000);

                                        // $('#curpass').val('');
                                        // $('#newpass').val('');
                                        // $('#conpass').val('');
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

                    if ($("#yes").is(":checked")) {

                     

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
                    if (!$("#testing_remark").val()) {
                            $("#remark_info").html("(Testing remark field is required, Please fill it !!!!)");
                            // $("#testing_remark").css('background-color', '#FFFFDF');
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