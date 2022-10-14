<?php

session_start();

include ('../../../auth/dbconnection.php');

$columns= array('apt_id','patient_name','type','apt_date','admin_status');

$query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id AND a.user_id='".$_SESSION['user_id']."' ";
$stmt = $conn->prepare("SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id  ORDER BY a.apt_date DESC");

if(isset($_GET["search"]["value"])){

    $query .= '
    AND ( apt_id LIKE "%'.$_GET["search"]["value"].'%"
    OR  patient_name LIKE "%'.$_GET["search"]["value"].'%"
    OR  type LIKE "%'.$_GET["search"]["value"].'%"
    OR  apt_date LIKE "%'.$_GET["search"]["value"].'%"
    OR  admin_status LIKE "%'.$_GET["search"]["value"].'%"


    )';

}
if (isset($_GET["order"])) {

    $query .= ' ORDER BY '.$columns[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].'    ';
	// $stmt .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'    ';

}else{

    $query .= ' ORDER BY apt_id DESC';
    // $stmt .= ' ORDER BY apt_id DESC';
}

// $query1='';
$query1 = "SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id  ORDER BY a.apt_date DESC";

$stmtnew = $conn->prepare($query);
$number_filter_row= mysqli_num_rows(mysqli_query($conn,$query));
$number_total_row= mysqli_num_rows(mysqli_query($conn,$query1));

//$result =mysqli_query($conn,$stmtnew);

$stmtnew->execute();
$result = $stmtnew->get_result();

$data=array();

while($row = $result->fetch_assoc()) {
  
    $sub_array =array();
    $sub_array[] =$row["apt_id"];
    $sub_array[] =$row["patient_name"] ;
    $sub_array[] =$row["type"] ;
    $sub_array[] = $row["apt_date"];

    //  status badth change
    if($row["admin_status"]=="0" && $row["patient_status"]=="0"  && $row["doctor_status"]=="3") {  
      $sub_array[] =' <span class="custom-badge status-red">Cancelled</span>';
       } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {    
          $sub_array[] =' <span class="custom-badge status-blue">Active</span>';
        } else if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {    
          $sub_array[] ='<span class="custom-badge status-orange">Not Attended</span>';
        } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="1") {    
          $sub_array[] ='<span class="custom-badge status-green">Discharged</span>';

       } 


$data[]=$sub_array;
}

$output= array(
    "draw"  => intval($_GET['draw']),
    "recordsTotal"  => $number_total_row,
    "recordsFiltered"  => $number_filter_row,
    "data"  => $data
    );

    echo json_encode($output);
?>  