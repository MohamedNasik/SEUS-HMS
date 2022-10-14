<!DOCTYPE html>
<html lang="en">

<?php

session_start();
include ('auth/dbconnection.php');
if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }
?>
<!-- edit-patient24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                        <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
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
            } 
          if( $_SESSION['role_id']=='4'){
            include ('sidebar/receptionist.php');
        }
?>

        <div id="pass_user" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to Update password?</h3>

                        <div class="modal-body">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" value="" id="pass1" onkeyup='check();'>
                                    <span id="pass1_info" class="info text-danger"></span> </div>

                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password" value="" id="pass2" onkeyup='check();'>
                                    <span id='message'></span>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" id="change" class="btn btn-success">Change</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Edit User</h4>
                    </div>

                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="#" class="btn btn btn-primary btn-rounded float-right" data-toggle="modal"
                            id=<?php echo $_GET['pid']?> data-target="#pass_user"><i class="fa fa-check"> </i> Change
                            Password</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

                        <?php   

$stmt = $conn->prepare("SELECT * FROM patients WHERE p_id=? ");
$stmt->bind_param("s",$_GET['pid']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {



?>

                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" value="<?php echo $row['p_fname']    ?>"
                                            id="fname">
                                        <span id="fname_info" class="info text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" value="<?php echo $row['p_lname']    ?>"
                                            id="lname">
                                        <span id="lname_info" class="info text-danger"></span>
                                    </div>
                                </div>
                           
                                <!-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" value="<?php echo $row['email']  ?>"
                                            id="email" disabled>
                                        <span id="email_status" name="email_status"></span>
                                    </div>
                                </div> -->

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <!-- <div class="cal-icon"> -->
                                        <input type="date" class="form-control" value="<?php echo $row['dob']    ?>"
                                            id="dob">
                                        <span id="dob_info" class="info text-danger"></span>
                                        <!-- </div> -->
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 ">
                                            <div class="form-group">
                                                <label>NIC</label>
                                                <input type="text" class="form-control" maxlength="10"
                                                    value="<?php echo $row['p_state']    ?>" id="nic">
                                                <span id="nic_info" class="info text-danger"></span>
                                            </div>
                                        </div>

                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input gender" id="gender"
                                                <?php if($row['p_gender'] == "Male") { echo "checked"; }?> value="Male">Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input gender" id="gender"
                                                <?php if($row['p_gender'] == "Female") { echo "checked"; }?> value="Female">Female
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $row['p_address']    ?>" id="address">
                                                <span id="address_info" class="info text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 ">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input type="text" class="form-control"
                                                    value="<?php echo $row['p_state']    ?>" id="state">
                                                <span id="state_info" class="info text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">


                                            <div class="form-group">
                                            <label class="focus-label" for="contact">Contact Number</label>
                                                <input class="form-control" type="text"
                                                    value="<?php echo $row['p_contact']    ?>" id="contact" maxlength="10" placeholder="tel: input ten numbers">
                                                <span id="contact_info" class="info text-danger"></span>
                                                <div id="error" class="info text-danger"> </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="m-t-20 text-center">

                                <button class="btn btn-primary submit-btn" type="button" id="submit"> Save Changes</button>
                            </div>
                        </form>

                        <?php  }   }?>
                    </div>
                </div>
            </div>
    <div class="sidebar-overlay" data-reff=""></div>


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>



    <script>

$(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#dob').attr('max', maxDate);
});

// nic
$("#nic").on("keyup", function (a) {
            let inputElement = document.getElementById("nic");
  let divElement = document.getElementById("nic_info");
  var message = "";

  let inputValue = inputElement.value.trim();
  
  let pattern = new RegExp(/^\d{9}[a-zøæ]{1}/, "i");

  if (isValid(inputValue, pattern)) {
    message = "Correct NIC Number" 
    $('button[id=submit]').prop('disabled', false);

  }else if(a.target.value.length === 0){
    var message = "";
    $('button[id=submit]').prop('disabled', false);
  }
  else{
    $('button[id=submit]').prop('disabled', true);
    message = "Wrong NIC Number"  

  }
  
  divElement.innerHTML = message;

  function isValid(str, pattern) {
  return str.match(pattern);
}



        });






$("#contact").on("keyup", function (e) {
            e.target.value = e.target.value.replace(/[^\d]/, "");
            if (e.target.value.length === 10) {
                // do stuff
                var ph = e.target.value.split("");
                ph.splice(3, 0, "-"); ph.splice(7, 0, "-");

                // $("label").html(ph.join(""))
                $('button[id=submit]').prop('disabled', false);
                $('#error').html('');

            } else {

                $('button[id=submit]').prop('disabled', true);
                $('#error').html('Contact Number should be 10 digits');

            }


        });



        var check = function () {

            var pass1 = document.getElementById("pass1").value;
            var pass2 = document.getElementById("pass2").value;

            if (pass1 || pass2) {
                var minLength = 8;
                if (pass2.length >= minLength) {

                    if (document.getElementById('pass1').value == document.getElementById('pass2').value) {
                        document.getElementById('message').style.color = 'green';
                        document.getElementById('message').innerHTML = 'Password is matching';
                        $("#change").attr("disabled", false);

                    }
                    else {
                        document.getElementById('message').style.color = 'red';
                        document.getElementById('message').innerHTML = 'Password is not matching';
                        $("#change").attr("disabled", true);
                    }

                } else {
                    document.getElementById('message').style.color = 'red';
                    $("#message").html("(Password contains Minimum 8 Characters)");
                    $("#change").attr("disabled", true);
                }
            } else {

                $('#message').html("");
                $("#change").attr("disabled", false);
            }
        }


        //    start query
        $(document).ready(function () {


            // update patient to database
            $(document).on('click', '#submit', function () {

                var fname = $('#fname').val();
                var lname = $('#lname').val();
                var gender = $("#gender:checked").val();
                var address = $('#address').val();
                var state = $('#state').val();
                var contact = $('#contact').val();
                var dob = $('#dob').val();
                var nic = $('#nic').val();

                var p_id = <?php  echo  $_GET['pid']  ?>

                var valid;
                valid = validateContact();

                if (valid) {


                    swal({
                        title: "Are you sure?",
                        text: "You wanna update this patient?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, Change It!",
                        closeOnConfirm: false
                    },
                        function (isConfirm) {
                            if (!isConfirm) return;
                            $.ajax({
                                url: "adminquery/fetch/patient/update.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: {
                                    'address': address,
                                    'gender': gender,
                                    'contact': contact,
                                    'dob': dob,
                                    'state': state,
                                    'fname': fname,
                                    'lname': lname,
                                    'p_id': p_id,
                                    'nic': nic,

                                },
                                success: function (data) {
                                    $('#success_mes').html(data);

                                    if ($.trim(data) === 'Success') {
                                        swal("Success", "Successfully Updated:)", "success");
                                        $('input[id=submit]').prop('disabled', true);


                                    } else {
                                        //our handled error
                                        swal("Sorry", "All the field should be updated. Try it later :(", "error");
                                    }
                                },

                                error: function (data) {
                                    //other errors that we didn't handle
                                    swal("Sorry", "Failed to send order. Please try later :(", "error");
                                }


                            });

                        });

                    };

  // check validations
  function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    if (!$("#lname").val()) {
                        $("#lname_info").html("(Last name is required)");
                        $("#lname").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#fname").val()) {
                        $("#fname_info").html("(First name is required)");
                        $("#fname").css('background-color', '#FFFFDF');
                        valid = false;
                    }

        
                    return valid;
                }


            });


            // update password to database
            $(document).on('click', '#change', function () {
                var pass = $('#pass1').val();
                var p_id = <?php  echo  $_GET['pid']  ?>


                    $.ajax({
                        url: "adminquery/fetch/patient/update.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'pass': pass,
                            'p_id': p_id,

                        },
                        success: function (data) {
                            $('#success_mes').html(data);

                            if ($.trim(data) === 'Success') {
                              $("#pass1").val('');
                              $('#pass2').val('');

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Password Updated'
                                })

                                $("#pass_user").modal('hide');

                            } else if ($.trim(data) === 'Empty') {
                                swal("Sorry", "Password is empty :(", "error");

                            } else {
                                //our handled error
                                swal("Sorry", "All the fields should be updated. Try it later :(", "error");
                            }
                        },

                        error: function (data) {
                            //other errors that we didn't handle
                            swal("Sorry", "Failed to send order. Please try later :(", "error");
                        }


                    });

             

   

            });

        });


    </script>






</body>


<!-- edit-patient24:07-->

</html>