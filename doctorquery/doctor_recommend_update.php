<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";


if (isset($_POST['recommed_id'])) {

  $stmt = $conn->prepare("SELECT * FROM doctor_specialist WHERE doctor_name=? ");
  $stmt->bind_param("s",$_POST["doctor_name"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
    
      $user_id = $row['user_id'];

    }
}


$stmt = mysqli_prepare($conn,"UPDATE doctor_recommend SET user_id =? , specilization=? ,  p_id=?, description = ?  WHERE doctor_recommend_id=? ");

$doctor_name=$_POST["doctor_name"];   
$specilization=$_POST["specilization"];
$p_id=$_POST["p_id"];
$doc_description=$_POST["doc_description"];
$recommed_id=$_POST["recommed_id"];

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
 $stmt->bind_param("sssss",$user_id,$specilization,$p_id,$doc_description,$recommed_id);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
 $status = $stmt->execute();
/* BK: always check whether the execute() succeeded */

 echo $doctor_name;


 if ($status === false) {
    trigger_error($stmt->error, E_USER_ERROR);
  }

mysqli_stmt_execute($stmt); 
mysqli_stmt_close($stmt);



}





?>



