<?php

session_start();

include ('../../../auth/dbconnection.php');

$columns= array('apt_id','fname','specilization','patient_name','type','apt_date','admin_status','Change','Action');

$query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id AND a.apt_date=curdate()";
$stmt = $conn->prepare("SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id  ORDER BY a.apt_id DESC");

if(isset($_GET["search"]["value"])){

    $query .= '
    AND ( apt_id LIKE "%'.$_GET["search"]["value"].'%"
    OR  fname LIKE "%'.$_GET["search"]["value"].'%"
    OR  specilization LIKE "%'.$_GET["search"]["value"].'%"
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

    $query .= ' ORDER BY No DESC';
    // $stmt .= ' ORDER BY apt_id DESC';
}

// $query1='';
$query1 = "SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id  ORDER BY a.apt_id DESC";



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
    $sub_array[] =$row["fname"].' '.$row["lname"]  ;
    $sub_array[] =$row["specilization"] ;
    $sub_array[] =$row["patient_name"] ;
    $sub_array[] =$row["type"] ;
    $sub_array[] = $row["apt_date"];


$name= $row["fname"].' '.$row["lname"]  ;


    //  status badth change
    if($row["admin_status"]=="0" && $row["patient_status"]=="0"  && $row["doctor_status"]=="3") {  
      $sub_array[] =' <span class="custom-badge status-red">Cancelled</span>';
       } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {    
          $sub_array[] =' <span class="custom-badge status-green">Active</span>';
        } else if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {    
          $sub_array[] ='<span class="custom-badge status-orange">Not Attended</span>';
        } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="1") {    
          $sub_array[] ='<span class="custom-badge status-green">Discharged</span>';

       } 

        //  change button
         if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {  
         $sub_array[] = '<button class="btn btn-success custom-badge status-green check" value="Submit"  onclick="(this.id)" data-toggle="modal" id="rep1" data_id= '.$row['apt_id'].' data_id1= '.$row['p_id'].'  data_id2= '.$row['apt_date'].' user_id= '.$row['user_id'].'  No= '.$row['No'].'  data-target="#active_appointment"  >   Active  </button> ';
         }else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {   
          $sub_array[] = '<button class="btn btn-danger custom-badge status-red check" value="Submit"  onclick="(this.id)"  data-toggle="modal" id="rep2" data_id= '.$row['apt_id'].' data_id1= '.$row['p_id'].'  data_id2= '.$row['apt_date'].'  user_id= '.$row['user_id'].'  No= '.$row['No'].' data-target="#delete_appointment">   Cancel  </button> ';
          }else if($row["admin_status"]=="0" && $row["patient_status"]=="0"  && $row["doctor_status"]=="3") {   
            $sub_array[] = '<span class="custom-badge status-red">Cancelled</span> ';
          }else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="1") {   
            $sub_array[] = '<span class="custom-badge status-green">Completed</span>';
          }

//   action button starts

          if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {  
            $sub_array[] ='<div class="dropdown dropdown-action">
          <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="fa fa-money m-r-5"></i> Not Attended</a>
          </div>
        </div>';

      }else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {   
        $sub_array[] ='<div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="payment.php?pid='.$row['p_id'] .'&userid='. $row['user_id'].'&special='. $row['specilization'].' &name='. $name .'&pname='. $row['patient_name'].'&apt='. $row['apt_id'] .'&type='. $row['type'] .'&apt_id='. $row['apt_id'] .'&date='. $row['apt_date'] .'&no='. $row['No'] .' "><i class="fa fa-money m-r-5"></i> Add Payroll</a>
        </div>
      </div>';

    }else if($row["admin_status"]=="0" && $row["patient_status"]=="0"  && $row["doctor_status"]=="3") {   
      $sub_array[] ='<div class="dropdown dropdown-action">
      <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="#"><i class="fa fa-money-o m-r-5"></i> Add Payroll (Cancelled)</a>
      </div>
    </div>';

       }else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="1") {   
        $sub_array[] ='<div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#"><i class="fa fa-money m-r-5"></i> Add Payroll (Completed)</a>

        </div>
      </div>';
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