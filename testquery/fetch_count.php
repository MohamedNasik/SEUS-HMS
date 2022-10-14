<?php

session_start();
require_once "../auth/dbconnection.php";
header('Content-Type: application/json');

if(isset($_POST['id'])){


$stmt = $conn->prepare("SELECT * FROM testing_report WHERE testing_report_id = ? AND test_id='1' ");
$stmt->bind_param("s",$_POST['id'] );
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0);
while($row = $result->fetch_assoc()) {
  
  //$data["presid"]= $row['pres_id'];


  $data = [];
  $data["remark"]=$row['remark'] ;

  $medRecords = json_decode($row['testing_results'],true);
  if (is_array($medRecords) || is_object($medRecords)) {
    $medRecords = array_merge(...$medRecords);

      
      $data["WBC"]= $medRecords['WBC'] ?? 0;
      $data["lymph"]=$medRecords['lymph'] ?? 0;
      $data["Mid"]=$medRecords['Mid'] ?? 0;
      $data["Gran"]=$medRecords['Gran'] ?? 0;
      $data["Limp"]=$medRecords['Limp'] ?? 0;
      $data["Mids"]=$medRecords['Mids'] ?? 0;
      //$data["Grans"]=$medRecords['Grans'] ?? 0;
      $data["RBCB"]=$medRecords['RBCB'] ?? 0;
      $data["HGB"]=$medRecords['HGB'] ?? 0;
      $data["HCT"]=$medRecords['HCT'] ?? 0;
      $data["MCV"]=$medRecords['MCV'] ?? 0;
      $data["MCH"]=$medRecords['MCH'] ?? 0;
      $data["MCHC"]=$medRecords['MCHC'] ?? 0;
      $data["RDW"]=$medRecords['RDW'] ?? 0;


    
  }

}


echo json_encode($data);
}

?>
