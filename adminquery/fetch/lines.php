<?php

session_start();

require_once '../../auth/dbconnection.php';
header('Content-Type: application/json');

// line graph js

$stmt = $conn->prepare("SELECT decease_name, DATE_FORMAT(date, '%M') as dates, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need' AND date BETWEEN ADDDATE(NOW(),-365) AND NOW()  group by decease_name , DATE_FORMAT(date, '%M')");

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