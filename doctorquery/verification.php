<?php
        // Initialize the session
         session_start();
         date_default_timezone_set('Asia/Colombo');

         include "../auth/dbconnection.php";

         if (isset($_POST['mail'])) {

            $email = $_POST['mail'];

            $cur_date = date('Y-m-d H:i:s', time());
            $cur_date = strtotime($cur_date);
            $cur_date = date('Y-m-d H:i:s', $cur_date); 
          

            $stmt = $conn->prepare("SELECT * FROM patients as p INNER JOIN appointment as a ON p.p_id=a.p_id AND a.doctor_status='1' AND a.user_id= ? AND p.email=? GROUP by a.p_id");
            $stmt->bind_param("ss", $_SESSION['user_id'],$email);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                while($row = $result->fetch_assoc()) {
              $specilization= $row["specilization"];
               $date= $row["apt_date"];
               $p_id= $row["p_id"];
               $_SESSION['pids']=$p_id;

                $otp= rand(100000,999999);

                $to      = $email;
                $subject = 'Regarding the Prescription edit by';
                $message = '<p> The doctor ('.$specilization.') who trying to edit your prescription. The OTP message is '.$otp.'. If it yours, please give the OTP to your doctor.</b> </b> Appointment Date: '.$date. '</b>  <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals </i></b> </br>';
                
               $headers = 'From: seus@gmail.com' . "\r\n" ;
               $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
               $headers .= "MIME-Version: 1.0\r\n";
               $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
              $send= mail($to, $subject, $message, $headers);

              if($send === true){
                $expiry="1";

                $stmt1 = $conn->prepare("INSERT INTO otp (user_id, p_id, otp, expiry,created) VALUES (?, ?, ?, ?, ?)");
                $stmt1->bind_param("sssss", $_SESSION['user_id'], $p_id, $otp,$expiry,$cur_date);
                $stmt1->execute();

                echo $_SESSION['pids'];

              }else{

                echo 'send fail';

              }

                }

            }else{

           echo 'fail';

            }

         }
            ?>