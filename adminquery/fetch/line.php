<?php

session_start();

require_once '../../auth/dbconnection.php';
header('Content-Type: application/json');

// line graph js

$stmt = $conn->prepare("SELECT MONTHNAME(apt_date) as apt_date, count(apt_id) as Consultation
from appointment WHERE doctor_status='1' GROUP by MONTH(apt_date) LIMIT 12 ");
// DATE_FORMAT(`date`,'%M %Y')
$stmt->execute();
$result = $stmt->get_result();

//loop through the returned data
$data = array();
foreach ($result as $row) {
$data[] = $row;

}
echo  json_encode($data);


?>