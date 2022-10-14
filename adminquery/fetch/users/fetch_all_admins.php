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

$column= array('user_id','fname','address','gender','dob','contact');

// $query = "SELECT * FROM appointment as a,users as u WHERE a.user_id= u.user_id";

$query = " SELECT * FROM users WHERE role_id='1'";





if(isset($_GET["search"]["value"])){

  $query .= '
  AND ( user_id LIKE "%'.$_GET["search"]["value"].'%"
  OR  fname LIKE "%'.$_GET["search"]["value"].'%"
  OR  address LIKE "%'.$_GET["search"]["value"].'%"
  OR  contact LIKE "%'.$_GET["search"]["value"].'%"
  OR  gender LIKE "%'.$_GET["search"]["value"].'%"
  OR  dob LIKE "%'.$_GET["search"]["value"].'%"

  )';

}




if(isset($_GET['order']))
{
 $query .= 'ORDER BY '.$column[$_GET['order']['0']['column']].' '.$_GET['order']['0']['dir'].' ';
}
else
{
 $query .= ' ORDER BY user_id ASC';
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

    if($row["address"] == ''){  $address= 'Not Inserted'; }else{ $address  =$row["address"] ; }
    if($row["contact"] == '0'){  $contact= 'Not Inserted'; }else{ $contact  =$row["contact"] ; }
    

   $username= $row['fname'].' '.$row['lname'];
 $sub_array = array();
 $sub_array[] = $row['user_id'];
 $sub_array[] = $username;
 $sub_array[] = $address;
 $sub_array[] = $row['gender'];
 $sub_array[] = $row['dob'];
 $sub_array[] =  $contact;




 $data[] = $sub_array;
}

function count_all_data($conn)
{
$query = " SELECT * FROM users WHERE role_id='1' ";
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