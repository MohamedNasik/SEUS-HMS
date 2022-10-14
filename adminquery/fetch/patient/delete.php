<?php

require_once '../../../auth/dbconnection.php';

$stmt = $conn->prepare("DELETE FROM patients WHERE p_id = ?");
$stmt->bind_param("s",$_POST["data_id"]);
$stmt->execute();
$stmt->close();


?>