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


require_once ('auth/dbconnection.php');
        ?>

<!-- departments23:21-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Data table css -->
    <link href="assets/new datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

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
  
  } 

?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary">
            Launch demo modal
        </button>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                <div class="col-sm-5 col-4">
                        <h4 class="page-title">Recommended Doctors </h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">                        
                            <!-- <button class="btn btn-white" onclick="location.href='auth/logout_patient.php';"><i class="fa fa-edit fa-lg"></i> Logout</button> -->
                        
                        
                        </div>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!-- <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a> -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Doctor Name</th>
                                        <th>Specilization</th>
                                        <th>Submitted Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
require_once 'auth/dbconnection.php';
$sql = "SELECT * FROM doctor_recommend AS dr INNER JOIN users AS u ON  dr.user_id = u.user_id AND dr.recommended_by= '".$_SESSION['usernames']."' AND dr.p_id='".$_GET['p_id']."' ORDER BY dr.doctor_recommend_id DESC ";

//$sql = "SELECT * FROM patients ";
    if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
  $des=$row['description'];
  $username=$row['fname'].' '.$row['lname']

?>
                                    <tr>
                                        <td><img width="28" height="28" src="assets/img/user.jpg"
                                                class="rounded-circle m-r-5" alt=""> <?php echo $username ?></td>

                                        <td><?php echo $row['specilization'];?></td>
                                        <td><?php echo $row['submit_date'];?></td>
                                        <td>
                                            <!-- <a href="#"><button id="check" class="btn btn-success custom-badge status-green check" value="Show"  data-id= <?php echo $row['doctor_recommend_id'] ?> onclick="(this.id)" data-toggle="modal" data-target="#centralModalSm<?php echo $des?> ">   Show  </button> </a>   -->
                                            <button type="button"
                                                class="btn btn-success custom-badge status-green message"
                                                onclick="(this.id)" data-id="<?php echo $row['doctor_recommend_id'];?>"
                                                id="check<?php echo $row["doctor_recommend_id"]?>">Message</button>

                                        </td>

                                        <td>
                                            <a
                                                href="change_recommed.php?recom_id=<?php echo $row['doctor_recommend_id'] ?>&p_id=<?php echo $row['p_id'] ?>   "><button
                                                    id="check" class="btn btn-primary custom-badge status-blue check"
                                                    value="Submit" data-id=<?php echo $row['doctor_recommend_id'] ?>
                                                    onclick="(this.id)"> Edit </button> </a>
                                        </td>
                                    </tr>

                                    <?php  
}
mysqli_free_result($result);
} 
}
?>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <span> <i class="fa fa-user-md fa-4x text-primary"></i></span>
                            <h4>Doctor Recommendation  Message </h4>

                            <div class="modal-body">
                            <code>     <div id="tests"> </div>   </code>
                            </div>
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        <div id="delete_department" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Department?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <!-- Data tables -->
    <script src="assets/datatables/js/datatables.min.js"></script>
    <script src="assets/new datatable/jquery.dataTables.min.js"></script>
    <script src="assets/new datatable/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>







    <script>

        $(document).ready(function () {
            $('#myTable').DataTable();


            $(document).on("click", ".message", function () {

                var id = $(this).attr("data-id");
                var btnAttrId = $(this).attr('id');
                var btnDataId = $(this).data('id');

                $.ajax({
                    url: "doctorquery/fetch_message.php", // Url to which the request is send
                    method: "POST",             // Type of request to be send, called as method
                    data: {
                        id: id
                    },

                    dataType: 'text',

                    beforeSend: function () {
                        $('#check' + btnDataId).text("Checking......");

                    },

                    success: function (data) {

                        $("#description").modal('show');
                        $('#tests').html(data);

                    },

                    complete: function () {
                        $('#check' + btnDataId).text("Opened");
                    },
                    error: function (e) {
                        console.log(e);
                    }

                });

            });


        });


    </script>

</body>


<!-- departments23:21-->

</html>