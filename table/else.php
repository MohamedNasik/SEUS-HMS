<?php

//  search patient schedule
$stmt = $conn->prepare("SELECT * FROM patient_schedule WHERE apt_id=? AND DATE_FORMAT(start_time,'%Y-%m-%d')  = ? AND user_id=? AND p_id=? ");
$stmt->bind_param("ssss",$_POST['data_id1'],$_POST['date'],$_POST['user_id'],$_POST['p_id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) ;
while($row = $result->fetch_assoc()) {

$event_id = $row['id'];

$stmt2 = $conn->prepare("SELECT * FROM patient_schedule WHERE DATE_FORMAT(start_time,'%Y-%m-%d')  = ? AND user_id=?  AND id > ?");
$stmt2->bind_param("sss",$_POST['date'],$_POST['user_id'],$event_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
if($result2->num_rows > 0){
 while($row = $result2->fetch_assoc()) {

  $schid=  $row['id'];

  $start_time_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['start_time'])));
  $end_times_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['end_time'])));

  
//  update patient_schedule
 $stmt3 = mysqli_prepare($conn,"UPDATE patient_schedule SET start_time =? ,end_time=? WHERE id =?");
 $stmt3->bind_param('sss', $start_time_patient,$end_times_patient,$schid);

/* Execute the prepared Statement */
  $status3 = $stmt3->execute();
/* BK: always check whether the execute() succeeded */
}


//  update patient appointment
$stmt5 = mysqli_prepare($conn,"UPDATE appointment SET admin_status =?, patient_status=? WHERE No =?");
$admin_status="0";
$patient_status="0";
$stmt5->bind_param('sss',$admin_status, $patient_status, $_POST['No']);
$status5 = $stmt5->execute();

// delete patient schedule
$stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
$stmt->bind_param("i",$event_id);
$stmt->execute();

  //  update patient appointment
  // $stmt6 = mysqli_prepare($conn,"UPDATE opd_payments SET apt_id =? WHERE No =?");
  
  // $stmt6->bind_param('ss',$apt_id, $_POST['No']);
  // $stmt6->execute();



if ($status5 === true && $status3 === true) {

  echo "Records was updated successfully."; 
   
  }


}else{

  
//  update patient appointment
$stmt2 = mysqli_prepare($conn,"UPDATE appointment SET admin_status =?, patient_status=? WHERE No =?");
$admin_status="0";
$patient_status="0";
$stmt2->bind_param('sss',$admin_status, $patient_status, $_POST['No']);
$status2 = $stmt2->execute();

  // delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();
  echo "Records was updated successfully."; 


}


}  // end while















?>