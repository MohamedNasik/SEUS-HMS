<?php

session_start();
require_once "../auth/dbconnection.php";

//$testings= $_POST["testings"];



$id = $_POST["id"];

// $lab_status = "1";
// $patient_status = "1";



$sql= "SELECT pres_id, COUNT( pres_id ) as votes_count FROM testing_schedule  WHERE pres_id= $id";
$result = $conn->query($sql);
$rad = $result->fetch_assoc();
 $rad['votes_count'];

$sql1= "SELECT lab_status, COUNT( lab_status ) as counts FROM testing_schedule  WHERE pres_id= $id AND lab_status='1'";
$result1 = $conn->query($sql1);
$rad1 = $result1->fetch_assoc();
  $rad1['counts'];

  

if($rad1['counts'] == $rad['votes_count']){  


  $sql = "UPDATE testing_schedule SET update_status =? WHERE pres_id =?";

  $stmt = $conn->prepare($sql);
  
  // This assumes the date and account_id parameters are integers `d` and the rest are strings `s`
  // So that's 5 consecutive string params and then 4 integer params
  $status="1";
  $stmt->bind_param('ss',$status , $_POST["id"]);
  $stmt->execute();
  
  if ($stmt->error) {
    echo "FAILURE!!!" . $stmt->error;
  }
  else echo 'Success';
  
  $stmt->close();


}

?>

