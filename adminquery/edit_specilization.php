<?php

session_start();
require_once "../auth/dbconnection.php";

    if (isset($_POST['id'])) {


        $stmt = mysqli_prepare($conn,"UPDATE doctorspecilization SET fees =?  WHERE doc_spec_id=? ");
        
        $id=$_POST["id"];

        $fees=$_POST["fees"];
  
        /* Bind our params */
        /* BK: variables must be bound in the same order as the params in your SQL.
         * Some people prefer PDO because it supports named parameter. */
         $stmt->bind_param("ss",$fees,$id);
        
        /* Set our params */
        /* BK: No need to use escaping when using parameters, in fact, you must not, 
         * because you'll get literal '\' characters in your content. */
        
        /* Execute the prepared Statement */
         $status = $stmt->execute();
        /* BK: always check whether the execute() succeeded */
      
         echo "Specilization Updated Successfully";
        

         if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
          }
        
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);





    }


?>