<?php

       // Initialize the session
       session_start();
       include ('auth/dbconnection.php');
       if(!isset($_SESSION['user_id'])){
          header('location:login.php');
          }

$apt_id=$_GET['apt_id'];
$pres_id=$_GET['pres_id'];
$apt_date=$_GET['apt_date'];



          $stmt = $conn->prepare("SELECT * FROM appointment WHERE apt_id = ? AND user_id=? AND apt_date=? ");
          $stmt->bind_param("sss", $_GET['apt_id'],  $_SESSION['user_id'],$apt_date);
          $stmt->execute();
          $result = $stmt->get_result();
          if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()) {

       $type=$row['type'];

            }

   if($type == 'Consultation'){
    header("Location:edit_investigation.php?aptid=$apt_id&pres_id=$pres_id&apt_date=$apt_date"); 




   }else{

     header("Location:edit-investigation.php?aptid=$apt_id&pres_id=$pres_id&apt_date=$apt_date"); 


   }



        
        
        
        }else{
          echo 'dsdsdsd';
        } 
?>