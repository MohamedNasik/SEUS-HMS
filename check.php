<?php

       // Initialize the session
       session_start();
       include ('auth/dbconnection.php');
       if(!isset($_SESSION['user_id'])){
          header('location:login.php');
          }

          $aptid=$_GET['aptid'];
          $p_id=$_GET['p_id'];
          $date=$_GET['date'];

          $stmt = $conn->prepare("SELECT * FROM appointment WHERE apt_id = ? AND p_id=? AND apt_date=? AND user_id=?  ");
          $stmt->bind_param("ssss", $_GET['aptid'], $_GET['p_id'],  $_GET['date'],$_SESSION['user_id']);
          $stmt->execute();
          $result = $stmt->get_result();
          if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()) {

               $type=$row['type'];

            }

           if($type == 'Consultation'){
           header("Location:first-prescription.php?aptid=$aptid&p_id=$p_id&date=$date"); 

   }else{

    header("Location:second-prescription.php?aptid=$aptid&p_id=$p_id&date=$date"); 

   }
 
        
        } 
?>