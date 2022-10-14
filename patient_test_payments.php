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
     
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
        header("location: index-lab.php");
        exit;
     }



?>

<!-- schedule23:20-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/datatable/bs4/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/others/buttons.dataTables.min.css">

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
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
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
                        <h4 class="page-title">Patient Test Status</h4>
                    </div>
    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                         <table id="table" class="table table-border table-hover custom-table mb-0">
                         <thead>
 
                                     <tr>
                                     <th align="center">Pres.ID</th>
                                     <th align="center">Patient ID</th>
                                     <th align="center">Patient Name</th>
                                     <th align="center">Submitted Date</th>                              
                                   
                                   <?php  if( $_SESSION['role_id']=='1' ||  $_SESSION['role_id']=='4'  ){   ?>

                                        <th align="center">Action</th>
                                        <?php   } ?>



                                        
                                    </tr>
                         </thead>
                         <tbody>

<?php
include 'auth/dbconnection.php';


$stmt = $conn->prepare("SELECT * from testing_schedule Inner JOIN patients ON 
patients.p_id= testing_schedule.p_id  
GROUP BY testing_schedule.pres_id");




$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {

 $submit_date=   date('dS F Y', strtotime($row['submit_date']));


echo '
<tr>
<td> '.$row["pres_id"].'</td>
<td> '.$row["p_id"].'</td>
<td> '.$row["p_fname"].' '.$row["p_lname"].'</td>
<td> '.$row["submit_date"].'</td>';




   

echo '<td align="cente"> 

<div class="dropdown dropdown-action">
<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right">';


    echo '
    <a class="dropdown-item" href="patient_view_tests.php?presid='.$row['pres_id'].'&names='.$row['p_fname'].' '.$row['p_lname'].' &pid='.$row['p_id'].' " ><i
            class="fa fa-edit  m-r-5"></i> Go</a>';
      

        
 echo '  
</div>

</div>


</td>';
 

'</tr>';

}

}else{

echo ' <tr>  <td colspan="5"> <center> No records found  </center> </td>  </tr> ';
}

$stmt->close();

?>
                         </tbody>

                                 </table>
                        </div>
                    </div>
                </div>
            </div>

        <div id="delete_schedule" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Schedule?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="assets/css/others/buttons.print.min.js"></script>
    <script type="text/javascript" src="assets/css/others/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/css/others/buttons.flash.min.js"></script>
    <script type="text/javascript" src="assets/css/others/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="assets/css/others/buttons.html5.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>

<script>

$(document).ready( function () {
    $('#table').DataTable({
        dom: 'lBfrtip',
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]

            });
    
} );


/**---------EDIT A ROW ----------------*/
$(document).on('click', '#rep2', function () {

$("#cancelid").attr('apt_id', $(this).attr('data_id'));

$("#delete_appointment").modal({ show: 'true' });

});


$("#cancelid").click(function () {

var data_id = $("#cancelid").attr('apt_id');
$.ajax({
    data: { 'data_id1': data_id, },
    type: "POST",
    url: "table/_id INNER JOIUN status.php",
    success: function (data) {
        //   console.log(data);
        $('#success_mes').html(data);

        $("#delete_appointment").modal('hide');
      load_data();


    }
});

setInterval(function () {
    $('#user_data').load("sidebar/apt_table admin.php").fadeIn("slow");
}, 500);

});




</script>











</body>


<!-- schedule23:21-->

</html>