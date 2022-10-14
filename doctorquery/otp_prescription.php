<?php
        // Initialize the session
         session_start();

         include "../auth/dbconnection.php";

         if (isset($_POST['passcode'])) {

            $passcode = $_POST['passcode'];
            $pres_id = $_POST['pres_id'];


            $cur_date =date("Y-m-d");
     
            $stmt = $conn->prepare("SELECT * FROM prescription_otp WHERE otp=? AND user_id=? AND p_id=? AND pres_id=?  AND DATE_FORMAT(created,'%Y-%m-%d')  = ? AND expiry='1' AND otp_id=(SELECT MAX(otp_id) FROM prescription_otp) ");
            $stmt->bind_param("sssss",$passcode,$_SESSION['user_id'],$_SESSION['p_id'],$pres_id,$cur_date );
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                while($row = $result->fetch_assoc()) {
              $p_id=$row["p_id"];
              $otp=$row["otp_id"];
              $expiry="0";
//  update
 $stmt3 = mysqli_prepare($conn,"UPDATE prescription_otp SET expiry =? WHERE otp_id =?");

 /* Bind our params */
 /* BK: variables must be bound in the same order as the params in your SQL.
  * Some people prefer PDO because it supports named parameter. */
   $stmt3->bind_param('ss', $expiry,$otp);
 
 /* Set our params */
 /* BK: No need to use escaping when using parameters, in fact, you must not, 
  * because you'll get literal '\' characters in your content. */
 
 /* Execute the prepared Statement */
   $status3 = $stmt3->execute();
 /* BK: always check whether the execute() succeeded */

//  unset($_SESSION['pids']);
//  $_SESSION['p_id']=$p_id;


 echo 'Success';


                } 
            
            }else{
                echo 'Wrong OTP';
            }


            }else {
                echo 'Something went wrong';
            }

            mysqli_stmt_close($stmt);

        



        ?>
