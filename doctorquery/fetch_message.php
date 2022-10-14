<?php

session_start();
// Include config file
require_once "../auth/dbconnection.php";

if (isset($_POST['id'])) {

    $stmt = $conn->prepare("SELECT * FROM doctor_recommend WHERE doctor_recommend_id=? ");
    $stmt->bind_param("s",$_POST["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
    
      $description = $row['description'];

    }

echo $description;


}else{


echo 'Not Found';

}

}
?>