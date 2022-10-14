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

$column= array('ti.test_payment_id','p_fname','payment_date','payment_date');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = "SELECT * FROM test_payments as tp INNER JOIN test_invoices as ti ON tp.test_payment_id=ti.test_payment_id INNER JOIN patients as p ON p.p_id=ti.p_id";



if(isset($_GET["search"]["value"])){

  $query .= '
  AND ( ti.test_payment_id LIKE "%'.$_GET["search"]["value"].'%"
  OR  p_fname LIKE "%'.$_GET["search"]["value"].'%"
  OR  payment_date LIKE "%'.$_GET["search"]["value"].'%"
  OR  payment_date LIKE "%'.$_GET["search"]["value"].'%"

  )';

}

if(isset($_GET['startdate']) && isset($_GET['enddate']))
{
 $query .= ' AND (payment_date BETWEEN  "'.$_GET['startdate'].'" AND "'.$_GET['enddate'].'") ';
}




if(isset($_GET['order']))
{
 $query .= 'ORDER BY '.$column[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY ti.test_payment_id DESC ';
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

foreach($result as $row)
{
  $sub_array = array();
  $sub_array[] = '<a href="view_test_payment.php?test_payment_id='. $row["test_payment_id"]  .'&pid='. $row["p_id"].'&username='. $row["p_fname"].' '.$row["p_lname"].'  ">'. $row["test_payment_id"] .'</a>';
  $sub_array[] = $row['p_fname'].' '.$row['p_lname'];
  $sub_array[] = $row['payment_date'];
 
  $sub_array[] = '<div class="dropdown dropdown-action">
  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
      aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
  <div class="dropdown-menu dropdown-menu-right">
      <a class="dropdown-item"
          href="view_test_payment.php?test_payment_id='. $row["test_payment_id"] .'&pid='.  $row["p_id"] .'&username='.  $row["p_fname"].' '.$row["p_lname"]   .'">
           <i class="fa fa-eye m-r-5"></i> View</a>
      <!-- <a class="dropdown-item" href="#"><i
              class="fa fa-file-pdf-o m-r-5"></i> Download</a> -->
  </div>
</div>';



 $data[] = $sub_array;
}

function count_all_data($conn)
{
  $query = "SELECT * FROM test_payments as tp INNER JOIN test_invoices as ti ON tp.test_payment_id=ti.test_payment_id INNER JOIN patients as p ON p.p_id=ti.p_id";
  $statement = $conn->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_GET["draw"]),
 "recordsTotal"   =>  count_all_data($conn),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);


?>  