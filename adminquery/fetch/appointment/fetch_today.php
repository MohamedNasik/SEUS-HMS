<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=hmsproject",$username,$password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  // echo "Connection failed: " . $e->getMessage();
}

$column= array('apt_id','doctor_name','a.specilization','patient_name','type','apt_date','admin_status','admin_status','admin_status');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = "SELECT * FROM appointment as a,doctor_specialist as u WHERE a.user_id= u.user_id  AND a.apt_date=curdate()";


if(isset($_GET["search"]["value"])){

  $query .= '
  AND (apt_id LIKE "%'.$_GET["search"]["value"].'%"
  OR  doctor_name LIKE "%'.$_GET["search"]["value"].'%"
  OR  a.specilization LIKE "%'.$_GET["search"]["value"].'%"
  OR  patient_name LIKE "%'.$_GET["search"]["value"].'%"
  OR  type LIKE "%'.$_GET["search"]["value"].'%"
  OR  apt_date LIKE "%'.$_GET["search"]["value"].'%"
  OR  admin_status LIKE "%'.$_GET["search"]["value"].'%"
  OR  admin_status LIKE "%'.$_GET["search"]["value"].'%"
  OR  admin_status LIKE "%'.$_GET["search"]["value"].'%"

)';

}


if(isset($_GET['order']))
{
 $query .= 'ORDER BY '.$column[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY No DESC ';
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
 $sub_array[] = $row['apt_id'];
 $sub_array[] = $row['doctor_name'];
 $sub_array[] = $row['specilization'];
 $sub_array[] = $row['patient_name'];
 $sub_array[] = $row['type'];
 $sub_array[] = $row['apt_date'];

 $name= $row['doctor_name'];


    //  status badth change
    if($row["admin_status"]=="0" && $row["patient_status"]=="0"  && $row["doctor_status"]=="3") {  
      $sub_array[] =' <span class="custom-badge status-red">Cancelled</span>';
       } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {    
          $sub_array[] =' <span class="custom-badge status-green">Active</span>';
        } else if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {    
          $sub_array[] ='<span class="custom-badge status-orange">Un Attended</span>';
        } else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="1") {    
          $sub_array[] ='<span class="custom-badge status-green">Discharged</span>';

       } 

        //  change button
         if($row["admin_status"]=="3" && $row["patient_status"]=="3"  && $row["doctor_status"]=="3") {  
         $sub_array[] = '<button class="btn btn-success custom-badge status-green check" value="Submit"  onclick="(this.id)" data-toggle="modal" id="rep1" data_id= '.$row['apt_id'].' data_id1= '.$row['p_id'].'  data_id2= '.$row['apt_date'].' user_id= '.$row['user_id'].'  No= '.$row['No'].'  data-target="#active_appointment"  >   Approve  </button> ';
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
            <a class="dropdown-item" href="#"><i class="fa fa-money m-r-5"></i> Un Attended</a>
          </div>
        </div>';

      }else if($row["admin_status"]=="1" && $row["patient_status"]=="1"  && $row["doctor_status"]=="3") {   
        $sub_array[] ='<div class="dropdown dropdown-action">
        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="payment.php?pid='.base64_encode($row['p_id']) .'&userid='. base64_encode($row['user_id']).'&special='. base64_encode($row['specilization']).' &name='.base64_encode($name) .'&pname='. base64_encode($row['patient_name']).'&apt='. base64_encode($row['apt_id']) .'&type='. base64_encode($row['type']) .'&apt_id='. base64_encode($row['apt_id']) .'&date='.base64_encode( $row['apt_date']) .'&no='.base64_encode( $row['No']) .' "><i class="fa fa-money m-r-5"></i> Add Payroll</a>

       
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

 $data[] = $sub_array;
}

function count_all_data($conn)
{
 $query = "SELECT * FROM appointment as a,doctor_specialist as u WHERE a.user_id= u.user_id";
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