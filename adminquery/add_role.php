<?php
        // Initialize the session
         session_start();

include_once ('../auth/dbconnection.php');

if (isset($_POST['role_name'])) {

    if($stmt = mysqli_prepare($conn,"INSERT INTO roles (role_name,status) VALUES (?, ?)")){
        $rolename=  $_POST["role_name"];
        $status= $_POST["role_status"];

        mysqli_stmt_bind_param($stmt, "ss",$rolename,$status);

       echo "Role inserted successfully.";
       mysqli_stmt_execute($stmt);

} else{

    echo "Role not inserted successfully.";

}

}
        ?>
