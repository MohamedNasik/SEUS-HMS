<?php

session_start();
require_once "../auth/dbconnection.php";

// if (isset(json_decode($_POST["data"])) {
  $results = $_POST["index1"];
  $jsondata = json_decode($_POST["index2"]);
 //var_dump( $jsondata);

  $presid= $jsondata->pressid;
  $pid= $jsondata->ppid;
  $testname= $jsondata->testname;
  $remark= $jsondata->remark;

  $user_id= $_SESSION['user_id'];
  $cur_date = date('Y-m-d');


  
   $stmt1 = $conn->prepare("SELECT * FROM patients WHERE  p_id=? ");
   $stmt1->bind_param("s", $pid);
   $stmt1->execute();
   $result1 = $stmt1->get_result();
   if($result1->num_rows === 0);
   while($row = $result1->fetch_assoc()) {
$email= $row['email'];
$username= $row['p_fname'].' '. $row['p_lname'];

   }


   //i dont see your password colom name, so i guess it password
   $stmt = $conn->prepare("SELECT * FROM testing_schedule WHERE  test_id='1' AND pres_id=? ");
   $testname =  $testname;
   $stmt->bind_param("s", $presid);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0);
   while($row = $result->fetch_assoc()) {
   $test_id = $row['test_id'];
   $testing_schedule_id = $row['testing_schedule_id'];
  

   }

    

    if($stmt1 = mysqli_prepare($conn,"INSERT INTO testing_report (test_id,pres_id,user_id, p_id,testing_results,remark,date) VALUES (?, ?, ?, ?, ?, ?,?)")){
    
        mysqli_stmt_bind_param($stmt1, "sssssss",$test_id,$presid,$user_id,$pid,$results,$remark,$cur_date);

        mysqli_stmt_execute($stmt1); 

        $report_id = $conn->insert_id;

       echo "Records inserted successfully.";


    } else{

      echo "ERROR: Could not save : $sql. " . mysqli_error($conn);
    
    
    }


       if( $stmt2 = mysqli_prepare($conn,"UPDATE testing_schedule SET lab_status =? WHERE testing_schedule_id =?")){
       
        $lab_status="1";
    
         $stmt2->bind_param('ss', $lab_status,$testing_schedule_id);
  
        $stmt2->execute();
        /* BK: always check whether the execute() succeeded */
             echo   "Test has been updated" ;
 
             mysqli_stmt_execute($stmt2); 


             $to      = $email;
             $subject = 'Blood Count Test Status';
             $message = '<p> Dear <b> ' .$username.' </b> <br> Your Blood count test has been successfully completed.  Confirm your payment for the test to view the test report. <br><br>  Report ID: ' .$report_id.'  <br> Prescription ID: ' .$presid. '  <br> Submitted Date: ' .date("Y-m-d")  .'  <br><br>Thank You. <br><br> Best Regards from </br> <br><b> <i>  SEUS Hospitals Laboratory </i></b> </br>';
             
            $headers = 'From: seus@gmail.com' . "\r\n" ;
            $headers .= 'Reply-To: seus@gmail.com' . "\r\n" ;
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
             
           $send= mail($to, $subject, $message, $headers);
       




       } else{

        echo "ERROR: Could not prepare query: $sql1. " . mysqli_error($conn);
      
      
      }

  







      mysqli_stmt_close($stmt1);
      mysqli_stmt_close($stmt2);


?>


