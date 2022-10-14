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

$column= array('opd_payment_id','patient_name','doctor_name','ds.specilization','opd.apt_date','charge','charge');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = " SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctor_specialist as ds ON opd.doc_spec_id = ds.doc_spec_id";




if(isset($_POST["search"]["value"])){

  $query .= '
  AND ( opd_payment_id LIKE "%'.$_POST["search"]["value"].'%"
  OR  ap.patient_name LIKE "%'.$_POST["search"]["value"].'%"
  OR  doctor_name LIKE "%'.$_POST["search"]["value"].'%"
  OR  ds.specilization LIKE "%'.$_POST["search"]["value"].'%"
  OR  opd.apt_date LIKE "%'.$_POST["search"]["value"].'%"
  OR  charge LIKE "%'.$_POST["search"]["value"].'%"
  OR  charge LIKE "%'.$_POST["search"]["value"].'%"

  )';

}

if(isset($_POST['dates']))
{
 $query .= ' AND opd.apt_date = "'.$_POST['dates'].'" ';
}

// if(isset($_GET['doctor_name']))
// {
//  $query .= ' AND doctor_name  = "'.$_GET['doctor_name'].'" ';
// }


if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY opd_payment_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
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
 $sub_array[] =   '<a href="view_opd_payment.php?opd_id='. $row["opd_payment_id"] .' &pid= '.  $row["p_id"] .' &username='.$row["doctor_name"].' &fees= '.$row["charge"] .' &aptid='.$row["apt_id"] .'&date='.$row["apt_date"] .'&status='.$row["status"] .'&p_name='.$row["patient_name"] .'&spec='.$row["specilization"] .'&type='.$row["type"] .' "> '.$row["opd_payment_id"]  .' </a>'   ;   
 $sub_array[] = $row['patient_name'];
 $sub_array[] = $row['doctor_name'];
 $sub_array[] = $row['specilization'];
 $sub_array[] = $row['apt_date'];
 $sub_array[] = $row['charge'];

 $sub_array[] = '<div class="dropdown dropdown-action">
 <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
     aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
 <div class="dropdown-menu dropdown-menu-right">
     <a class="dropdown-item" href="view_opd_payment.php?opd_id='. $row["opd_payment_id"] .' &pid= '.  $row["p_id"] .' &username='.$row["doctor_name"].' &fees= '.$row["charge"] .' &aptid='.$row["apt_id"] .'&date='.$row["apt_date"] .'&status='.$row["status"] .'&p_name='.$row["patient_name"] .'&spec='.$row["specilization"] .'&type='.$row["type"] .'  "><i class="fa fa-eye m-r-5"></i> View</a>

 </div>
</div>';



 $total_order = $total_order + floatval($row["charge"]);

 $data[] = $sub_array;
}

function count_all_data($conn)
{
 $query = "SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctor_specialist as ds ON opd.doc_spec_id = ds.doc_spec_id";
 $statement = $conn->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($conn),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data,
 'total'    => number_format($total_order, 2)

);

echo json_encode($output);


?>  