<?php
require_once '../auth/dbconnection.php';

date_default_timezone_set('Asia/Colombo');

if (isset($_POST['email'])) {

    $email=$_POST['email'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? ");
$stmt->bind_param("s",$_POST['email']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_array($result)){

    if($stmt = mysqli_prepare($conn,"INSERT INTO temp_password (person_id,email,active_code,expire,created) VALUES (?, ?, ?, ? , ?)")){

    
        $active_code=md5(uniqid(rand(3, 5), true));
        $expire="1";
        $person_id = $row['user_id'];

        $cur_date = date('Y-m-d H:i:s', time());
        $cur_date = strtotime($cur_date);
        $cur_date = date('Y-m-d H:i:s', $cur_date); 

        mysqli_stmt_bind_param($stmt, "sssss",$person_id,$email,$active_code,$expire,$cur_date);
        // echo "Successfully saved";
        mysqli_stmt_execute($stmt);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}

}
    // sent email
    $token = 'http://localhost/Hospital/adminpanel/activation.php?email='.$email.'&personid='.$person_id.'  ';

    $to      = $email;
    $subject = 'Change the Password';
    $message = '<p> The request you to change the password is successfull. Click the below link and insert the correct activation code on it. '.$token.'.  The activation code is below.  <b> '.$active_code.'  </b> Please use this activation code to change the password. <br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals Administration </i></b> </br>';
    
   $headers = 'From: seus@gmail.com' . "\r\n" ;
   $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
   
    mail($to, $subject, $message, $headers);

echo 'Password Sent';
    

} else{

echo 'No email Found. Try it by correct email';

}

}

$conn->close(); 

?>