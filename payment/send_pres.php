<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['user_id'])) {
    $cur_date = date('Y-m-d');
    $apt_date = $_POST['apt_date'];


//  search doctor name 
$stmt2 = $conn->prepare("SELECT * FROM check_report WHERE p_id =? AND user_id=? AND check_date = ?");
$stmt2->bind_param("sss", $_POST['p_id'],$_POST['user_id'], $apt_date );
$stmt2->execute();
$result = $stmt2->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {

$ids= $row['check_report_id'];

}


$stmt1 = mysqli_prepare($conn,"UPDATE check_report SET pres_id =?   WHERE check_report_id=? ");
        
$pres_id=$_POST["pres_id"];

 $stmt1->bind_param("ss",$pres_id,$ids);


 $status = $stmt1->execute();

 echo "Successfully saved";


 if ($status === false) {
    trigger_error($stmt1->error, E_USER_ERROR);
  }

mysqli_stmt_execute($stmt1); 
mysqli_stmt_close($stmt1);

}else{


    if($stmt = mysqli_prepare($conn,"INSERT INTO check_report (apt_id,pres_id,user_id,p_id,check_date,submitted_date) VALUES (?, ?, ?,?, ?, ?)")){

        $user_id=$_POST["user_id"];
        $pres_id=$_POST["pres_id"];
        $p_id=$_POST["p_id"];
        $apt_id=$_POST["apt_id"];
        $cur_date = date('Y-m-d');


        mysqli_stmt_bind_param($stmt, "ssssss",$apt_id,$pres_id,$user_id,$p_id,$apt_date,$cur_date);
        echo "Successfully saved";
        mysqli_stmt_execute($stmt);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}
mysqli_stmt_close($stmt);

}








    }else{
        echo  "Failed to Save";

    }



?>