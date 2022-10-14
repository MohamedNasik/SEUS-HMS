<?php

session_start();
require_once "../auth/dbconnection.php";

// if (isset(json_decode($_POST["data"])) {


  $medical_records = $_POST["index1"];
  $jsondata1 = json_decode($_POST["index2"]);
  $testing_records = $_POST["index3"];
  $investigations = $_POST["index4"];


   $id= $jsondata1->getpid;
   $apt= $jsondata1->getapt;
   $decease= $jsondata1->decease;
   $remark= $jsondata1->dietadvice;
   $reconsult_date= $jsondata1->reconsult_date;
   $cur_date = date('Y-m-d H:i:s');
   $no= $jsondata1->no;


  //  try catch 

   try {

    if($stmt = mysqli_prepare($conn,"INSERT INTO prescription (apt_id,user_id,p_id,investigations, med_records,decease_name,remark,testing_details,reconsult_date,date,testing_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)")){

      $cur_date = date('Y-m-d H:i:s');
      $user_id= $_SESSION['user_id'];
      $testing_status="3";
     
        mysqli_stmt_bind_param($stmt, "sssssssssss",$apt,$user_id,$id,$investigations,$medical_records,  $decease,$remark,$testing_records,$reconsult_date,$cur_date, $testing_status);
 
} else{

  echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}

$stmt1 = mysqli_prepare($conn,"UPDATE appointment SET doctor_status =? WHERE No =?");
$apt_id = $apt;

$doctor_status="1";
/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
 $stmt1->bind_param('ss', $doctor_status,$no);

/* Set our params */
/* BK: No need to use escaping when using parameters, in fact, you must not, 
 * because you'll get literal '\' characters in your content. */

/* Execute the prepared Statement */
 $status = $stmt1->execute();
/* BK: always check whether the execute() succeeded */
 if ($status === false) {
   trigger_error($stmt1->error, E_USER_ERROR);
 }

mysqli_stmt_execute($stmt); 
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
mysqli_stmt_close($stmt);

  




?>

