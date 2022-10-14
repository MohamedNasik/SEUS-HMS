<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=hmsproject", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  // echo "Connection failed: " . $e->getMessage();
}

$column= array('patient','type','Apt.date','Charge');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = " SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN doctor_specialist as u ON u.user_id=ap.user_id AND ap.user_id= '".$_SESSION['user_id']."'";





if(isset($_GET["search"]["value"])){

  $query .= '
  AND ( patient_name LIKE "%'.$_GET["search"]["value"].'%"
  OR  type LIKE "%'.$_GET["search"]["value"].'%"
  OR  ap.apt_date LIKE "%'.$_GET["search"]["value"].'%"
  OR  charge LIKE "%'.$_GET["search"]["value"].'%"
  )';

}

// if(isset($_GET['dates']))
// {
//  $query .= ' AND a.apt_date = "'.$_GET['dates'].'" ';
// }

// if(isset($_GET['doctor_name']))
// {
//  $query .= ' AND doctor_name  = "'.$_GET['doctor_name'].'" ';
// }


if(isset($_POST['order']))
{
 $query .= 'ORDER BY'.$column[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY opd_payment_id DESC ';
}

$query1 = '';

if($_GET["length"] != -1)
{
 $query1 = 'LIMIT ' . $_GET['start'] . ', ' . $_GET['length'];
}





$statement = $conn->prepare($query);


$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $conn->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();



$data = array();
$total_order = 0;

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['patient_name'];
 $sub_array[] = $row['type'];
 $sub_array[] = $row['apt_date'];
 $sub_array[] = $row['charge'];

 $total_order = $total_order + floatval($row["charge"]);

 $data[] = $sub_array;
}

function count_all_data($conn)
{
 $query = "SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
 INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN doctor_specialist as u ON u.user_id=ap.user_id AND ap.user_id= '".$_SESSION['user_id']."'";
 $statement = $conn->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_GET["draw"]),
 "recordsTotal"   =>  count_all_data($conn),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data,
 'total'    => number_format($total_order, 2)

);

echo json_encode($output);


?>  