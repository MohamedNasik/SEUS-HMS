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
   $remark= $jsondata1->dietadvice;
   $reconsult_date= $jsondata1->reconsult_date;
   $no= $jsondata1->no;

   $cur_date = date('Y-m-d H:i:s');

  //var_dump( $_POST['index1']);

    if($stmt = mysqli_prepare($conn,"INSERT INTO prescription (apt_id,user_id,p_id,investigations, med_records,remark,testing_details,reconsult_date,date,testing_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)")){

      $cur_date = date('Y-m-d H:i:s');

      $user_id= $_SESSION['user_id'];
      $testing_status="3";
     
        mysqli_stmt_bind_param($stmt, "ssssssssss",$apt,$user_id,$id,$investigations,$medical_records,$remark,$testing_records,$reconsult_date,$cur_date, $testing_status);

       echo "Records inserted successfully.";
 
} else{

  echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);


}


// $sql = "UPDATE appointment SET doctor_status =? WHERE apt_id =?";

// $stmt1 = $conn->prepare($sql);
// $apt_id = $apt;

// $doctor_status="1";

// This assumes the date and account_id parameters are integers `d` and the rest are strings `s`
// So that's 5 consecutive string params and then 4 integer params

// $stmt1->bind_param('si', $doctor_status,$apt_id);
// $stmt1->execute();

// if ($stmt1->error) {
//   echo "FAILURE!!! " . $stmt1->error;
// }
// else echo "Updated {$stmt1->affected_rows} rows";
// mysqli_stmt_execute($stmt1); 
// $stmt1->close();



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
 printf("%d Row inserted.\n", $stmt1->affected_rows);


mysqli_stmt_execute($stmt); 
mysqli_stmt_execute($stmt1); 

mysqli_stmt_close($stmt);

?>

