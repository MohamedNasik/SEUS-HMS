<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');
include ("../../auth/dbconnection.php");

if(isset($_POST["doctor_schedule_id"]))
{

  // $check=date('Y-m-d', strtotime($_POST['end']));

  $check = strtotime($_POST['end']);
  $check = date('Y-m-d', $check); 

  $ended = $_POST['end'];
  $end = date('Y-m-d H:i:s', strtotime($ended));

//  fetch data from doctor schedule 
$stmt = $conn->prepare("SELECT * FROM doctor_schedule WHERE doctor_schedule_id = ? ");
$stmt->bind_param("s", $_POST['doctor_schedule_id']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
$user_id=$row['user_id'];
    }}


//  search PATIENT SCHEDULE name 
$stmt = $conn->prepare("SELECT * FROM patient_schedule WHERE DATE_FORMAT(end_time,'%Y-%m-%d') = ? AND user_id=? order by end_time DESC LIMIT 1  ");
$stmt->bind_param("ss", $check,$user_id);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {
  $end_patient = date('Y-m-d H:i:s', strtotime($row['end_time']));

}

if($end_patient <  $end   ) {

 $query = " UPDATE doctor_schedule 
 SET  start_time=:start_time, end_time=:end_time 
 WHERE doctor_schedule_id=:doctor_schedule_id ";

 $statement = $connect->prepare($query);

echo $statement->execute(
  array(
   ':start_time' => $_POST['start'],
   ':end_time' => $_POST['end'],
   ':doctor_schedule_id'   => $_POST['doctor_schedule_id']
  )
 );

}else{

  echo 'Cant';
}



}else{


  $query = " UPDATE doctor_schedule 
  SET  start_time=:start_time, end_time=:end_time 
  WHERE doctor_schedule_id=:doctor_schedule_id ";
 
  $statement = $connect->prepare($query);
 
 echo $statement->execute(
   array(
    ':start_time' => $_POST['start'],
    ':end_time' => $_POST['end'],
    ':doctor_schedule_id'   => $_POST['doctor_schedule_id']
   )
  );



}


}

?>

