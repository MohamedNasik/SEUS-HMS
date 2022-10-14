<?php
        // Initialize the session
         session_start();

         include "../auth/dbconnection.php";

         if (isset($_POST['passcode'])) {

            $cur_date =date("Y-m-d");
            $email=$_POST['mail'];
            $passcode=$_POST['passcode'];
            $person=$_POST['person'];

            $stmt = $conn->prepare("SELECT * FROM temp_password WHERE active_code=? AND email=? AND person_id = ? AND DATE_FORMAT(created,'%Y-%m-%d')  = ? AND expire='1' AND temp_password_id=(SELECT MAX(temp_password_id) FROM temp_password)");
            $stmt->bind_param("ssss",$passcode,$email,$person,$cur_date);
            $stmt->execute();
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                while($row = $result->fetch_assoc()) {
              $active_code=$row["active_code"];
              $temp_password_id=$row["temp_password_id"];
              $expiry="0";

                if($passcode  == $active_code){
    
//  update
$stmt3 = mysqli_prepare($conn,"UPDATE temp_password SET expire =? WHERE temp_password_id =?");

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
  $stmt3->bind_param('ss', $expiry,$temp_password_id);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
  $status3 = $stmt3->execute();


  echo 'Success';

                  }else {
                    echo 'Wrong Activation code';
                    }

                }

            }else{

                echo 'Wrong Activation code';

            }






       


        }else{

            echo 'Something went wrong';

        }

        mysqli_stmt_close($stmt);


        ?>


