<!DOCTYPE html>
<html lang="en">
<?php

session_start();

include ('auth/dbconnection.php');


if(!isset($_SESSION['user_id'])){
    header('location:login.php');
}

    // if(isset($_GET['print'])){
    //     ob_start();

    //     require_once "fpdf/fpdf.php";
      
    //     $pdf = new FPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial','B',11);
      
    //     $image1 = "logo-dark.png";
      
      
    //     // $pdf->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
    //     $pdf-> Image('assets/img/'.$image1,10,15,35,35);
      
    //     $pdf->Cell(170,45,'Patients who got Appointments from the Doctors',50,1,'C');
    //     $pdf->Cell(30,10,'SEUS Hospital',10,1,'C');
      
      
    //     $pdf->Cell(30,12,'Patient ID',1);
    //     $pdf->Cell(30,12,'Name',1);
    //     $pdf->Cell(30,12,'Address',1);
    //     $pdf->Cell(30,12,'Gender',1);
    //     $pdf->Cell(30,12,'DOB',1);
    //     $pdf->Cell(30,12,'Contact',1,true);
      
      
    //     $stmt = $conn->prepare("SELECT DISTINCT  * FROM appointment as a INNER JOIN patients as p ON p.p_id= a.p_id AND a.doctor_status='1' GROUP BY p.p_id");
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     if($result->num_rows > 0){
    //     while($row = $result->fetch_assoc()) {
      
    //     $p_id= $row['p_id']; 
    //     $name= $row["p_fname"].' '.$row["p_lname"];  
    //    if($row["p_address"] == ''){  $address= 'Not Inserted'; }else{  $address= $row["p_address"] ; } 
    //      $gender= $row['p_gender'];  
    //       $dob= $row['dob'];   
    //    if($row["p_contact"] == '0'){  $contact= 'Not Inserted'; }else{ $contact= $row["p_contact"] ; } 
      
    //       $pdf->Cell(30,12,$p_id,1);
    //       $pdf->Cell(30,12,$name,1);
    //       $pdf->Cell(30,12,$address,1);
    //       $pdf->Cell(30,12,$gender,1);
    //       $pdf->Cell(30,12,$dob,1);
    //       $pdf->Cell(30,12,$contact ,1,true);
      
    //     }
      
    //   }else{
      
    //       $pdf->Cell(47,12,'No Patients',1);
      
    //   }
      
    //     $pdf->Output();
    //     ob_end_flush(); 

      
    //   }

?>

<!-- tables-datatables23:59-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"  href="assets/vendor/DataTables/buttons.datatables.min.css">    


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
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php

if( $_SESSION['role_id']=='1'){
    include ('sidebar/adminsidebar.php');
            } 
          if( $_SESSION['role_id']=='4'){
            include ('sidebar/receptionist.php');
        }
?>

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Patients (Got Appointments)</h4>
                    </div>
                    <div class="col-sm-12 col-12 text-right m-b-30">

<!-- <div class="btn-group btn-group-sm">
       <a href="our_patient.php?print=1"> <button class="btn btn-white" id="print" name="cancel"><i class="fa fa-print"></i> Print</button></a>
    </div>--> </div> 
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Patient Details</h6>
                                <p class="content-group">
                                     Selected patient who got <code> Appointments </code> from the Doctor.
                                </p>
								<div class="table-responsive">
                                <table id="table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        <th align="center"> ID</th>
                                        <th align="center">Patient name</th>
                                        <!-- <th align="center">Email</th> -->
                                        <th align="center">Address</th>
                                        <th align="center">Gender</th>
                                        <th align="center">DOB</th>                            
                                        <th align="center">Contact</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
<?php  
    $stmt = $conn->prepare("SELECT DISTINCT  * FROM appointment as a INNER JOIN patients as p ON p.p_id= a.p_id AND a.doctor_status='1' GROUP BY p.p_id");
    // $stmt->bind_param("s",$_POST["doctor_name"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {

?>

                                        <tr>
                                            <td><?php echo $row['p_id'];   ?></td>
                                            <td><?php echo $row["p_fname"].' '.$row["p_lname"];   ?></td>
                                            <td><?php if($row["p_address"] == ''){  echo 'Not Inserted'; }else{  echo $row["p_address"] ; }  ?></td>
                                            <td><?php echo $row['p_gender'];   ?></td>
                                            <td><?php echo $row['dob'];   ?></td>
                                            <td><?php if($row["p_contact"] == '0'){  echo 'Not Inserted'; }else{  echo $row["p_contact"] ; }  ?></td>

                                        </tr>

    <?php  }} ?>   
                                    </tbody>
                                </table>
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
    <script src="assets/vendor/DataTables/dataTables.buttons.min.js" type="text/javascript"></script> 
    <script type="text/javascript" src="assets/vendor/DataTables/buttons.print.min.js"></script>
    <script src="assets/vendor/DataTables/jszip.min.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/pdfmake.min.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/vfs_fonts.js" type="text/javascript"></script> 
    <script src="assets/vendor/DataTables/buttons.html5.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable({
                dom: 'lBfrtip',
buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print']

            });
        });
    </script>




</body>


<!-- tables-datatables23:59-->
</html>