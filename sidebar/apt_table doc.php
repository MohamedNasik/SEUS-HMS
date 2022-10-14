
                           	<table class="datatable table table-hover" id="myTable">
                                    <thead>
									<tr>
									<th>Appointment ID</th>
										<th>Doctor Name</th>
										<th>Specialization</th>			
										<th>Patient Name</th>
                                        <th>Apt.Type</th>
                                        <th>Apt. Date</th>
								
                                        <th>Status</th>
										
									</tr>
                                    </thead>
                                    <tbody>
									<tr>

									<?php
	require_once ('auth/dbconnection.php');								
$sql = "SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id AND a.user_id= '".$_SESSION['user_id']."' ORDER BY a.apt_id DESC";
    if($result1 = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result1) > 0){
    while($row = mysqli_fetch_array($result1)){
$apt_id= $row['user_id'];
     $user= $row['user_id']   ;
?>
									<td><?php echo $row['apt_id']?> </td>
										<td> <?php echo $row['username']?></td>
										<td> <?php echo $row['specilization']?></td>
										<td> <?php echo $row['patient_name']?></td>	
										<td> <?php echo $row['type']?></td>
										<td> <?php echo $row['apt_date']?></td>
								
										<td>
										

										<?php if($row['admin_status']=="0") {  ?>
										<span class="custom-badge status-red">Cancel</span>
										<?php } else if($row['doctor_status']=="1") {    ?>
											<span class="custom-badge status-green">Success</span>	
                                        <?php } else if($row['admin_status']=="1") {    ?>
											<span class="custom-badge status-green">Active</span>
                                             <?php  } else {   ?>
												<span class="custom-badge status-blue">Pending</span>

											 <?php } ?>
										</td>
									</tr>
								
	<?php  }}} ?>
                                   
                                    </tbody>
                                </table>
