<?php

session_start();

include ('../../auth/dbconnection.php');

$columns= array('med_id','medicine_name','type','description','description');

$query = "SELECT * FROM medicines";

if(isset($_GET["search"]["value"])){

    $query .= '
    WHERE  med_id LIKE "%'.$_GET["search"]["value"].'%"
    OR  medicine_name LIKE "%'.$_GET["search"]["value"].'%"
    OR  type LIKE "%'.$_GET["search"]["value"].'%"
    OR  description LIKE "%'.$_GET["search"]["value"].'%"
    OR  description LIKE "%'.$_GET["search"]["value"].'%" ';

}
if (isset($_GET["order"])) {

    $query .= ' ORDER BY '.$columns[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].'    ';

}else{

    $query .= ' ORDER BY med_id DESC';
    // $stmt .= ' ORDER BY apt_id DESC';
}

// $query1='';
$query1 = "SELECT * FROM medicines ORDER BY med_id DESC";

$stmtnew = $conn->prepare($query);
$number_filter_row= mysqli_num_rows(mysqli_query($conn,$query));
$number_total_row= mysqli_num_rows(mysqli_query($conn,$query1));

//$result =mysqli_query($conn,$stmtnew);

$stmtnew->execute();
$result = $stmtnew->get_result();

$data=array();

while($row = $result->fetch_assoc()) {
  
    $sub_array =array();
    $sub_array[] =$row["med_id"];
    $sub_array[] =$row["medicine_name"];
    $sub_array[] =$row["type"];
    $sub_array[] =$row["description"] ;

    $sub_array[] ='<td class="text-right">
    <div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="edit-medicine.php?did='.$row['med_id'].'" data-id='.$row['med_id'].' ><i class="fa fa-pencil m-r-5"></i> Edit</a>
         
        </div>
    </div>
</td>';



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