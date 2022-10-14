<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['dept_name'])) {


    if($stmt = mysqli_prepare($conn,"INSERT INTO deceases (deseace_name,deseace_description) VALUES (?, ?)")){

    
        $dept_name=$_POST["dept_name"];
        $des_description=$_POST["des_description"];
        

        mysqli_stmt_bind_param($stmt, "ss",$dept_name,$des_description);
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