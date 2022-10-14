<?php
include '../auth/dbconnection.php';
require '../phpmailer/Mail.php';


 $stmt1 = $conn->prepare("SELECT * FROM patients WHERE p_id=?");
 $stmt1->bind_param("s", $_POST['p_id']);
 $stmt1->execute();
 $result = $stmt1->get_result();
  if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
     $username=$row['p_fname'].' '.$row['p_lname'];
     $email=$row['email'];
     
    }
  
}

//  approve appoitment
if (isset($_POST['data_id'])) {

  $id=$_POST['data_id'];
  $date=$_POST['date'];
  $no=$_POST['No'];

   $stmt = $conn->prepare("UPDATE appointment SET admin_status = ?,patient_status = ? WHERE No= ? ");
   $admin_status='1';
   $patient_status='1';

   $stmt->bind_param("ssi", $admin_status,$patient_status,$no);
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

 date_default_timezone_set('Asia/Colombo');

 $cur_date = date('Y-m-d H:i:s', time());
 $cur_date = strtotime($cur_date);
 $cur_date = date('Y-m-d H:i:s', $cur_date); 
   
$stmts = $conn->prepare("SELECT * FROM doctor_schedule WHERE DATE_FORMAT(start_time,'%Y-%m-%d')  = ? AND user_id=? ");
$stmts->bind_param("ss",$_POST['date'],$_POST['user_id']);
$stmts->execute();
$resultss = $stmts->get_result();
if($resultss->num_rows > 0){
  while($row = $resultss->fetch_assoc()) {

    $start_times_doctor = date('Y-m-d H:i:s', strtotime($row['start_time']));
  }}

  if($start_times_doctor > $cur_date ){

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
  $apt_ids=  $row['apt_id'];
  $apt_ids= $apt_ids - 1;

  $start_time_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['start_time'])));
  $end_times_patient = date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($row['end_time'])));

  // $status3= mysqli_query($con, " UPDATE patient_schedule SET start_time ='$start_time_patient' ,end_time= '$end_times_patient' WHERE id = '$schid' ") ;
  
//  update
 $stmt3 = mysqli_prepare($conn,"UPDATE patient_schedule SET start_time =? ,end_time=?, apt_id=? WHERE id =?");

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
  $stmt3->bind_param('ssss', $start_time_patient,$end_times_patient,$apt_ids,$schid);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
  $status3 = $stmt3->execute();
/* BK: always check whether the execute() succeeded */



}

//  search patient appointment
$stmt4 = $conn->prepare("SELECT * FROM appointment WHERE  apt_date  = ? AND user_id=? AND  apt_id > ? ");
$stmt4->bind_param("sss",$_POST['date'],$_POST['user_id'],$_POST['data_id1']);
$stmt4->execute();
$result4 = $stmt4->get_result();
if($result4->num_rows > 0){
  while($row = $result4->fetch_assoc()) {    

    $aptid=  $row['apt_id'];
    $aptid= $aptid - 1;
    $no = $row['No'];

//  update patient appointment
$stmt5 = mysqli_prepare($conn,"UPDATE appointment SET apt_id =? WHERE No =?");

$stmt5->bind_param('ss', $aptid, $no);

$status5 = $stmt5->execute();


$stmt16 = mysqli_prepare($conn,"UPDATE opd_payments SET apt_id =? WHERE No =?");
$stmt16->bind_param('ss', $aptid, $no);
$stmt16->execute();


  }

}

// $stmt16 = $conn->prepare("SELECT * FROM opd_payments WHERE user_id AND apt_date =? AND apt_id > ?  ");
// $stmt16->bind_param("sSS",$_POST['user_id'],$_POST['date'],$_POST['data_id1']);
// $stmt16->execute();
// $result16 = $stmt16->get_result();
// if($result16->num_rows > 0){
//   while($row = $result16->fetch_assoc()) {    

//     $aptid= $aptid - 1;

//  update patient appointment
;


// }}




if ($status3 === true) {

    echo "Records was updated successfully."; 
     
    }

    $stmt2 = $conn->prepare("UPDATE appointment SET apt_id =?, admin_status=?, patient_status=? WHERE No =? ");
    $apt_id="0";
    $admin_status="0";
    $patient_status="0";
  
    $stmt2->bind_param("iiii",$apt_id, $admin_status, $patient_status,$_POST['No']);
    $status5 = $stmt2->execute();

// delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();

  //  update patient OPD
$stmt6 = $conn->prepare("UPDATE opd_payments SET apt_id =? WHERE No =?");
$apt_id="0";
$stmt6->bind_param('ss',$apt_id, $_POST['No']);
$stmt6->execute();
 
}else{

  $stmt2 = $conn->prepare("UPDATE appointment SET apt_id =?, admin_status=?, patient_status=? WHERE No =? ");
  $apt_id="0";
  $admin_status="0";
  $patient_status="0";

  $stmt2->bind_param("iiii",$apt_id, $admin_status, $patient_status,$_POST['No']);
  $status5 = $stmt2->execute();

  // delete patient schedule
  $stmt = $conn->prepare("DELETE FROM patient_schedule WHERE id = ?");
  $stmt->bind_param("i",$event_id);
  $stmt->execute();
  echo "Records was updated successfully."; 

  //  update patient appointment
  $stmt6 = $conn->prepare("UPDATE opd_payments SET apt_id =? WHERE No =?");
  $apt_id="0";
$stmt6->bind_param('ss',$apt_id, $_POST['No']);
$stmt6->execute();

}
 

 }

}                                                                                                                                                                                                         else{   include 'else.php';   }


  // sent email for cancel apt
  $to      = $email;
  $subject = 'Regarding the Appointment Request';
  $message = '<p> Your Appointment requested on '.$date. ' has been <b> cancelled.</b> Please refer the appointment schedule for further details or make a new appointment. <br> Thank You.<br> <br>Best Regards from <br> <b><i>  SEUS Hospitals </i> </b> </br>';
  $headers = 'From: seus@gmail.com' . "\r\n" ;
  $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 
  mail($to, $subject, $message, $headers);
 

 $conn->close(); 

}


?>