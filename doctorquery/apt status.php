<?php
include '../auth/dbconnection.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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

//  unattent appoitment
if (isset($_POST['data_id1'])) {

  $apt_id=$_POST['data_id1'];
  $date=$_POST['date'];
  $user_id=$_POST['user_id'];
  $p_id=$_POST['p_id'];
  $no=$_POST['No'];


//  update
$stmt3 = mysqli_prepare($conn,"UPDATE appointment SET admin_status = ?,patient_status = ? WHERE No=?");
$admin_status="3";
$patient_status="3";
/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
  $stmt3->bind_param('ssi', $admin_status,$patient_status,$no);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */
/* Execute the prepared Statement */
  $status3 = $stmt3->execute();
/* BK: always check whether the execute() succeeded */

   if ($status3 === true) {

    // sent email for approve
 $to      = $email;
 $subject = 'Regarding the Appointment';
 $message = '<p> Dear '. $username.  '<br><br> Your Appointment request on '.$date. ' has <b> been changed as unattended patient.</b> Please refer the appointment schedule for get more information. <br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
 
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


//  active appoitment
if (isset($_POST['data_id'])) {

  $apt_id=$_POST['data_id'];
  $date=$_POST['date'];
  $user_id=$_POST['user_id'];
  $p_id=$_POST['p_id'];
  $no=$_POST['No'];


//  update
$stmt3 = mysqli_prepare($conn,"UPDATE appointment SET admin_status = ?,patient_status = ? WHERE No=?");
$admin_status="1";
$patient_status="1";
/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
  $stmt3->bind_param('ssi', $admin_status,$patient_status,$no);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */
/* Execute the prepared Statement */
  $status3 = $stmt3->execute();
/* BK: always check whether the execute() succeeded */

   if ($status3 === true) {

    // sent email for approve
 $to      = $email;
 $subject = 'Regarding the Appointment';
 $message = '<p> Dear '. $username.  '<br><br> Your Appointment request on '.$date. ' has <b> been changed as attended patient.</b> Please refer the appointment schedule for get more information. <br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
 
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







?>