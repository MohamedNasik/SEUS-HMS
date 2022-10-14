<?php

session_start();
require_once "../auth/dbconnection.php";

// if (isset(json_decode($_POST["data"])) {
  $results = $_POST["index3"];
  $jsondata = json_decode($_POST["index4"]);
 //var_dump( $jsondata);

  $presid= $jsondata->pressid;
  $pid= $jsondata->ppid;
  $testname= $jsondata->testname;
  $remark= $jsondata->remark;
  $testing_report_id= $jsondata->testing_report_id;

  $user_id= $_SESSION['user_id'];
  $cur_date = date('Y-m-d');

       if( $stmt = mysqli_prepare($conn,"UPDATE testing_report SET testing_results =? , remark =? WHERE testing_report_id =?")){
       
    
         $stmt->bind_param('sss', $results,$remark,$testing_report_id);
  
        $stmt->execute();
        /* BK: always check whether the execute() succeeded */
             echo   "Test has been updated" ;
 
             mysqli_stmt_execute($stmt); 

       } else{

        echo "ERROR: Could not prepare query: $stmt. " . mysqli_error($conn);
      
      
      }

   
  
      mysqli_stmt_close($stmt);


?>


