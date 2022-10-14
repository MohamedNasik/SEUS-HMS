<?php

include('../auth/dbconnection.php');

if(isset($_POST['id']))
{
 $pres_id=$_POST['id'];


 $stmt = $conn->prepare("SELECT * FROM prescription WHERE pres_id = ?");
 $stmt->bind_param("s", $pres_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows === 0);
 while($row = $result->fetch_assoc()) {
   
    $cur_date = date('Y-m-d');
    $date = $row['date'];

    $start = strtotime($date);
    $end = strtotime($cur_date);
    
    $days_between = ceil(abs($end - $start) / 86400);


  if($days_between<=7){

echo "No need";


  }else{

    echo "Pay";


  }



 
 }


exit();
}


?>




