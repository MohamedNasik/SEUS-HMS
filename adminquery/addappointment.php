<?php
 
 session_start();
 
// Include config file
require_once "../auth/dbconnection.php";


 if (isset($_POST['doctor_name'])) {

  $doctor_name=$_POST["doctor_name"];
  $doctorspecilization=$_POST["specilization"];
  $patient_id=$_POST["patient_name"];
  $typed=$_POST["typed"];

  $date = $_POST["date"];

    $patient_status="1";
    $admin_status="1";
    $doctor_status="3";
    
    $stmt7 = $conn->prepare("SELECT * FROM patients WHERE p_id = ? ");
    $stmt7->bind_param("s",$patient_id);
    $stmt7->execute();
    $result7 = $stmt7->get_result();
    if($result7->num_rows > 0){
      while($row = $result7->fetch_assoc()) {
 
       $email = $row['email'];
       $patient_name = $row['username'];

    }
 
   }

   $patient_name=$patient_name;
 


 //  get the user id from the db
    $stmt = $conn->prepare("SELECT * FROM doctor_specialist WHERE user_id = ? ");
    $stmt->bind_param("s",$doctor_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
    
    $doctor_name = $row['username'];
    $user_id = $row['user_id'];

    //  get the user id and date from the db
    $stmt1 = $conn->prepare("SELECT * FROM doctor_schedule WHERE user_id = ? ");
    $stmt1->bind_param("s",$user_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if($result1->num_rows > 0){
    while($row = $result1->fetch_assoc()) {
    
     $startDate = date('Y-m-d', strtotime($row['start_time']));
     $starts = date('Y-m-d  H:i:s', strtotime($row['start_time']));
 
     $start_time = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['start_time'])));
 
 
   if($startDate ==  $date ) {  
 
 $stmt2 = $conn->prepare("SELECT * FROM appointment WHERE user_id = ? AND apt_date=?");
 $stmt2->bind_param("ss",$user_id,$date);
 $stmt2->execute();
 $result2 = $stmt2->get_result();
 if($result2->num_rows > 0){
   while($row = $result2->fetch_assoc()) {
 
 
 }
 
 $stmt3 = $conn->prepare("SELECT * FROM patient_schedule WHERE user_id= ? AND DATE_FORMAT(end_event,'%Y-%m-%d')  = ? order by end_event DESC LIMIT 1");
 $stmt3->bind_param("ss",$user_id,$date);
 $stmt3->execute();
 $result3 = $stmt3->get_result();
 if($result3->num_rows > 0){
   while($row = $result3->fetch_assoc()) {
 
     $startings= $row['end_event'];
     $time_interval = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['end_event'])));
 
     $sql= "INSERT INTO appointment (specilization,user_id,p_id,patient_name,apt_date,type,patient_status,admin_status,doctor_status) 
     VALUES ('". $doctorspecilization."','". $user_id."','". $patient_id."','". $patient_name."',  '". $date."','". $typed."','". $patient_status."','". $admin_status."','". $doctor_status."')  ";
     
 
     if(mysqli_query($conn,$sql) ){
       // echo'Admin added succesfully!!';
    $apt_id = $conn->insert_id;
 
     }
     else {
       echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
     }
 
     $title =  $patient_name   .' ( Dr. ' .$doctor_name. ' ' . $doctorspecilization.')' ;
     $color= '#6453e9';
     $text= '##ffffff';
     
 
     $sqli= "INSERT INTO patient_schedule (apt_id,user_id,p_id,title,start_event,end_event,color,text_color) 
     VALUES ('". $apt_id."','". $user_id."','". $patient_id."','". $title."',  '".  $startings ."','". $time_interval."','". $color."','". $text."')  ";
     
     if(mysqli_query($conn,$sqli) ){
       echo'Admin added succesfully!!';
   
     }
     else {
       echo "ERROR: Could not able to execute $sqli. " . mysqli_error($conn);
     }
 
 
 
 }
 
 }
 
   // sent email for APPOINTMENT
   $token = 'http://localhost/Hospital/hospitalwebsite/admin-import-data.php';
 
   $to      = $email;
   $subject = 'Regarding the Appointment Request';
   $message = '<p> Your Appointment requested for <b> Dr.'.$doctor_name.' ('.$doctorspecilization.') </b> on '.$date. ' has <b> been sent.</b> Please refer '.$token.' for the patient schedule and Doctor Consulting time . <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
   
  $headers = 'From: seus@gmail.com' . "\r\n" ;
  $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
   
  
   mail($to, $subject, $message, $headers);
  
 
 
 
 
 $stmt2->close();
 $stmt3->close();
 
 // echo 'yes';
 
     }else {
 
       $time_interval = date('Y-m-d H:i:s',strtotime('+15 minutes',strtotime($row['start_time'])));
 
       $sql= "INSERT INTO appointment (specilization,user_id,p_id,patient_name,apt_date,type,patient_status,admin_status,doctor_status) 
       VALUES ('". $doctorspecilization."','". $user_id."','". $patient_id."','". $patient_name."',  '". $date."','". $typed."','". $patient_status."','". $admin_status."','". $doctor_status."')  ";
       
 
       if(mysqli_query($conn,$sql) ){
        
      $apt_id = $conn->insert_id;
 
       }
       else {
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
       }
 
       $title =  $patient_name   .' ( Dr. ' .$doctor_name. ' ' . $doctorspecilization.')' ;
       $color= '#6453e9';
       $text= '##ffffff';
       
 
       $sqli= "INSERT INTO patient_schedule (apt_id,user_id,p_id,title,start_event,end_event,color,text_color) 
       VALUES ('". $apt_id."','". $user_id."','". $patient_id."','". $title."',  '".  $starts ."','". $time_interval."','". $color."','". $text."')  ";
       
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
     $message = '<p> Your Appointment requested for <b> Dr.'.$doctor_name.' ('.$doctorspecilization.') </b> on '.$date. ' has <b> been sent.</b> Please refer '.$token.' for the patient schedule and Doctor Consulting time . <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
     
    $headers = 'From: seus@gmail.com' . "\r\n" ;
    $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
     
    
     mail($to, $subject, $message, $headers);
    
 
 
 
     
 
     }
 
 
     }else{
 
       echo 'Check';
 
     }
 
 
 }
 
 
 }else{
 
   echo 'Not';
 }
 
 }
 }
 
 
 
 
   }
 
  ?>
 

