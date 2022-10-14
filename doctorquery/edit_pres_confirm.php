<?php
        // Initialize the session
         session_start();
         date_default_timezone_set('Asia/Colombo');

              // $_SESSION['p_id'];


         include "../auth/dbconnection.php";

         if (isset($_POST['pres_id'])) {

          $pres_id = $_POST['pres_id'];
          $p_id = $_POST['p_id'];
          $user_id = $_POST['user_id'];
          $date = $_POST['date'];
          $apt_id = $_POST['apt_id'];


            $cur_date = date('Y-m-d H:i:s', time());
            $cur_date = strtotime($cur_date);
            $cur_date = date('Y-m-d H:i:s', $cur_date); 
          

            $stmt = $conn->prepare("SELECT * FROM patients WHERE p_id=?");
            $stmt->bind_param("s",$p_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                while($row = $result->fetch_assoc()) {
              $email= $row["email"];

                $otp= rand(100000,999999);

                $to      = $email;
                $subject = 'Prescription edit ('.$pres_id.')';
                $message = '<p> The doctor wants to edit your prescription. The prescription Number is <b> '.$pres_id.' </b> . The OTP message is '.$otp.'. If it confirms, please give the OTP to your doctor.</b> <br> Appointment ID:'.$apt_id. ' <br> Appointment Date: '.$date. '</b>  <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
                
               $headers = 'From: seus@gmail.com' . "\r\n" ;
               $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
               $headers .= "MIME-Version: 1.0\r\n";
               $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
              $send= mail($to, $subject, $message, $headers);

              if($send === true){
                $expiry="1";

                $stmt1 = $conn->prepare("INSERT INTO prescription_otp (user_id, p_id, otp,pres_id, expiry,created) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt1->bind_param("ssssss", $_SESSION['user_id'], $p_id, $otp, $pres_id,$expiry,$cur_date);
                $stmt1->execute();

                echo 'Success';

              }else{


                echo 'send fail';

              }

                }

            }else{

           echo 'fail';

            }

         }
            ?>