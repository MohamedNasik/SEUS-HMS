<?php

session_start();
require_once "../auth/dbconnection.php";

    if (isset($_POST['test_id'])) {


        $stmt = mysqli_prepare($conn,"UPDATE testings SET testing_description =? , testing_charge=? WHERE test_id=? ");
        
        $test_id=$_POST["test_id"];

        $testing_description=$_POST["testing_description"];
        $testing_charge=$_POST["testing_charge"];
        // $testing_status=$_POST["test_status"];
        /* Bind our params */
        /* BK: variables must be bound in the same order as the params in your SQL.
         * Some people prefer PDO because it supports named parameter. */
         $stmt->bind_param("sss",$testing_description,$testing_charge,$test_id);
        
        /* Set our params */
        /* BK: No need to use escaping when using parameters, in fact, you must not, 
         * because you'll get literal '\' characters in your content. */
        
        /* Execute the prepared Statement */
         $status = $stmt->execute();
        /* BK: always check whether the execute() succeeded */
      
         echo "Testing Updated Successfully";
        

         if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
          }
        
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);


    }

    if (isset($_POST['testings'])) {
      header('Content-Type: application/json');

    $sql="SELECT * from testings where test_id='".$_POST['testings']."'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
    

      $data = [];
      $data["testing_description"]=$row["testing_description"];
      $data["charge"]=$row["testing_charge"];


    }

    echo json_encode($data);
 
}






    

?>