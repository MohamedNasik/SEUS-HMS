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

            if(!isset($_SESSION['p_id'])){
              header('location:index.php');
              }
      
      
      
      $p_id=$_SESSION['p_id'];
      // $patientname=$_SESSION['patientname'];
      

         require_once 'auth/dbconnection.php';

?>
<!-- roles-permissions24:05-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
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

if( $_SESSION['role_id']=='2'){
              include ('sidebar/doctorsidebar.php');
          }
    
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                <div class="col-sm-5 col-4">
                        <h4 class="page-title">Prescription Details</h4>
                    </div>

                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">                        
                            <button class="btn btn-white" onclick="location.href='auth/logout_patient.php';"><i class="fa fa-edit fa-lg"></i> Logout</button>
                        
                        
                        </div>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <!-- <a href="create-invoice.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Create New Invoice</a> -->
                    </div>

                    
                </div>
                <?php 

$stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND date=? AND user_id=? ");
$stmt->bind_param("ssss", $_GET['p_id'], $_GET['aptid'],  $_GET['date'],$_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
 

    $investigations = json_decode($row['investigations'],true);

    if (is_array($investigations) || is_object($investigations)) {
        foreach($investigations as $key => $object) {
?>

<div class="row">
					<div class="col-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Overview of <strong>  <?php echo $row['decease_name'] ?> </strong>  </h4> 
							</div>
						</div>
					</div>
            </div>



                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                        <!-- <a href="add-role.php" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add Roles</a> -->
                        <div class="roles-menu">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Investigations</a>
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Medicines Prescribed</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Testings Prescribed</a>
  <!-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> -->
</div>

                        </div>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
                        <!-- <h6 class="card-title m-b-20">Prescription Details</h6> -->
                        <div class="m-b-30">

                        <div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
 


 
  <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Presenting Complaints
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      <?php echo $object['complaints'] ?>      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Patient Past History
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <?php echo $object['past_history'] ?>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Examination Findings        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <?php echo $object['special_investigations'] ?>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Hidden Remarks
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      <?php echo $object['hidden'] ?>
      </div>
    </div>
  </div>



</div>

        <?php }}} } else{

echo 'No records found';


        }  ?>

  
  </div>
  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
  
  <div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Medicine Name</th>
												<th>Morning</th>
                                                <th>Noon</th>
                                                <th>Night</th>
                                                <th>Period</th>
											</tr>
										</thead>
										<tbody>
<?php 

$stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND date=? AND user_id=? ");
   $stmt->bind_param("ssss", $_GET['p_id'], $_GET['aptid'],  $_GET['date'],$_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
    $remark=$row['remark'];

    $medRecords = json_decode($row['med_records'],true);
    if (is_array($medRecords) || is_object($medRecords)) {
        foreach($medRecords as $key => $object) {

            if(isset($object['medical'])){

                $medicines=  $object['medical'];

                if( $medicines=='No need Medicines'){
                    $tests ='No need testings';
?>

<tr>  <td colspan="5"> <center>  Medicines did not provided  </center></td>  </tr>              
  <?php  } }else{   ?>  


											<tr>
                                            <td><?php echo $object['medname'] ?></td>
												<td><?php echo $object['morning'] ?></td>
												<td><?php echo $object['noon'] ?></td>
                                                <td><?php echo $object['night'] ?></td>
                                                <td><?php echo $object['period'] ?></td>
											
											</tr>	
   <?php 
         }
}   
} 

?>
										</tbody>
									</table>
								</div>
  <br><br>

  <div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th colspan='2'>Remark (Diet Advice):</th>
                                                </tr>
                                                <tr>
												<td>      <?php echo  $remark    ?></td>
                                             </tr>
                                            </tr>
                                            

                                            <?php
} } else{
    echo 'No records found';

}
                                            ?>
										</thead>
										<tbody>
                                        </tbody>
</table>
</div>



  
  </div>
  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
  
  <div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Testings</th>
											
											</tr>
										</thead>
										<tbody>
<?php 

$stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND date=? AND user_id=? ");
   $stmt->bind_param("ssss", $_GET['p_id'], $_GET['aptid'], $_GET['date'], $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
     
    $medRecords = json_decode($row['testing_details'],true);
    if (is_array($medRecords) || is_object($medRecords)) {
         foreach($medRecords as $key => $object) {

           $tests=  $object['testings'];
           if( $tests=='No need testings'){
               $tests ='No need testings';
           }else{ 
           $tests=  implode(" , ",$tests);// Use of implode function  s
           }
   
?>
											<tr>
												<td><?php echo $tests ?></td>
											
											</tr>	
   <?php 
         }
}   
} }else{

    echo 'No records found';

    
}

  

?>
										</tbody>
									</table>
								</div>

<br><br>

<div class="table-responsive">
									<table class="table table-bordered mb-0">
										<thead>
											<tr>
												<th>Testings Remark</th>
											
											</tr>
										</thead>
										<tbody>
<?php 

$stmt = $conn->prepare("SELECT * FROM prescription WHERE p_id = ?  AND apt_id= ? AND date=? AND user_id=? ");
   $stmt->bind_param("ssss", $_GET['p_id'], $_GET['aptid'], $_GET['date'], $_SESSION['user_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()) {
     
    $medRecords = json_decode($row['testing_details'],true);
    if (is_array($medRecords) || is_object($medRecords)) {
         foreach($medRecords as $key => $object) {
   
?>
											<tr>
												<td><?php echo $object['testingremark'] ?></td>
											
											</tr>	
   <?php 
         }
}   
} }else{

    echo 'No records found';

}

  

?>
										</tbody>
									</table>
								</div>
  
  
  </div>
  <!-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> -->
</div>

                        </div>
                        
                    </div>
                </div>
            </div>
            
		<div id="delete_role" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Role?</h3>
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
    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	  <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- roles-permissions24:05-->
</html>