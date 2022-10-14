<!DOCTYPE html>
<html lang="en">
<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }

?>

<!-- salary-view23:28-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">


    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Data table css -->
    <link href="assets/new datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />


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
                        <a class="dropdown-item" href="profile.html">My Profile</a>
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
                    <a class="dropdown-item" href="profile.html">My Profile</a>
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
                        <h4 class="page-title">Doctor Recommendations</h4>
                    </div>
                    <div class="col-sm-12 col-12 text-right m-b-30">
            

            <a href="doctor_recommend.php?pname=<?php echo $_GET['pname']?>&p_id=<?php echo $_GET['p_id']?> "
                class="btn btn-warning"><i class="fa fa-user-md"> </i> Edit My Recomedations </a>
                </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <span>
                                <h4 class="payslip-title">Doctor Recommendations of <?php echo $_GET['pname']; ?></h4>
                            </span>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">

                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text"> Dr. <?php echo $_SESSION['usernames'];  ?></h3>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped custom-table datatable mb-0"
                                            id="myt">
                                            <thead>
                                                <tr>
                                                    <th>Doctor Name</th>
                                                    <th>Specilization</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

<?php

require_once 'auth/dbconnection.php';
$sql = "SELECT * FROM doctor_recommend where user_id= '".$_SESSION['user_id']."' AND p_id='".$_GET['p_id']."'  ORDER BY doctor_recommend_id DESC ";

//$sql = "SELECT * FROM patients ";
    if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){

?>
                                                <tr>
                                                    <td><img width="28" height="28" src="assets/img/user.jpg"
                                                            class="rounded-circle m-r-5" alt="">
                                                        <?php echo $row['recommended_by'];?></td>

                                                    <td><?php echo $row['specilization'];?></td>

                                                    <td>
                                                        <button id="check<?php echo $row["doctor_recommend_id"]?> "
                                                            class="btn btn-success custom-badge status-blue check"
                                                            value="Submit"
                                                            data-id=<?php echo $row['doctor_recommend_id']?>
                                                            onclick="(this.id)"> Submit </button>
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
                            </div> <br><br>

                            <div id=results>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-overlay" data-reff=""></div>
            <script src="assets/ajax/jquery.min.js"></script>
            <script src="assets/ajax/jquery-3.4.1.min.js"></script>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/select2.min.js"></script>
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/app.js"></script>
            <script src="assets/datatables/js/datatables.min.js"></script>

            <!-- Data tables -->
            <script src="assets/new datatable/jquery.dataTables.min.js"></script>
            <script src="assets/new datatable/dataTables.bootstrap4.min.js"></script>

</body>

<script>


    $(document).ready(function () {
        $('#myt').DataTable();
    });


</script>


<script>

    $(document).on("click", ".check", function () {

        var id = $(this).attr("data-id");
        $('#results').html('');

        $('#presid').html(id);


        $.ajax({
            url: "doctorquery/fetch_doc_recomed.php", // Url to which the request is send
            method: "POST",             // Type of request to be send, called as method
            data: {
                id: id

            },
            dataType: 'text',

            success: function (data) {

                $('#results').html(data);

            },
            error: function (e) {
                console.log(e);
            }

        });

    });





</script>






<!-- salary-view23:28-->

</html>