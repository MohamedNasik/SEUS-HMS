


<?php

session_start();
require_once "../auth/dbconnection.php";
header('Content-Type: application/json');



if(isset($_POST['id'])){


$stmt = $conn->prepare("SELECT * FROM testing_report WHERE testing_report_id = ? AND test_id='2' ");
$stmt->bind_param("s",$_POST['id'] );
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0);
while($row = $result->fetch_assoc()) {
  

  $data = [];
  $data["remark"]=$row['remark'] ;

  $medRecords = json_decode($row['testing_results'],true);
  if (is_array($medRecords) || is_object($medRecords)) {
    $medRecords = array_merge(...$medRecords);

    $data["colour"]= $medRecords['colour'] ?? 0;

      $data["apprearance"]= $medRecords['apprearance'] ?? 0;
      $data["sg"]=$medRecords['sg'] ?? 0;
      $data["ph"]=$medRecords['ph'] ?? 0;
      $data["protien"]=$medRecords['protien'] ?? 0;
      $data["glucose"]=$medRecords['glucose'] ?? 0;
      $data["ketone"]=$medRecords['ketone'] ?? 0;
      //$data["Grans"]=$medRecords['Grans'] ?? 0;
      $data["bilirubin"]=$medRecords['bilirubin'] ?? 0;
      $data["uro"]=$medRecords['uro'] ?? 0;
      $data["pus"]=$medRecords['pus'] ?? 0;
      $data["red"]=$medRecords['red'] ?? 0;
      $data["epith"]=$medRecords['epith'] ?? 0;
      $data["casts"]=$medRecords['casts'] ?? 0;
      $data["crystal"]=$medRecords['crystal'] ?? 0;


    
  }

}


echo json_encode($data);
}

?>
