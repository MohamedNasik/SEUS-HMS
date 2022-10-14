<?php

  //  get the user id and date from the db
  $stmt1 = $conn->prepare("SELECT * FROM doctor_schedule WHERE user_id = ? AND DATE_FORMAT(start_time,'%Y-%m-%d')  = ? ");
  $stmt1->bind_param("ss",$user_id,$date);
  $stmt1->execute();
  $result1 = $stmt1->get_result();
  if($result1->num_rows > 0){
  while($row = $result1->fetch_assoc()) {
  
   $startDate = date('Y-m-d', strtotime($row['start_time']));
   $starts = date('Y-m-d H:i:s', strtotime($row['start_time']));

   $start_time = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['start_time'])));

   $stmt8 = $conn->prepare("SELECT * FROM appointment WHERE user_id = ? AND p_id= ? AND apt_date=?  AND patient_status= '1'");
   $stmt8->bind_param("sss",$user_id,$patient_id,$date);
   $stmt8->execute();
   $result8 = $stmt8->get_result();
   if($result8->num_rows > 0){
  
   echo 'You have already requested for this date with doctor';

   } else{


 if($startDate ==  $date) {  

$stmt2 = $conn->prepare("SELECT * FROM appointment WHERE user_id = ? AND apt_date=?");
$stmt2->bind_param("ss",$user_id,$date);
$stmt2->execute();
$result2 = $stmt2->get_result();
if($result2->num_rows > 0){
 while($row = $result2->fetch_assoc()) {

}

$stmt3 = $conn->prepare("SELECT * FROM patient_schedule WHERE user_id= ? AND DATE_FORMAT(end_time,'%Y-%m-%d')  = ? order by end_time DESC LIMIT 1");
$stmt3->bind_param("ss",$user_id,$date);
$stmt3->execute();
$result3 = $stmt3->get_result();
if($result3->num_rows > 0){
 while($row = $result3->fetch_assoc()) {

   $startings= $row['end_time'];
   $time_interval = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['end_time'])));
  

   $stmt222 = $conn->prepare("SELECT apt_id FROM appointment WHERE user_id = ? AND apt_date=? ORDER BY apt_id DESC LIMIT 1");
   $stmt222->bind_param("ss",$user_id,$date);
   $stmt222->execute();
   $result222 = $stmt222->get_result();
   if($result222->num_rows > 0){
     while($row = $result222->fetch_assoc()) {
       $aptid= $row["apt_id"];
   
   

     }}else{
       echo '2';
     }

   $apt_id=$aptid+ 1;
 
   $sql= "INSERT INTO appointment (apt_id,specilization,user_id,p_id,patient_name,apt_date,type,patient_status,admin_status,doctor_status) 
   VALUES ('". $apt_id."','". $doctorspecilization."','". $user_id."','". $patient_id."','". $patient_name."',  '". $date."','". $typed."','". $patient_status."','". $admin_status."','". $doctor_status."')  ";
   

   if(mysqli_query($conn,$sql) ){
     // echo'Admin added succesfully!!';
 //  $apt_id = $con->insert_id;

   }
   else {
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   }

   // $title =  $patient_name   .' ( Dr. ' .$doctor_name. ' ' . $specilization.')' ;
   $color= '#6453e9';
   $text= '##ffffff';
   

   $sqli= "INSERT INTO patient_schedule (apt_id,user_id,p_id,start_time,end_time,color,text_color) 
   VALUES ('". $apt_id."','". $user_id."','". $patient_id."',  '".  $startings ."','". $time_interval."','". $color."','". $text."')  ";
   
   if(mysqli_query($conn,$sqli) ){
     echo'Admin added succesfully!!';
 
   }
   else {
     echo "ERROR: Could not able to execute $sqli. " . mysqli_error($conn);
   }

}

}else{
  echo '1';
}

 // sent email for APPOINTMENT
 $token = 'http://localhost/Hospital/hospitalwebsite/admin-import-data.php';

 $to      = $email;
 $subject = 'Regarding the Appointment Request';
 $message = '<p> Your Appointment requested for Dr.'.$doctor_name.' ('.$doctorspecilization.') on '.$date. ' has <b> been sent.</b> Please refer '.$token.' for the patient schedule and Doctor Consulting time . <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
 
$headers = 'From: seus@gmail.com' . "\r\n" ;
$headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
 

mail($to, $subject, $message, $headers);

$stmt2->close();
$stmt3->close();

// echo 'yes';

   }else {
     $apt_id="1";

     
     $time_interval = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['start_time'])));

     $sql= "INSERT INTO appointment (apt_id,specilization,user_id,p_id,patient_name,apt_date,type,patient_status,admin_status,doctor_status) 
     VALUES ('". $apt_id."','". $doctorspecilization."','". $user_id."','". $patient_id."','". $patient_name."',  '". $date."','". $typed."','". $patient_status."','". $admin_status."','". $doctor_status."')  ";
     

     if(mysqli_query($conn,$sql) ){
      
   //  $apt_id = $con->insert_id;

     }
     else {
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
     }

     // $title =  $patient_name   .' ( Dr. ' .$doctor_name. ' ' . $specilization.')' ;
     $color= '#6453e9';
     $text= '##ffffff';
     
     $sqli= "INSERT INTO patient_schedule (apt_id,user_id,p_id,start_time,end_time,color,text_color) 
     VALUES ('". $apt_id."','". $user_id."','". $patient_id."',  '".  $starts ."','". $time_interval."','". $color."','". $text."')  ";
     
     if(mysqli_query($conn,$sqli) ){
       echo'Admin added succesfully!!';
   
     }
     else {
       echo "ERROR: Could not able to execute $sqli. " . mysqli_error($conn);
     }
    
     
   // sent email for APPOINTMENT
   $token = 'http://localhost/Hospital/hospitalwebsite/admin-import-data.php';

   $to      = $email;
   $subject = 'Regarding the Appointment Request';
   $message = '<p> Your Appointment requested for Dr.'.$doctor_name.' ('.$doctorspecilization.') on '.$date. ' has <b> been sent.</b> Please refer '.$token.' for the patient schedule and Doctor Consulting time . <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
   
  $headers = 'From: seus@gmail.com' . "\r\n" ;
  $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
   
  
   mail($to, $subject, $message, $headers);
  

   }


   }else{

     echo 'This Doctor does not available in this time';

   }



   
}

  }



}else{

 echo 'This doctor does not available at this moment';
}








?>

