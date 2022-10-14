<?php 

// Initialize the session
session_start();
require_once '../auth/dbconnection.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



$stmt = mysqli_prepare($conn,"UPDATE users SET fname =? , lname=? , dob=? , address=? ,   state=? ,  contact=? , nic=? WHERE user_id =?");

$fname=$_POST["fname"];
$lname=$_POST["lname"];
$dob=$_POST["dob"];
$address=$_POST["address"];
 $state=$_POST["state"];
$contact=$_POST["contact"];
$nic=$_POST["nic"];



/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
mysqli_stmt_bind_param($stmt, "ssssssss",$fname,$lname,$dob,$address,$state,$contact,$nic, $_SESSION['user_id']);


/* Execute the prepared Statement */
$status = $stmt->execute();
/* BK: always check whether the execute() succeeded */
if ($status === false) {
trigger_error($stmt->error, E_USER_ERROR);

printf("Failed". $stmt->error);

}else {
    
    echo'Successfully Updated';

} 


mysqli_stmt_execute($stmt); 



?>