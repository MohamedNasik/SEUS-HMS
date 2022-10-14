<?php

include ("../../auth/config.php");
include ("../../auth/dbconnection.php");

$cur_date = date('Y-m-d H:i:s', time());
$cur_date = strtotime($cur_date);
$cur_date = date('Y-m-d', $cur_date); 


//  search doctor name 
$stmt = $conn->prepare("SELECT * FROM doctor_specialist WHERE doctor_name = ?");
$stmt->bind_param("s", $_POST['doctor_name']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {
  
  $doctor_name = $row['doctor_name'];
  $user_id = $row['user_id'];

}

if (isset($_POST['doctor_name'])) {


    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $startDate = date('Y-m-d H:i:s', strtotime($startDate));
    $endDate = date('Y-m-d H:i:s', strtotime($endDate));
    $check=date('Y-m-d', strtotime($_POST['startDate']));



 if (  date('Y-m-d', strtotime($startDate)) < $cur_date ) {
     
    echo 'Selected Past Date';

}else{


    if (  date('Y-m-d', strtotime($startDate)) == date('Y-m-d', strtotime($endDate)) ) {

        if (  $startDate < $endDate ) {

//  search doctor name 
$stmt1 = $conn->prepare("SELECT * FROM doctor_schedule WHERE user_id = ? AND DATE_FORMAT(start_time,'%Y-%m-%d')  = ? ");
$stmt1->bind_param("ss",$user_id,$check);
$stmt1->execute();
$result1 = $stmt1->get_result();
if(mysqli_num_rows($result1) > 0 ){

    echo 'Already Added';

}else{

    $query = "INSERT INTO doctor_schedule  (user_id,start_time,end_time) VALUES (:user_id,:startDate,:endDate)";
    
    $statement= $pdo->prepare($query);


    if($statement){
    $statement-> execute(
        array(
        
            ':user_id' => $user_id,
            ':startDate' => $startDate,
            ':endDate' => $endDate
     
        )
    );

    echo 'Saved';


}else{
echo 'Didnt Saved';

}



        }



    }else{

    echo 'Time Adjustment Wrong';
    }

}else{

    echo 'Wrong Date';

}

}


}else{


    echo 'Does not recieve data';

}




}




?>