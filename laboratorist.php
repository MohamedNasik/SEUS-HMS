<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }
            
         require_once 'auth/dbconnection.php';

        ?>

<!-- doctors23:12-->

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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Lab Assistants</h4>
                    </div>

                    <?php

if( $_SESSION['role_id']=='1'){
  

     ?>


                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-laboratorist.php" class="btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Add Assistants</a>
                    </div>


                    <?php               } 
?>
                </div>


                <div class="row doctor-grid" id="ids">


                    <?php

        $sql='SELECT u.user_id,u.prefix,u.fname,u.lname,u.address,u.image,u.email FROM users as u  WHERE u.role_id= 3 ';
        $stmt=$conn->prepare( $sql );
        //$stmt->bind_param( 's','2' );


        $res=$stmt->execute();
        if( $res ){
            $stmt->store_result();
            $stmt->bind_result($user_id,$prefix,$fname,$lname,$address,$image,$email);

            while( $stmt->fetch() ){
                /* 
                    You store the filename ( possibly path too ) 
                    so you need to read the file to find it's
                    raw data which you will use a simage source
                */
                $filepath="profile/blog/";
               
               

                ?>

                    <div class="col-md-4 col-sm-4 col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="profile.php?userid=<?php echo $user_id  ?>"><?php
                                
                                printf(
                                    '<img class="inline-block" src="data:image/png;base64, %s" alt="user" />',
                                         base64_encode(file_get_contents($filepath.$image ) )
                                );

                                ?></a>
                            </div>

                            <?php

if( $_SESSION['role_id']=='1'){   ?>



                            <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- <a class="dropdown-item" href="edit-doctor.php"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                    <a class="dropdown-item" href="#" data-toggle="modal" id="rep2"
                                        data_id=<?php echo $user_id  ?> data-target="#delete_doctor"><i
                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>

                            <?php               } 
?>

                            <h4 class="doctor-name text-ellipsis"><a href="#"> <?php  echo $prefix?> <?php     echo  $fname .' '. $lname   ?></a></h4>
                            <div class="doc-prof"> <i class="fa fa-user"> </i> <?php    echo  "Lab Assistant"  ?></div>

                            <div class="user-country">
                                <i class="fa fa-envelope"></i> <?php    echo  $email  ?>
                            </div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> <?php echo  $address  ?>
                            </div>
                        </div>
                    </div>

                    <?php               }
            $stmt->free_result();
            $stmt->close();
            $conn->close();
        }
 
?>


                </div>

            </div>


            <div id="delete_doctor" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                            <h3>Are you sure want to delete this Lab Assistant?</h3>
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <button type="submit" id="cancelid" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/ajax/jquery.min.js"></script>
        <script src="assets/ajax/jquery-3.4.1.min.js"></script>
        <!-- <script src="assets/js/jquery-3.2.1.min.js"></script> -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>


        <script>





            /**---------EDIT A ROW ----------------*/
            $(document).on('click', '#rep2', function () {

                $("#cancelid").attr('user_id', $(this).attr('data_id'));

                $("#delete_doctor").modal({ show: 'true' });

            });


// delete lab
            $("#cancelid").click(function () {

                var data_id = $("#cancelid").attr('user_id');
                console.log(data_id);
                $.ajax({
                    data: { 'data_id': data_id, },
                    type: "POST",
                    url: "adminquery/delete_doctor.php",
                    success: function (data) {
                        //   console.log(data);
                        $('#success_mes').html(data);

                        $("#delete_doctor").modal('hide');



                    }
                });

                setInterval(function () {
                    $('#ids').load("adminquery/fetch/fetch_lab.php").fadeIn("slow");
                }, 1000);



                setInterval(function () {
                    $('#users').load("adminquery/fetch/fetch_lab.php").fadeIn("slow");
                }, 1000);




            });



        </script>








</body>


<!-- doctors23:17-->

</html>