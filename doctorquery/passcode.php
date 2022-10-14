<?php
        // Initialize the session
         session_start();

         include "../auth/dbconnection.php";

         if (isset($_POST['passcode'])) {

            $passcode = md5($_POST['passcode']);


            
            if ($stmt = mysqli_prepare($conn, "SELECT p_id,p_fname,p_lname,password FROM patients WHERE email=? AND password =? ")) {
                $email = $_POST['mail'];
                $passcode = $passcode;
                mysqli_stmt_bind_param($stmt, "ss",$email, $passcode);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt,$p_id,$p_fname,$p_lname,$password);
    
                mysqli_stmt_fetch($stmt);
                $username=$p_fname.' '.$p_lname;
                if(  $passcode  == $password && $p_id == $_POST['ids'] ){
                   
                    $_SESSION['p_id']=$p_id;
                    $_SESSION['patientname']=$username;


                    echo 'Ok'; 
                    
                  }else {
                    echo 'error';
                }


                mysqli_stmt_close($stmt);


            }else {
                echo 'Something went wrong';
            }


        }



        ?>
