<?php
session_start();

include ('../auth/dbconnection.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


  $GLOBALS['p_id'] = $_POST["p_id"];
  $GLOBALS['pres_id'] = $_POST["pres_id"];
  $GLOBALS['test_id'] = $_POST["test_id"];
  $GLOBALS['cur_date'] = date('Y-m-d');

  
  function add($a){
    global $conn;

    try {

      // Start transaction
        $conn->begin_transaction();

        $query = "INSERT INTO test_payments (test_payment_id,user_id,p_id,invoice_date) VALUES ('".$GLOBALS['a']."','".$_SESSION['user_id']."','". $GLOBALS['p_id']."','". $GLOBALS['cur_date']."')";
        $result = mysqli_query($conn, $query);
         
       $ids= mysqli_insert_id($conn); 

      // prepared statement prepared once and executed multiple times
      $insertStatement = $conn->prepare('INSERT INTO test_invoices (test_payment_id,pres_id,user_id,p_id,test_id,charge,payment_date) VALUES ( ?,?, ?, ?, ? , ?, ?)');
      $insertStatement->bind_param('sssssss', $GLOBALS['a'], $GLOBALS['pres_id'],$_SESSION['user_id'],$GLOBALS['p_id'] ,   $test_id , $testing_charge,$GLOBALS['cur_date'] );

              // prepared statement prepared once and executed multiple times
              $insertStatement_update = $conn->prepare('UPDATE testing_schedule SET patient_status =?, payment_status= ? WHERE pres_id =? AND test_id=? AND p_id=?');
              $patient_status="3";
              $payment_status="2";

              $insertStatement_update->bind_param('sssss', $patient_status, $payment_status,$GLOBALS['pres_id'], $test_id, $GLOBALS['p_id']);
      
      
      foreach ($GLOBALS['test_id'] as $testing) {

        $stmt = $conn->prepare("SELECT * FROM testings  WHERE test_id=? ");
        $stmt->bind_param("s",$testing);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)  ;
        while($row = $result->fetch_assoc()) {
        
          $test_id= $row['test_id'];
          $testing_charge= $row['testing_charge'];
        
        }
        
        $insertStatement->execute();
        $insertStatement_update->execute();

      }
      
      // Save and end transaction
         $conn->commit();
       
   
         if ( $conn->commit()) {
          echo   $GLOBALS['a'];
      } else {
          echo 'error';
      }



  } catch (Exception $exc) {   
      //handle any errors in your code, including connection issues
      echo "ERROR: Could not prepare query  " . mysqli_error($conn);
      //this will be your "flag" to handle on the client side
      //and if you want, can also log the error with 
      //$exc->getMessage() or $exc->getTraceAsString()
    
  }


}
//  SEARCH
  $query = "SELECT * FROM test_payments ORDER BY test_payment_id DESC LIMIT 1";
  if($result = mysqli_query($conn,$query));
   if(mysqli_num_rows($result)>0){
   while($row = mysqli_fetch_array($result)){
 $lastid=$row['test_payment_id'];
  }
  $search = 'TEST-' ;


   $trimmed = str_replace($search,'',$lastid) ;

  $srting_trimmed = (string)$trimmed;
   $id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010

   $var='TEST-';

     $new_id=$var.''.$id;
     $GLOBALS['a'] =  $new_id;
add(12);

  
  }else{
    
    $var='TEST-';
    $num= '0001';

  $new_id=$var.''.$num;
  $GLOBALS['a'] =  $new_id;

 add(12);


  }
  

    


  




  



?>