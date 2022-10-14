<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
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
<!-- add-doctor24:06-->

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>



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
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
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
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Change Doctor Recommended</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">

<!-- fORM STARTS -->
<?php  
require_once "auth/dbconnection.php";

    $stmt = $conn->prepare("SELECT * FROM doctor_recommend WHERE doctor_recommend_id = ? ");
    $stmt->bind_param("s",$_GET['recom_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()) {
 
       $description = $row['description'];

      }}
?>
                        <form method="POST" id="doctor_form">
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
                                <strong>  <label>Doctor Name</label></strong>
                                    <select class="select" id="doctor_name" name="doctor_name">
                                        <option value="Select Doctor">Select Doctor</option>
                                    </select>
                                    <span id="type" class="info text-danger"></span><br />
                                </div>
                            </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <strong>     <label>Description <span class="text-danger">*</span></label>  </strong> 
                                        <textarea rows="5" cols="5" id="doc_description"name="doc_description" class="form-control"
                                  placeholder="Enter your remark here"> <?php echo  $description  ?></textarea>   
                                   <span id="descrip" class="info text-danger"></span>
                                    </div>
                                </div>
    
                            </div>

                            <div class="m-t-20 text-center">
                                <input type="button" class="btn btn-primary submit-btn" name="Register"
                                    value="Change Recommandation" id="Register">
                            </div>
                            <center>  <div id="success_mes" class="text text-success">    </div>  </center> <br>

                        </form>
<!-- FORM ENDS -->

                    </div>
                </div>
            </div>
            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.php">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                                adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.php">See all messages</a>
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
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
  
    <script src="assets/js/app.js"></script>

    <script>

        //    start query
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



            // save DOCTOR to database
            $(document).on('click', '#Register', function () {

                var specilization = $('#specilization').val();
                var doctor_name = $('#doctor_name').val();
                var doc_description = $('#doc_description').val();
                var recommed_id = <?php echo $_GET['recom_id'];   ?>;
                var p_id = '<?php echo $_GET['p_id'];   ?>';


                var valid;
                valid = validateContact();

                if (valid) {

                    swal({
                    title: "Are you sure?",
                    text: "You wanna update this !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes, Update It!",
                    closeOnConfirm: false
            },

        function(isConfirm){
              if (!isConfirm) return;
                        $.ajax({
                        url: "doctorquery/doctor_recommend_update.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'specilization': specilization,
                            'doctor_name': doctor_name,
                            'doc_description': doc_description,
                            'p_id':p_id,
                            'recommed_id':recommed_id,


                        },

                        success: function (response) {

                            swal("Saved!", 'The Doctor has been Prescribed', "success");

                            $('#username').val('');
                            $('#email').val('');
                  
                    
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




<!-- add-doctor24:06-->

</html>