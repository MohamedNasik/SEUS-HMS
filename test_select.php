<!DOCTYPE html>
<html lang="en">
           
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/datatable/dataTables.bootstrap.min.css">

    <script src="assets/datatable/dataTables.bootstrap.min.js"></script>
    <script src="assets/datatable/jquery.dataTables.min.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>


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
                    </span>
      
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
            
            <!-- Notification start -->
         <?php include ('notification/doctor_notification.php');   ?>
            <!--Notification end -->

                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        
<?php
include ('sidebar/doctorsidebar.php');
?>



        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                <div class="col-sm-12 col-12">
                        <h4 class="page-title">Select Testings Item</h4>
                        <h5 ><code> Select Icon to view results </code> </h5>

                    </div>
             <br><br> <br><br>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                        <a href="tests/edit_blood_count.php?presid=<?php echo $_GET['presid'] ?>&username=<?php echo $_GET['name'] ?>&pid=<?php echo $_GET['pid']  ?>">	<span class="dash-widget-bg2"><i class="fa fa-flask" aria-hidden="true"></i></span>     </a>
							<div class="dash-widget-info text-right">
								<h3></h3>
								<span class="widget-title2"> Blood Count Report<i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                      
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                        <a href="tests/edit_urine.php?presid=<?php echo $_GET['presid'] ?>&username=<?php echo $_GET['name'] ?>&pid=<?php echo $_GET['pid']  ?>">	<span class="dash-widget-bg1"><i class="fa fa-flask" aria-hidden="true"></i></span>     </a>
                            <div class="dash-widget-info text-right">
                                <h3></h3>
                                <span class="widget-title1">Urine Report<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
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
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>


<script>

$(document).ready(function () {
    
    unseen_notification();

    function unseen_notification(view=''){

$.ajax({
          url: "adminquery/load_not.php", // Url to which the request is send
          method: "POST",             // Type of request to be send, called as method
          data:{ view: view },
          dataType: "json",
          success: function (data) {

        $('.notification-list').html(data.notification);
    if(data.unseen_notification > 0){
$('.count').html(data.unseen_notification);

    }
          }

      });

}

unseen_notification();



load_data();
function load_data(){
    $.ajax({
              url: "table/doctable.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
            
              success: function (data) {

                  $('#user_data').html(data);
        
              }

          });

}



});


</script>








</body>



</html>