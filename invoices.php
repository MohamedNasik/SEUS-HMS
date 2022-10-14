<!DOCTYPE html>
<html lang="en">

<?php

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


include ('auth/dbconnection.php');

?>


<!-- invoices23:24-->

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
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Search OPD Invoices</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!-- <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a> -->
                    </div>
                </div>
                <div class="row filter-row">
                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">From</label>
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text">
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                                        <label>Enter Appointment Date </label>
                                        <input class="form-control" type="date" id="dates" name="dates">
                                        <span id="type" class="info text-danger"></span><br />
                      </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                                        <label></label>
                                        <button class="btn btn-success btn-block" id="search"> Search </button>
                                        <span id="type" class="info text-danger"></span><br />
                      </div>
                    </div>

                    <!-- <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Status</label>
                            <select class="select floating">
                                <option>Select Status</option>
                                <option>Pending</option>
                                <option>Paid</option>
                                <option>Partially Paid</option>
                            </select>
                        </div>
                    </div> -->
             
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="list">
                        <table id="myTable" style="width:100%" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Ptient Name</th>
                                        <th>Doctor</th>
                                        <th>Specialist</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
      <tr>
       <th colspan="6">Total</th>
       <th id="total_order"></th>
      </tr>
     </tfoot>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="delete_invoice" class="modal fade delete-modal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img src="assets/img/sent.png" alt="" width="50" height="46">
                            <h3>Are you sure want to delete this Invoice?</h3>
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>

        <script>


            $(document).ready(function () {

                fill_datatable();

   function fill_datatable(dates = '')
  {
    var dataTable = $('#myTable').DataTable({
    "processing" : true,
    "serverSide" : true,
    // "searching" : false,
    "order" : [],
    "ajax" : {
     url:"adminquery/view_opd_total.php",
     type:"POST",
     data:{
        dates:dates
     }
    },
    dom: 'lBfrtip',
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'],
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],


    drawCallback:function(settings)
    {
     $('#total_order').html(settings.json.total);
    }
   });

  }


   $('#search').click(function(){
   var dates = $('#dates').val();
//    var dates = document.getElementById('dates').value;

   if (!dates) 
   {

    $('#myTable').DataTable().destroy();
    fill_datatable();
  
   }


   else
   {
    $('#myTable').DataTable().destroy();
    fill_datatable(dates);


    
   }
  });







                // $("#search").click(function () {

                //     var patient_id = $("#patient_id").val();

                //     var patient_id = { 'patient_id': patient_id, }

                //     var valid;
                //     valid = validateContact();

                //     if (valid) {

                //         $.ajax({
                //             url: "adminquery/fetch/fetch_opd.php", // Url to which the request is send
                //             type: "POST",             // Type of request to be send, called as method
                //             data: patient_id,

                //             success: function (response) {
                //                 // swal("Saved!", "The appointment has been saved !!.", "success");

                //                 $('#list').html(response);

                //             },
                //             error: function (xhr, ajaxOptions, thrownError) {
                //                 // swal("Error Saved!", "Please try again", "error");
                //             }

                //         });

                //     };

                //     // check validations
                //     function validateContact() {
                //         var valid = true;
                //         $(".demoInputBox").css('background-color', '');
                //         $(".info").html('');


                //         if (!$("#patient_id").val()) {
                //             $("#types").html("(Required)");
                //             $("#patient_id").css('background-color', '#FFFFDF');
                //             valid = false;
                //         }


                //         return valid;
                //     }

                // });




            });



        </script>



</body>


<!-- invoices23:25-->

</html>