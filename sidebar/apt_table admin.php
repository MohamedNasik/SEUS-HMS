
                           	<table class="datatable table table-hover" >
                                    <thead>
									<tr>
									<th>Apt ID</th>
										<th>Doctor </th>
										<th>Specialization</th>			
										<th>Patient </th>
                                        <th>Type</th>
                                        <th>Apt Date</th>
								
										<th>Status</th>
										<th>Status but</th>
										<th class="text-right">Action</th>
									</tr>
                                    </thead>
                                    <tbody>
									<tr>

									<?php
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 try {
   $conn = new mysqli("localhost", "root", "", "hmsproject");
   $conn->set_charset("utf8mb4");
 } catch(Exception $e) {
   error_log($e->getMessage());
   exit('Error connecting to database'); //Should be a message a typical user could understand
 }

$query="SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id ORDER BY apt_id DESC";	
$results =mysqli_query($conn,$query);

//$sql = "SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id ORDER BY apt_id DESC";
    if($results = mysqli_query($conn,$query)){
		if(mysqli_num_rows($results) > 0){
			while($row =mysqli_fetch_array($results) ) { 
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
                                        <?php } else if($row['admin_status']=="1") {    ?>
											<span class="custom-badge status-green">Active</span>
                                             <?php  } else {   ?>
												<span class="custom-badge status-blue">Pending</span>

											 <?php } ?>
										</td>

										<td>
										<button id="check<?php echo $row['apt_id'] ?>" class="btn btn-success custom-badge status-green check" value="Submit"  data-id=<?php echo $row['apt_id']?> onclick="(this.id)">   Change  </button> 
										</td>

										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<!-- <a class="dropdown-item" href="edit-appointment.php"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
													<a class="dropdown-item" href="" data-toggle="modal" id="rep1" data_id=<?php echo $row['apt_id']  ?> data-target="#active_appointment"><i class="fa fa-check"></i> Active</a>
													<a class="dropdown-item" href="" data-toggle="modal" id="rep2" data_id=<?php echo $row['apt_id']  ?> data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													<a class="dropdown-item" href="calendar.php?pid=<?php echo $row['p_id']  ?>&userid=<?php  echo $row['user_id'] ?>&spec=<?php  echo $row['specilization'] ?>&name=<?php echo $row['username'] ?>&pname=<?php echo $row['patient_name'] ?>&apt=<?php echo $row['apt_id'] ?> "><i class="fa fa-calendar-o m-r-5"></i> Add Schedule</a>

												</div>
											</div>
										</td>
									</tr>
								
	<?php  }}} ?>
                                   
                                    </tbody>
                                </table>
