<?php

//delete.php

if(isset($_POST["doctor_schedule_id"]))
{
    $connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');
    include ("../../auth/dbconnection.php");

    $check=date('Y-m-d', strtotime($_POST['starts']));


//  fetch data from doctor schedule 
$stmt = $conn->prepare("SELECT * FROM doctor_schedule WHERE doctor_schedule_id = ? ");
$stmt->bind_param("s", $_POST['doctor_schedule_id']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
$user_id=$row['user_id'];
    }


//  search patient schedule  
$stmt = $conn->prepare("SELECT * FROM patient_schedule WHERE DATE_FORMAT(start_time,'%Y-%m-%d') = ? AND user_id=? ");
$stmt->bind_param("ss", $check,$user_id);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){

echo  "Cant";

}else{

 $query = "DELETE from doctor_schedule WHERE doctor_schedule_id=:doctor_schedule_id";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':doctor_schedule_id' => $_POST['doctor_schedule_id']
  )
 );

}
}


}

?>