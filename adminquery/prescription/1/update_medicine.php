<?php

session_start();
require_once "../../../auth/dbconnection.php";

  $jsondata1 = json_decode($_POST["index2"]);
  $medical_records = $_POST["index1"];


  $id= $jsondata1->getpid;
  $apt= $jsondata1->getapt;
  $dietadvice= $jsondata1->dietadvice;
  $pres_id= $jsondata1->pres_id;

  //  try catch 

   try {

$stmt1 = mysqli_prepare($conn,"UPDATE prescription SET med_records =? , remark=?  WHERE pres_id=?");

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
$stmt1->bind_param("sss",$medical_records, $dietadvice,$pres_id);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
 $status = $stmt1->execute();
/* BK: always check whether the execute() succeeded */
 if ($status === false) {
   trigger_error($stmt1->error, E_USER_ERROR);
 }

mysqli_stmt_execute($stmt1); 


    if ($status === true) {
        echo 'Saved';

    } else {
        throw new Exception('cant');
    }

} catch (Exception $exc) {   
    //handle any errors in your code, including connection issues
    echo "ERROR: Could not prepare query: $stmt1. " . mysqli_error($conn);
    //this will be your "flag" to handle on the client side
    //and if you want, can also log the error with 
    //$exc->getMessage() or $exc->getTraceAsString()
    
  
}
mysqli_stmt_close($stmt1);

  




?>

