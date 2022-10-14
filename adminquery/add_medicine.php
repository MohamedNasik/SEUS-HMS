<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['medicine_name'])) {


    if($stmt = mysqli_prepare($conn,"INSERT INTO medicines (medicine_name,type,description) VALUES (?, ?, ?)")){

    
        $medicine_name=$_POST["medicine_name"];
        $description=$_POST["description"];
        $type=$_POST["type"];


        mysqli_stmt_bind_param($stmt, "sss",$medicine_name,$type,$description);
        echo "Successfully saved";
        mysqli_stmt_execute($stmt);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}

mysqli_stmt_close($stmt);


    }else{
        echo  "Failed to Save";

    }



?>