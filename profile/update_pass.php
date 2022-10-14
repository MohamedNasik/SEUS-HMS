<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['newpass'])) {

    $new_pass=$_POST['newpass']; // new password
    $cur_pass=$_POST['curpass']; // current password

    $temp_password = md5($cur_pass); // current password md5

   //i dont see your password colom name, so i guess it password
   $stmt = $conn->prepare("SELECT password FROM users WHERE user_id =? ");
   $stmt->bind_param("s",$_SESSION['user_id'] );
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0);
   while($row = $result->fetch_assoc()) {
   $db = $row['password'];

   }

    if(  $temp_password == $db )
    {

        $new_password = md5($new_pass);

        try {
            $stmt1 = $conn->prepare("UPDATE users SET password = ? WHERE user_id= ?");
            $stmt1->bind_param("si", $new_password, $_SESSION['user_id']);
            $status = $stmt1->execute();
    
            
            if ($status === true) {
                echo 'Password Changed';
            } else {
                throw new Exception('cant change');
            }
        } catch (Exception $exc) {   
            //handle any errors in your code, including connection issues
            echo "ERROR: Could not prepare query: $stmt1. " . mysqli_error($conn);
            //this will be your "flag" to handle on the client side
            //and if you want, can also log the error with 
            //$exc->getMessage() or $exc->getTraceAsString()
          
        }

    }
    else{
echo 'Password do not match';

    }

}

?>