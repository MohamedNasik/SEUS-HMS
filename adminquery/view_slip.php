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

$column= array('opd_payment_id','ap.apt_id','patient_name','doctor_name','ds.specilization','type','charge','opd.apt_date','status','type');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = " SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN doctor_specialist as u ON u.user_id=ap.user_id ";


if(isset($_GET["search"]["value"])){

  $query .= '
  AND ( opd_payment_id LIKE "%'.$_GET["search"]["value"].'%"
  OR  ap.apt_id LIKE "%'.$_GET["search"]["value"].'%"
  OR  ap.patient_name LIKE "%'.$_GET["search"]["value"].'%"
  OR  doctor_name LIKE "%'.$_GET["search"]["value"].'%"
  OR  ds.specilization LIKE "%'.$_GET["search"]["value"].'%"
  OR  opd.apt_date LIKE "%'.$_GET["search"]["value"].'%"
  OR  charge LIKE "%'.$_GET["search"]["value"].'%"
  OR  status LIKE "%'.$_GET["search"]["value"].'%"
  OR  type LIKE "%'.$_GET["search"]["value"].'%"

  )';

}




if(isset($_GET['order']))
{
 $query .= 'ORDER BY '.$column[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].' ';
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
 $sub_array[] =   '<a href="view_opd_payment.php?opd_id='. $row["opd_payment_id"] .' &pid= '.  $row["p_id"] .' &username='.$row["doctor_name"].' &fees= '.$row["charge"] .' &aptid='.$row["apt_id"] .'&date='.$row["apt_date"] .'&status='.$row["status"] .'&p_name='.$row["patient_name"] .'&spec='.$row["specilization"] .'&type='.$row["type"] .' "> '.$row["opd_payment_id"]  .' </a>'   ;   
 $sub_array[] = $row['apt_id'];

 $sub_array[] = $row['patient_name'];
 $sub_array[] = $row['doctor_name'];
 $sub_array[] = $row['specilization'];
 $sub_array[] = $row['type'];

 $sub_array[] = $row['charge'];
 $sub_array[] = $row['apt_date'];


 if($row['status']=="0") {  
  $sub_array[] = ' <td> <span class="custom-badge status-red">Cancelled</span> </d>';
} else if($row['status']=="1") {    
  $sub_array[] = ' <td> <span class="custom-badge status-green">Paid</span> </td>';
  } else if($row['status']=="2") { 
      
    $sub_array[] = ' <td>  <span class="custom-badge status-grey">Refunded</span> </td>';
  } else if($row['status']=="4") { 
    $sub_array[] = ' <td>  <span class="custom-badge status-orange">No Need</span> </td>';

    } else{

      $sub_array[] = ' <td>  <span class="custom-badge status-blue">Pending</span> </td>';


    }
    $name= $row["doctor_name"]  ;
    $date=   date('dS F Y', strtotime($row['date']));


    if($row['status']=="3") {  
$sub_array[] = '<div class="dropdown dropdown-action">
<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="view_payment.php?opd_id='.$row["opd_payment_id"].' &username='.$name.'&spec='.$row["specilization"].'&fees='.$row["fees"].'&apt_id='.$row["apt_id"].'&pid='.$row["p_id"].'&date='.$date.'&status='.$row["status"].'&type='.$row['type'].'&user_id='.$row['user_id'].'&no='.$row['No'].'&type='.$row["type"] .' " ><i
class="fa fa-money  m-r-5"></i> Pay</a>';
    } else if($row['doctor_status']=="1" && $row['patient_status']=="1" && $row['admin_status']=="1" ) {    

      $sub_array[] = '<div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#" ><i
      class="fa fa-user  m-r-5"></i> Completed :-)</a>';

    }   else if($row['status']=="1") {    
      $sub_array[] = '<div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="view_payment.php?opd_id='.$row["opd_payment_id"].' &username='.$name.'&spec='.$row["specilization"].'&fees='.$row["fees"].'&apt_id='.$row["apt_id"].'&pid='.$row["p_id"].'&date='.$date.'&status='.$row["status"].'&type='.$row['type'].'&user_id='.$row['user_id'].'&no='.$row['No'].'&type='.$row["type"] .'  " ><i
      class="fa fa-money  m-r-5"></i> Refund</a>';

    } else if($row['status']=="2"  && $row['admin_status']=="1"  ) {    

      $sub_array[] = '<div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
      aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
  <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" ><i
  class="fa fa-money  m-r-5"></i> Cant proceed</a>';

    } else if($row['status']=="2" && $row['admin_status']=="0"  ) {    
      $sub_array[] = ' <div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" ><i
      class="fa fa-money  m-r-5"></i> Cant proceed</a>';

    } else if($row['status']=="4" && $row['admin_status']=="1"  ) {    
      $sub_array[] = ' <div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
          aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" ><i
      class="fa fa-money  m-r-5"></i> Cant proceed</a>';
    }
      else if($row['status']=="0" && $row['patient_status']=="0" && $row['admin_status']=="0" ) {    
        $sub_array[] = ' <div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href="#" ><i
        class="fa fa-money  m-r-5"></i> Cant proceed</a>';

      }

    if($row["status"]== '1'){

      $total_order = $total_order + floatval($row["charge"]);

     }  //else if($row["status"]== '2'){
      
//  $total_orders = $total_order - floatval($row["charge"]);
//     }

 $data[] = $sub_array;
}

function count_all_data($conn)
{
 $query = "SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.No=ap.No INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
 INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN doctor_specialist as u ON u.user_id=ap.user_id ";
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