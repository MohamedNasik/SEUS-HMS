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
$query="SELECT * FROM appointment as ap INNER JOIN users as u ON ap.user_id=u.user_id  AND ap.apt_id= '".$_GET['aptid']."' AND u.user_id=  '".$_SESSION['user_id']."'  INNER JOIN check_report as cr ON cr.apt_id=ap.apt_id  AND ap.p_id= '". $_SESSION['p_id'] ."' AND ap.apt_date='".$_GET['apt_date']."' AND ap.admin_status='1'  AND ap.apt_date=cr.check_date ";

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
                                        <h5 class="mb-0"><strong>Dr.</strong> <?php echo $row['fname'] .' '.$row['lname']  ;  ?> </h5>
                                        </li>
                                        <li><span><?php echo $row['specilization'];  ?> </span></li>
                                        <li>Doctor ID: <?php echo $row['user_id'];  ?> </li>
                                        <!-- <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
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
                                                href="#solid-rounded-justified-tab1" data-toggle="tab">Diagnosis</a>
                                        </li>
                                    </ul>

                                    <form method="post" id="prescriptionn" enctype="multipart/form-data">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="solid-rounded-justified-tab1">

                                                <div class="col-lg-12">
                                                    <!-- <div class="card-box"> -->
                                                    <div class="card-block">
                                                        <!-- <h5 class="text-bold card-title">Striped Rows</h5> -->
                                                        <!-- <form method="post" id="prescriptionn" enctype="multipart/form-data">   -->

                                                        <strong> Please provide the medicine is avilable </strong> <br>
                                                        <br>

                                                        <div class="form-group">
                                                            <!-- <label class="display-block">Schedule Status</label> -->
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input passed" type="radio"
                                                                    name="passed" id="needs" value="need medicine">
                                                                <label class="form-check-label" for="product_active">
                                                                    Need
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input passed" type="radio"
                                                                    name="passed" id="noneed" value="no need medicine"
                                                                    checked>
                                                                <label class="form-check-label" for="product_inactive">
                                                                    Not Need
                                                                </label>
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
                                                                <?php
                                   
                                   include ('auth/dbconnection.php');
                                   $query="SELECT * FROM prescription WHERE apt_id= '".$_GET['aptid']."' AND user_id=  '".$_SESSION['user_id']."' AND pres_id='".$_GET['pres_id']."' ";
                                   $results =mysqli_query($conn,$query);
                                   if(mysqli_num_rows($results) > 0){
                                       while($row =mysqli_fetch_array($results))
                                       { 
                                        $remark=$row['remark'];

                                           
                                           ?>

                                                                <input type="hidden"
                                                                    value="<?php echo $row['apt_id'] ?>" id="getapt"
                                                                    name="getapt" class="btn btn-primary">
                                                                <input type="hidden" value="<?php echo $row['p_id'] ?>"
                                                                    id="getpid" name="getpid" class="btn btn-primary">
                                                                <input type="hidden"
                                                                    value="<?php echo $row['pres_id'] ?>" id="pres_id"
                                                                    name="pres_id" class="btn btn-primary">

                                                                <?php
                                          

                                                        $medRecords = json_decode($row['med_records'],true);
                                                        if (is_array($medRecords) || is_object($medRecords)) {
                                                          foreach($medRecords as $key => $object) {
                            
                        
                                                        
                                                        $sql = "SELECT * FROM medicines";
                                                        if($result = mysqli_query($conn, $sql)){
                                                        if(mysqli_num_rows($result) > 0){
                                                        while($row = mysqli_fetch_array($result)){ 
                                                            $medicine_name=$row['medicine_name'];
                                                        }}}




                                                        ?>


                                                                <tbody id="rows">

                                                                    <?php      

if(isset($object['medical'])){

    $medicines=  $object['medical'];

    if( $medicines=='No need Medicines'){
       
    }



                                } else{ ?>


                                                                    <td width="200px" id="medicinename">
                                                                        <select name="med_name[]" id="med_name[]"
                                                                            class="form-control med_name">
                                                                            <option
                                                                                value="<?php echo $object['medname']?>"
                                                                                <?php if( $object['medname']== $medicine_name ) echo 'selected="selected"'; ?>>
                                                                                <?php echo  $object['medname'] ?>
                                                                            </option>
                                                                            <?php echo fill_select_box($conn, "0");  ?>
                                                                        </select></td>
                                                                    <td id="mor"> <input type="text" name="morning[]"
                                                                            id="morning[]" class="form-control morning"
                                                                            value="<?php echo $object['morning'] ?>" />
                                                                    </td>
                                                                    <td id="noo"> <input type="text" name="noon[]"
                                                                            id="noon[]" class="form-control noon"
                                                                            value="<?php echo $object['noon'] ?>" />
                                                                    </td>
                                                                    <td id="nigh"> <input type="text" name="night[]"
                                                                            id="night[]" class="form-control night"
                                                                            value="<?php echo $object['night'] ?>" />
                                                                    </td>
                                                                    <td id="period"> <input type="text" name="period[]"
                                                                            id="period[]" class="form-control period"
                                                                            value="<?php echo $object['period'] ?>" />
                                                                    </td>
                                                                    <td> <button type="button" name="remove" id="remove"
                                                                            class="btn btn-danger btn-xs remove"
                                                                            onClick="re();"> <i class="fa fa-trash"></i>
                                                                        </button> </td>
                                                                    <?php } ?>

                                                                    <script>

                                                                        function re() {

                                                                            $(document).on('click', '.remove', function () {
                                                                                $(this).closest("#rows").remove();
                                                                            });


                                                                        }


                                                                    </script>


                                                                    <?php  }}   ?>


                                                                </tbody>
                                                            </table>
                                                            <br><br>
                                                            <div align="right">
                                                                <button type="button" name="add" id="add"
                                                                    class="btn btn-success btn-xs add"
                                                                    disabled="disabled"> + </button>
                                                            </div>


                                                            <!-- <textarea rows="5" cols="5" id="dietadvice" name="dietadvice" class="form-control" placeholder="Enter your remark here"></textarea> -->


                                                        </div>

                                                        <span id="medicine-info" class="info text-danger"></span>
                                                        <span id="mediciness" class="info text-danger"></span>

                                                        <span id="test_id_info" class="info text-danger"></span>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-md-12"><strong> Remark
                                                                    (Diet Advice) </strong></label> <br> <br>
                                                            <div class="col-md-10">
                                                                <textarea rows="5" cols="5" id="dietadvice"
                                                                    name="dietadvice" class="form-control summernote"
                                                                    placeholder="Enter your remark here"><?php echo  $remark    ?></textarea>
                                                                <span id="dietadvice_info"
                                                                    class="info text-danger"></span>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php     } }

else{

}  ?>

                                                <div class="m-t-20 text-center">
                                                    <input type="button" name="submit" id="submit"
                                                        class="btn btn-primary" value="Enter Prescription">
                                                </div>



                                            </div>






                                            <br>




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

        $(document).ready(function () {

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

// edit prescription
            $(document).on('click', '#submit', function () {

                var getapt = $('#getapt').val();
                var getpid = $('#getpid').val();
                var dietadvice = $('#dietadvice').val();
                var pres_id = $('#pres_id').val();


                var ids = {
                    'getapt': getapt,
                    'getpid': getpid,
                    'dietadvice': dietadvice,
                    'pres_id': pres_id,

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
                var medical = JSON.stringify($.makeArray(modess));



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
                                url: "adminquery/prescription/2/update_medicine.php", // Url to which the request is send
                                method: "POST",             // Type of request to be send, called as method
                                data: {
                                    index1: medical,
                                    index2: ids,

                                },
                                //dataType:'json',             
                                cache: false,

                                success: function (data) {
                                    if ($.trim(data) === 'Saved') {

                                        swal("Success", "Prescription has been changed :)", "success");

                                        // setTimeout(function () {
                                        //     //Redirect with JavaScript
                                        //     window.location.href = 'insert_appointment_id.php';
                                        // }, 2000);

                                        // $('#curpass').val('');
                                        // $('#newpass').val('');
                                        // $('#conpass').val('');
                                    } else {
                                        //our handled error
                                        swal("Sorry", "Failed to change password. Try it by correct password :(", "error");
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


</body>


<!-- salary-view23:28-->

</html>