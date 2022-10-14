<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }


            if(!isset($_SESSION['p_id'])){
                header('location:index.php');
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

        
        
        
        $p_id=$_SESSION['p_id'];
        // $patientname=$_SESSION['patientname'];
        


?>

<!-- patients23:17-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css"> -->
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

  if( $_SESSION['role_id']=='2'){
                include ('sidebar/doctorsidebar.php');
            }
      
?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                <div class="col-sm-5 col-4">
                        <h4 class="page-title">Patient Appointments </h4>
                    </div>

                 

             
                    <div class="col-sm-7 col-8 text-right m-b-30">
                    <a href="doctor_recommend.php?p_id=<?php echo $_SESSION['p_id'];   ?>" class="btn btn btn-primary btn-rounded"><i
                                class="fa fa-user-md">  </i> Doctor Recommended </a>

                    <a href="summery.php?p_id=<?php echo $_SESSION['p_id'];   ?>" class="btn btn-primary btn-rounded"><i class="fa fa-edit"></i> View Summery</a>  
                    <button class="btn btn-white" onclick="location.href='auth/logout_patient.php';"><i class="fa fa-edit fa-lg"></i> Logout</button>

                    </div>




                </div> 

                <div class="row">
  
  <div class="col-md-6 col-lg-6 col-xl-2">

</div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                  <div class="card shadow">
                      <div class="card-body text-center">
                      <i class="fa fa-user-md fa-4x text-primary"></i>
                      <h4 class="mt-3 text-xl" >Based On First  Visit</h4>
                          <!-- <a href="first_prescription.php?aptid=<?php  echo $_GET['aptid']; ?>&p_id=<?php  echo $_GET['p_id']; ?>" class="btn btn-primary "> <i class="fa fa-eye">  View  </i></a> -->
                      </div>
                  </div>
              </div>

              <div class="col-md-6 col-lg-6 col-xl-4">
                  <div class="card shadow">
                      <div class="card-body text-center">
                      <i class="fa fa-flask fa-4x text-success"></i>
                          <h4 class="mt-3 text-xl" >Based On Test Reports</h4>
                          <!-- <a href="second_prescription" class="btn btn-success "> <i class="fa fa-eye">  View  </i></a> -->
                      </div>
                  </div>
              </div>





              <div class="col-md-6 col-lg-6 col-xl-2">

</div>



</div>    



				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped custom-table datatable mb-0" id="my">
								<thead>
									<tr>
                                    <th class="text-center">Apt.ID</th>
										<th class="text-center">Patient Name</th>										
										<th class="text-center">Apt.Date</th>		
                                        <th class="text-center">Type</th>			                               	                               
										<th class="text-center">Action</th>
                            

									</tr>
								</thead>
								<tbody>
							
<?php
require_once 'auth/dbconnection.php';
$sql = "SELECT * FROM appointment AS a , patients AS p WHERE  p.p_id = a.p_id AND user_id= '".$_SESSION['user_id']."' AND a.p_id='".$_SESSION['p_id']."'  AND a.doctor_status= '1' AND a.apt_date <= curdate() ORDER BY a.apt_id DESC ";

//$sql = "SELECT * FROM patients ";
    if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){

?>
							         <tr>
                                     <td  align="center"><?php echo $row['apt_id'];?></td>
                                      <td  align="center"><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?php echo $row['p_fname'].' '.$row['p_lname'];?></td>
									  
									  <td  align="center"><?php echo $row['apt_date'];?></td>
                                      <td align="center">
                                      <?php if( $row['type']=='Consultation' ){ ?>
                                        
                                        <i class="fa fa-user-md fa-2x text-primary"></i>  
                                      <?php }  else{ ?>


                                        <i class="fa fa-flask fa-2x text-success"></i>  

                                        <?php }   ?>

                                  </td>

										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="check.php?aptid=<?php  echo $row['apt_id']; ?>& p_id=<?php  echo $row['p_id']; ?>&date=<?php  echo $row['apt_date']; ?>"><i class="fa fa-eye m-r-5"></i> View</a>
													
												</div>
											</div>
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
                
                <br><br>
            

         



                                

            </div>






		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					
                    <div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						
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
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    
    <!-- <script src="assets/js/moment.min.js"></script> -->
    <script src="assets/js/app.js"></script>

 
    <script src="assets/datatables/js/datatables.min.js"></script>

	<!-- Data tables -->
	<script src="assets/new datatable/jquery.dataTables.min.js"></script>
	<script src="assets/new datatable/dataTables.bootstrap4.min.js"></script>


<script>




$(document).ready( function () {
    $('#my').DataTable();
} );

$(document).ready( function () {
    $('#myt').DataTable();
} );
</script>
</body>


<!-- patients23:19-->
</html>