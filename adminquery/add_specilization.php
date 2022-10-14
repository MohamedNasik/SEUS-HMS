<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['specilization_name'])) {


    if($stmt = mysqli_prepare($conn,"INSERT INTO doctorspecilization (specilization,fees) VALUES (?, ?)")){

    
        $specilization_name=$_POST["specilization_name"];
        $specilization_fees=$_POST["specilization_fees"];
       
        mysqli_stmt_bind_param($stmt, "ss",$specilization_name,$specilization_fees);

       echo "Successfully saved";
   
      mysqli_stmt_execute($stmt);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}


    }else{
echo  "Failed to Save";

    }


   mysqli_stmt_close($stmt);

?>