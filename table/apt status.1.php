<?php
include '../auth/dbconnection.php';
require '../phpmailer/Mail.php';


 $stmt1 = $conn->prepare("SELECT * FROM patients WHERE p_id=?");
 $stmt1->bind_param("s", $_POST['p_id']);
 $stmt1->execute();
 $result = $stmt1->get_result();
  if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
     $username=$row['username'];
     $email=$row['email'];
     
    }
  
}

//  approve appoitment
if (isset($_POST['data_id'])) {

    //    try {

   $id=$_POST['data_id'];
  $date=$_POST['date'];
   $stmt = $conn->prepare("UPDATE appointment SET admin_status = ?,patient_status = ? WHERE apt_id= ?");
   $admin_status='1';
   $patient_status='1';

   $stmt->bind_param("ssi", $admin_status,$patient_status, $id);
   $status = $stmt->execute();

   if ($status === true) {

    // sent email for approve
 $to      = $email;
 $subject = 'Regarding the Appointment Request';
 $message = '<p> Your Appointment requested on '.$date. ' has <b> approved.</b> Please refer the patient schedule for time arrivals. <br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
 
$headers = 'From: seus@gmail.com' . "\r\n" ;
$headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 

 mail($to, $subject, $message, $headers);

    echo "Records was updated successfully."; 

} else {
    echo 'cant'; 
}

$conn->close(); 
}




//  cancel appointment
if (isset($_POST['data_id1'])) {

 $id=$_POST['data_id1'];
 $date=$_POST['date'];


 $stmt1 = $conn->prepare("UPDATE opd_payments SET status = ? WHERE apt_id= ?");
 $p_status='0';
 $stmt1->bind_param("si", $p_status, $id);
 $status1 = $stmt1->execute();




//  search patient schedule
$stmt = $conn->prepare("SELECT * FROM patient_schedule WHERE apt_id=? AND DATE_FORMAT(start_time,'%Y-%m-%d')  = ? AND user_id=? AND p_id=? ");
$stmt->bind_param("ssss",$_POST['data_id1'],$_POST['date'],$_POST['user_id'],$_POST['p_id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) ;
while($row = $result->fetch_assoc()) {

$event_id = $row['id'];

//  search patient appointment
$stmt4 = $conn->prepare("SELECT * FROM appointment WHERE  apt_date  = ? AND user_id=? AND  apt_id > ? ");
$stmt4->bind_param("sss",$_POST['date'],$_POST['user_id'],$_POST['data_id1']);
$stmt4->execute();
$result4 = $stmt4->get_result();
if($result4->num_rows > 0){
  while($row = $result4->fetch_assoc()) {    

$aptid = $row['apt_id'];
$no = $row['No'];

$aptid= $aptid - 1;

//  update patient appointment
$stmt5 = mysqli_prepare($conn,"UPDATE appointment SET apt_id =? WHERE No =?");

$stmt5->bind_param('ss', $aptid, $no);

$status5 = $stmt5->execute();



$stmt2 = $conn->prepare("SELECT * FROM patient_schedule WHERE DATE_FORMAT(start_time,'%Y-%m-%d')  = ? AND user_id=?  AND id > ?");
$stmt2->bind_param("sss",$_POST['date'],$_POST['user_id'],$event_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
if($result2->num_rows > 0){
 while($row = $result2->fetch_assoc()) {

  $schid=  $row['id'];

  $start_time_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['start_time'])));
  $end_times_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['end_time'])));

  // $status3= mysqli_query($con, " UPDATE patient_schedule SET start_time ='$start_time_patient' ,end_time= '$end_times_patient' WHERE id = '$schid' ") ;
  
//  update
$stmt3 = mysqli_prepare($conn,"UPDATE patient_schedule SET start_time =? ,end_time=?,apt_id=? WHERE id =?");

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
  $stmt3->bind_param('ssss', $start_time_patient,$end_times_patient,$aptid, $schid);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
  $status3 = $stmt3->execute();
/* BK: always check whether the execute() succeeded */



}

if ($status3 === true && $status5  === true) {

    echo "Records was updated successfully."; 
     
    }

// delete patient appointment
    $stmt2 = $conn->prepare("DELETE FROM appointment WHERE No= ? ");
    $admin_status='0';
    $patient_status='0';
    $stmt2->bind_param("i",$_POST['No']);
    $status = $stmt2->execute();
   
// delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();
 
}else{
  // delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();
  echo "Records was updated successfully."; 

}

 }


 }else{
// delete patient appointment
$stmt2 = $conn->prepare("DELETE FROM appointment WHERE No= ? ");
$admin_status='0';
$patient_status='0';
$stmt2->bind_param("i",$_POST['No']);
$status = $stmt2->execute();

  // delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();


  echo "Records was updated successfully."; 

}


}

if ($status === true && $status1 === true) {

  // sent email for cancel apt
  $to      = $email;
  $subject = 'Regarding the Appointment Request';
  $message = '<p> Your Appointment requested on '.$date. ' has been <b> cancelled.</b> Please refer the appointment schedule for further details or make a new appointment. <br> Thank You.<br> <br>Best Regards from <br> <b><i>  SEUS Hospitals </i> </b> </br>';
  $headers = 'From: seus@gmail.com' . "\r\n" ;
  $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 
  mail($to, $subject, $message, $headers);
 
} else{ 
   echo "ERROR: Could not able to execute. "  
                                       . $conn->error; 
} 



$conn->close(); 


}


?>