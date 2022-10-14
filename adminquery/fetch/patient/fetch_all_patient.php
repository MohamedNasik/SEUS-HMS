<?php

session_start();

include ('../../../auth/dbconnection.php');

$columns= array('p_fname','p_lname','p_address','p_gender','dob','p_contact','dob');

$query = 'SELECT * FROM patients';

if(isset($_GET["search"]["value"])){

    $query .= '
    WHERE p_fname LIKE "%'.$_GET["search"]["value"].'%"
    OR  p_lname LIKE "%'.$_GET["search"]["value"].'%"
    OR  p_address LIKE "%'.$_GET["search"]["value"].'%"
    OR  p_gender LIKE "%'.$_GET["search"]["value"].'%"
    OR  dob LIKE "%'.$_GET["search"]["value"].'%"
    OR  p_contact LIKE "%'.$_GET["search"]["value"].'%"
    OR  dob LIKE "%'.$_GET["search"]["value"].'%"

    ';

}
if (isset($_GET["order"])) {

    $query .= ' ORDER BY '.$columns[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].'    ';
	// $stmt .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'    ';

}else{

    $query .= ' ORDER BY p_id DESC';
    // $stmt .= ' ORDER BY apt_id DESC';
}

//  $query1='';
$query1 = 'SELECT * FROM patients ORDER BY p_id DESC';



$stmtnew = $conn->prepare($query);
$number_filter_row= mysqli_num_rows(mysqli_query($conn,$query));
$number_total_row= mysqli_num_rows(mysqli_query($conn,$query1));

//$result =mysqli_query($conn,$stmtnew);

$stmtnew->execute();
$result = $stmtnew->get_result();

$data=array();

while($row = $result->fetch_assoc()) {
  
if($row["p_address"] == ''){  $address= 'Not Inserted'; }else{ $address  =$row["p_address"] ; }
if($row["p_contact"] == '0'){  $contact= 'Not Inserted'; }else{ $contact  =$row["p_contact"] ; }


    $sub_array =array();
    $sub_array[] =$row["p_id"];
    $sub_array[] =$row["p_fname"].' '.$row["p_lname"]; 
    $sub_array[] = $address;
    $sub_array[] = $row["p_gender"];
    $sub_array[] = $row["dob"];
    $sub_array[] = $contact;

    //  status badth change

   
      $sub_array[] ='<div class="dropdown dropdown-action">
    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
   
    <a class="dropdown-item" href="" data-toggle="modal" id="rep2" data_id= '.$row['p_id'].' data-target="#delete_user"><i class="fa fa-trash  m-r-5"></i> Delete</a>
    </div>
  </div>';

   // <a class="dropdown-item" href="edit-patient.php?pid='.$row['p_id'] .' "><i class="fa fa-edit m-r-5"></i> Edit</a>  
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