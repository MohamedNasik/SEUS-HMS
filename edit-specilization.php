<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Specialization</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 offset-lg-2">
                        <?php 
                    
                    $spec_id= $_GET['id']; 
                    include ('auth/dbconnection.php');

                    $stmt = $conn->prepare("SELECT * FROM doctorspecilization WHERE doc_spec_id=?");
                    $stmt->bind_param("s", $spec_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows === 0);
                    while($row = $result->fetch_assoc()) {
                    
                    ?>
                        <form method="post" id="form_specilization" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Specializations Name</label>
                                <input class="form-control" type="text" id="specilization_name"
                                    name="specilization_name" value="<?php echo $row['specilization']  ?>" disabled>
                                    <br><span id="amount" class="text-danger"></span>

                            </div>

                            <input type="hidden" name="dsid" id="dsid" value="<?php echo  $spec_id  ?>">


                            <div class="form-group">
                                <label>Specialization Fees</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rs</span>
                                    </div>
                                    <input type="number" class="form-control" id="specilization_fees"
                                        name="specilization_fees" value="<?php echo $row['fees']  ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <br><span id="amounts" class="text-danger"></span>

                            </div>
                            <?php  } ?>


                            <br>
                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="submit"
                                    value="Save Changes" id="submit"> </div>


                        </form>
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
    <script src="assets/js/app.js"></script>


    <script>


        //    start query
        $(document).ready(function () {

            // edit apecializtion to database
            $(document).on('click', '#submit', function () {

                var id = $('#dsid').val();
                var fees = $('#specilization_fees').val();


                var valid;
                valid = validateContact();

                if (valid) {

                    swal({
                        title: "Are you sure?",
                        text: "You wanna update this details!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Yes, Update It!",
                        closeOnConfirm: false
                    },

                        function (isConfirm) {
                            if (!isConfirm) return;
                            $.ajax({
                                url: "adminquery/edit_specilization.php", // Url to which the request is send
                                type: "POST",             // Type of request to be send, called as method
                                data: {
                                    'id': id,
                                    'fees': fees,

                                },

                                success: function (response) {

                                    if (response == "Specilization Updated Successfully") { // if the response is 1

                                        swal("Saved!", "Changes has updated", "success");

                                    } else {

                                        swal("Error!", "Changes has not updated", "danger");

                                    }

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

                    if (!$("#specilization_name").val()) {
                        $("#amount").html("(Required)");
                        //  $("#username").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#specilization_fees").val()) {
                        $("#amounts").html("(Required)");
                        //   $("#email").css('background-color', '#FFFFDF');
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