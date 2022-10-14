<?php

include ("../auth/config.php");
include ("../auth/dbconnection.php");


$stmt = $conn->prepare("SELECT * FROM appointment WHERE apt_id = ?");
$stmt->bind_param("s", $_POST['aid']);
$stmt->execute();
$result = $stmt->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {
  
  $admin_status = $row['admin_status'];

} 

if ($admin_status == '1' ) {

if (isset($_POST['title'])) {


    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $startDate = date('Y-m-d H:i:s', strtotime($startDate));
    $endDate = date('Y-m-d H:i:s', strtotime($endDate));
    


    $query = "INSERT INTO patient_schedule  (apt_id,user_id,p_id,title,start_event,end_event,color,text_color) VALUES (:aid,:uid,:pid,:title,:startDate,:endDate,:color,:text_color)";
    
    $statement= $pdo->prepare($query);


    if($statement){
    $statement-> execute(
        array(
            ':aid' => $_POST['aid'],
            ':uid' => $_POST['uid'],
            ':pid' => $_POST['pid'],
            ':title' => $_POST['title'],
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':color' => $_POST['color'],
            ':text_color' => $_POST['text_color']
        )
    );

    echo 'Saved';


}else{
echo 'Didnt Saved';


}


}else{


    echo 'Does not recieve data';

}


}else{

    echo 'First approve the appointment';

        
}

}




?>