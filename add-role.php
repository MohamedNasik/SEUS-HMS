<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>
<html>
    
<!-- add-role24:13-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>
    <script type="text/javascript" src="assets/ajax/validate.min.js"></script>

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
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
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
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
											<span class="avatar">L</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.php">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
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
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>You</span>
                    </a>
					<div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<a class="dropdown-item" href="settings.php">Settings</a>
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="settings.php">Settings</a>
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="index-2.php"><i class="fa fa-home back-icon"></i> <span>Back to Home</span></a>
                        </li>
                        <li class="menu-title">Settings</li>
                        <li>
                            <a href="settings.php"><i class="fa fa-building"></i> <span>Company Settings</span></a>
                        </li>
                        <!-- <li>
                            <a href="localization.php"><i class="fa fa-clock-o"></i> <span>Localization</span></a>
                        </li> -->
                        <li>
                            <a href="theme-settings.php"><i class="fa fa-picture-o"></i> <span>Theme Settings</span></a>
                        </li>
                        <li class="active">
                            <a href="roles-permissions.php"><i class="fa fa-key"></i> <span>Roles & Permissions</span></a>
                        </li>
                        <!-- <li>
                            <a href="email-settings.php"><i class="fa fa-envelope-o"></i> <span>Email Settings</span></a>
                        </li>
                        <li>
                            <a href="invoice-settings.php"><i class="fa fa-pencil-square-o"></i> <span>Invoice Settings</span></a>
                        </li>
                        <li>
                            <a href="salary-settings.php"><i class="fa fa-money"></i> <span>Salary Settings</span></a>
                        </li> -->
                        <!-- <li>
                            <a href="notifications-settings.php"><i class="fa fa-globe"></i> <span>Notifications</span></a>
                        </li> -->
                        <li>
                            <a href="change-password.php"><i class="fa fa-lock"></i> <span>Change Password</span></a>
                        </li>
                        <!-- <li>
                            <a href="leave-type.php"><i class="fa fa-cogs"></i> <span>Leave Type</span></a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Role</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form id="role_post" method="post">
                            <div class="form-group">
                                <label>Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="role_name" id="role_name">
                                <span id="roleinfo" class="info text-danger"></span>

                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="role_status" id="role_status" value="active" checked>
									<label class="form-check-label" for="role_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="role_status" id="role_status" value="inactive">
									<label class="form-check-label" for="role_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                            <input type="button" class="btn btn-primary submit-btn" name="role" value="Create Role" id="role">
                            </div>
                        </form>
                        <center>  <div id="successalert" class="text text-success">    </div>  </center> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>


    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>


    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/tagsinput.js"></script>
    <script src="assets/js/app.js"></script>


<script>

//    start query
$(document).ready(function () {

// save comment to database
$(document).on('click', '#role', function () {

 var role_status = $("#role_status:checked").val();
 var role_name = $('#role_name').val();
 
 var valid;
 valid = validateContact();

 if (valid) {

$.ajax({
    url: "adminquery/add_role.php", // Url to which the request is send
    type: "POST",             // Type of request to be send, called as method
    data: {
        'role_name': role_name,
        'role_status': role_status,
    },

    success: function (data) {

        $('#role_name').val('');
        $('#role_status').val('');

        $('#successalert').fadeIn().html(data);

        if(data =="Doctor added succesfully!!"){
$('#successalert').after("<div class='alert alert-success alert-dismissible fade show' role='alert'> <strong>Success!</strong> Your  has been sent successfully.<button type='button' class='close' data-dismiss='alert' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button> </div>");
}
        $("successalert").fadeIn().html(data);

        setTimeout(function () {
            $('#successalert').fadeOut("Slow");
        }, 2000);

    }

});
};

        // check validations
        function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    if (!$("#role_name").val()) {
                        $("#roleinfo").html("(Role Name required)");
                        $("#role_name").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                return valid;
                }
});
});

</script>





</body>


<!-- add-role24:13-->
</html>
