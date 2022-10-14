<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

   //  redirect to main page according to the user role 

   if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
    header("location: index.php");
    exit;
 }
 
 if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
    header("location: index-lab.php");
    exit;
 }



            include ('auth/dbconnection.php');     
            $query = "SELECT * FROM testings";
            $result = mysqli_query($conn, $query);


        ?>

<!-- add-department24:07-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
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
            }  if( $_SESSION['role_id']=='3'){
                include ('sidebar/laboratorist.php');
            }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Update Testings</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" id="form_testings">


                            <div class="form-group">
                                <select class="select" id="testings" onblur="checktest();" onkeyup="checktest();"
                                    onchange="checktest();">
                                    <option value="Select">Select</option>
                                    <?php 
                            while($row = mysqli_fetch_array($result))
                                {
        
                            echo '<option value="'.$row["test_id"].'">'.$row["testing_name"].'</option>';
                                }
                                            ?>

                                </select>
                                <!-- <span id="testing" class="info text-danger"></span> -->
                                <span id="email_status" name="email_status" class="text text-danger"></span>

                            </div>


                            <div class="form-group">
                                <label>Testing Description</label>
                                <textarea cols="30" rows="4" class="form-control" id="testing_description"  name="testing_description" ></textarea>
                                <span id="desc_info" class="info text-danger"></span>

                            </div>

                            <div class="form-group">
                                <label>Testing Fees</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rs</span>
                                    </div>
                                    <input type="number" class="form-control" id="testing_charge" name="testing_charge">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <span id="charge_info" class="info text-danger"></span>
                            </div>


                            <!-- <div class="form-group">
                                <label class="display-block">Testing Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status"
                                        value="active" checked>
                                    <label class="form-check-label" for="product_active">  Active </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status"
                                        value="inactive">
                                    <label class="form-check-label" for="product_inactive"> Inactive </label>
                                </div>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <input class="btn btn-primary submit-btn" type="button" id="submit"
                                    value="Create Testing">

                            </div>

                        </form>

                    </div>
                    <center>
                        <div id="success_mes" class="text text-success"> </div>
                    </center> <br>

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

    <script src="assets/js/app.js"></script>


    <script>

// get specialization
$('#testings').change(function () {
   
var testings=$(this).val();

$.ajax({
            url: "adminquery/update_testings.php", // Url to which the request is send
            method: "POST",             // Type of request to be send, called as method
            data: {testings:testings  },
           // dataType:"text",

            success: function (data) {
                // $('#1').text(data.testing_description);
                // $('#2').text(data.charge);
                
                document.getElementById('testing_description').value = data.testing_description;
                document.getElementById('testing_charge').value = data.charge;

         }

        });


    });




        function checktest() {
            var testname = document.getElementById("testings").value;

            if (testname) {

                $.ajax({
                    type: 'post',
                    url: "adminquery/add_testings.php", // request file the 'check_email.php'
                    data: {
                        testname: testname,
                    },

                    success: function (response) {
                        $('#email_status').html(response);
                        if (response == "This Test is Already Exist") {
                            $("email_status").fadeIn().html(response);
                            $('input:button').attr('disabled', true);

                            return false;
                        }
                        else {
                            $('input:button').attr('disabled', false);

                            return true;
                        }
                    }
                });
            }
            else {
                $('#email_status').html("Select");
                return false;

            }
        }

    </script>



    <script>

        $(document).ready(function () {

            // save tsets to database
            $(document).on('click', '#submit', function () {

                var test_id = $('#testings').val();
                var testing_description = $('#testing_description').val();
                var testing_charge = $('#testing_charge').val();
                // var test_status = $("#status:checked").val();


                var valid;
                valid = validateContact();

                if (valid) {

                    swal({
                        title: "Are you sure?",
                        text: "You wanna save this Test!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, Save It!",
                        closeOnConfirm: false
                    },
                        function (isConfirm) {
                            if (!isConfirm) return;
                            $.ajax({
                                url: "adminquery/update_testings.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: {
                                    'test_id': test_id,
                                    'testing_description': testing_description,
                                    'testing_charge': testing_charge,
                                    // 'test_status': test_status,
                                },

                                success: function (data) {

                                    swal("Saved!", "The Test has been Updated", "success");

                                    $('#testing_description').val('');
                                    $('#testing_charge').val('');

                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    swal("Error Saved!", "Please try again", "error");
                                }

                            });

                        });


                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    if (!$("#testing_description").val()) {
                        $("#desc_info").html("(Testing description is required)");
                        $("#testing_description").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if ($("#testings").val() == 'Select') {
                        $("#email_status").html("(Select testing)");
                        // $("#selectsss").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#testing_charge").val()) {
                        $("#charge_info").html("(Testing charge is required)");
                        $("#testing_charge").css('background-color', '#FFFFDF');
                        valid = false;
                    }


                    return valid;
                }


            });















        });
    </script>




</body>


<!-- add-department24:07-->

</html>