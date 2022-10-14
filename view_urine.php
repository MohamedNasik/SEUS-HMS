<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();
         include 'auth/dbconnection.php';

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>
<!-- invoices23:24-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
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


<?php
            if ($_GET['p_id']) {

         $connect = mysqli_connect("localhost", "root", "", "hmsproject");
         $sql= "SELECT * FROM testing_report as tr INNER JOIN testing_schedule as ts ON tr.test_id=ts.test_id AND tr.pres_id=ts.pres_id AND ts.p_id='".$_GET['p_id']."' AND tr.test_id='2' AND ts.payment_status='2'  INNER JOIN  prescription AS pre  ON pre.pres_id=tr.pres_id  AND pre.user_id='".$_SESSION['user_id']."'  GROUP BY ts.pres_id ORDER BY tr.testing_report_id DESC";
         $result = mysqli_query($connect, $sql);
        }else{
            $connect = mysqli_connect("localhost", "root", "", "hmsproject");
            $sql= "SELECT * FROM testing_report as tr INNER JOIN testing_schedule as ts ON tr.test_id=ts.test_id AND tr.pres_id=ts.pres_id AND ts.p_id='".$_GET['pid']."' AND tr.test_id='2' AND ts.payment_status='2'  INNER JOIN  prescription AS pre  ON pre.pres_id=tr.pres_id  AND pre.user_id='".$_SESSION['user_id']."'  GROUP BY ts.pres_id ORDER BY tr.testing_report_id DESC";

            // $sql= "SELECT * FROM testing_report as tr INNER JOIN testing_schedule as ts ON tr.test_id=ts.test_id INNER JOIN check_report as cr ON tr.pres_id=cr.pres_id AND ts.p_id='".$_GET['pid']."' AND tr.test_id='2' AND ts.payment_status='2'  INNER JOIN  prescription AS pre  ON pre.pres_id=tr.pres_id  AND pre.user_id='".$_SESSION['user_id']."'  GROUP BY ts.pres_id,cr.pres_id ORDER BY tr.testing_report_id DESC";
            $result = mysqli_query($connect, $sql);

        }
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title"><code> Full Urine Report </code>  </h4>
                    </div>
                    <!-- <div class="col-sm-7 col-8 text-right m-b-30">
                        <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a>
                    </div> -->
                </div>
                <div class="row filter-row">
             
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Report ID</label>
                            <select class="select floating" id="test_list">
                                <option>Select ID</option>

                                <?php 
      while($row = mysqli_fetch_array($result))
      {
       echo '<option value="'.$row["testing_report_id"].'">'.$row["testing_report_id"].'</option>';
      }
      ?>
                              
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                    <input type="button" name="search" id="search" class="btn btn-primary" value="Search">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive" id="test_info" style="display:none">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                <tr>
                                                    <th class="center"><strong>No.</strong></th>
                                                    <th class="center"><strong>Modules</strong></th>
                                                    <th class="center"><strong>Results</strong></th>
                                                 

                                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                                    <td class="center">1</td>
                                                    <td class="center">Colour</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="1"> </span></td>
                                               
                                                </tr>

                                                <tr>
                                                    <td class="center">2</td>
                                                    <td class="center">Apprearance	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="2"> </span></td>
                                               
                                                </tr>
                                                <tr>
                                                    <td class="center">3</td>
                                                    <td class="center">S.G. (Refractometer)	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="3"> </span></td>
                                            
                                                </tr>
                                                <tr>
                                                    <td class="center">4</td>
                                                    <td class="center">pH	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="4"> </span></td>
                                             
                                                </tr>
                                                <tr>
                                                    <td class="center">5</td>
                                                    <td class="center">Protien	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="5"> </span></td>
                                                  
                                                </tr>
                                                <tr>
                                                    <td class="center">6</td>
                                                    <td class="center">Glucose	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="6"> </span></td>
                                              
                                                </tr>
                                                <!-- <tr>
                                                    <td class="center">7</td>
                                                    <td class="center">Gran%</td>
                                                    <td class="center"><span id="8"> </span></td>
                                                    <td class="center">%</td>
                                                    <td class="center">50.0 - 70.0</td>
                                                </tr> -->
                                                <tr>
                                                    <td class="center">7</td>
                                                    <td class="center">Ketone Bodies	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="7"> </span></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td class="center">8</td>
                                                    <td class="center">Bilirubin	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="8"> </span></td>
                                                 
                                                </tr>
                                                <tr>
                                                    <td class="center">9</td>
                                                    <td class="center">Urobilinogen</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="9"> </span></td>
                                              
                                                </tr>
                                                <tr>
                                                    <td class="center">10</td>
                                                    <td class="center">Pus Cells</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="10"> </span></td>
                                       
                                                </tr>
                                                <tr>
                                                    <td class="center">11</td>
                                                    <td class="center">Red Cells</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="11"> </span></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td class="center">12</td>
                                                    <td class="center">Epithelial Cells</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="12"> </span></td>
                               
                                                </tr>
                                                <tr>
                                                    <td class="center">13</td>
                                                    <td class="center">Casts	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="13"> </span></td>
                                                 
                                                </tr>
                                                <tr>
                                                    <td class="center">14</td>
                                                    <td class="center">Crystals	</td>
                                                    <td class="center"><span class="custom-badge status-blue" id="14"> </span></td>
                                                 
                                                </tr>

                                                <tr>
                                                    <td class="center" colspan="3"> <center><h5> <strong>Remark</strong></h5></center></td>
                                                
                                                </tr>
                                                
                                     
                                                <tr>
                                                    <td class="center" colspan="3"> <center> <h5><span id="15"> </span> </center> </h5></td>
                                                
                                                </tr>


                                </tbody>
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
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>


    <script>
$(document).ready(function(){
   
   

    $('#search').click( function () {
  var id= $('#test_list').val();
  if (id !=''){

   $.ajax({
  
    url: "testquery/fetch_urine.php", // Url to which the request is send
    method: "POST",             // Type of request to be send, called as method
    data:{id: id},
    dataType:"JSON",
    success:function(data)
    {
        $('#success_mes').fadeIn().html(data);


    $('#test_info').css("display","block");
    $('#1').text(data.colour);

    $('#2').text(data.apprearance);
    $('#3').text(data.sg);
    $('#4').text(data.ph);

    $('#5').text(data.protien);
    $('#6').text(data.glucose);
    $('#7').text(data.ketone);

   // $('#7').text(data.Grans);
    $('#8').text(data.bilirubin);
    $('#9').text(data.uro);

    $('#10').text(data.pus);
    $('#11').text(data.red);
    $('#12').text(data.epith);

    $('#13').text(data.casts);
    $('#14').text(data.crystal);
    $('#15').text(data.remark);

          console.log(data);

}

});

}else{
    alert('sdsd');
    $('#test_info').html('"display","none"');

}




    } );

} );



</script>










    
</body>


<!-- invoices23:25-->
</html>