<?php
include '../auth/dbconnection.php';

if (isset($_POST['data_id'])) {

   $id=$_POST['data_id'];

   
$sql = "UPDATE testing_schedule SET lab_status ='0',patient_status='0' WHERE testing_schedule_id= '$id' ";
if($conn->query($sql) === true){ 
    echo "Records was updated successfully."; 
} else{ 
    echo "ERROR: Could not able to execute $sql. "  
                                        . $conn->error; 
} 
$conn->close(); 
}

if (isset($_POST['datas'])) {

    $id=$_POST['datas'];
 
 $sql = "UPDATE testing_schedule SET lab_status ='1',patient_status='1' WHERE testing_schedule_id= '$id' ";
 if($conn->query($sql) === true){ 
     echo "Records was updated successfully."; 
 } else{ 
     echo "ERROR: Could not able to execute $sql. "  
                                         . $conn->error; 
 } 
 $conn->close(); 
 }




?> 