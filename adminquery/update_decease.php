<?php

session_start();
require_once "../auth/dbconnection.php";

    if (isset($_POST['des_id'])) {


        $stmt = mysqli_prepare($conn,"UPDATE deceases SET deseace_name =? ,  deseace_description=?  WHERE deseace_id=? ");
        
        $des_id=$_POST["des_id"];

        $des_name=$_POST["des_name"];
        $des_description=$_POST["des_description"];
        /* Bind our params */
        /* BK: variables must be bound in the same order as the params in your SQL.
         * Some people prefer PDO because it supports named parameter. */
         $stmt->bind_param("sss",$des_name,$des_description,$des_id);
        
        /* Set our params */
        /* BK: No need to use escaping when using parameters, in fact, you must not, 
         * because you'll get literal '\' characters in your content. */
        
        /* Execute the prepared Statement */
         $status = $stmt->execute();
        /* BK: always check whether the execute() succeeded */
      
         echo "Decease Updated Successfully";
        

         if ($status === false) {
            trigger_error($stmt->error, E_USER_ERROR);
          }
        
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_close($stmt);





    }




        

//         if($stmt = mysqli_prepare($conn,"UPDATE testings SET testing_description =? AND testing_charge=? AND  status=? WHERE test_id=? ")){
    
//             $test_id=$_POST["test_id"];

//             $testing_description=$_POST["testing_description"];
//             $testing_charge=$_POST["testing_charge"];
//             $testing_status=$_POST["testing_status"];
    
//             mysqli_stmt_bind_param($stmt, "ssss",$testing_description,$testing_charge,$testing_status,$test_id);
    
//            echo "Testing Updated Successfully";
       
//            mysqli_stmt_execute($stmt);
    
//     } else{
    
//         echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
    
//     }
    
    
    
//         }else{
//     echo  "Failed to Save";
    
//         }

    


//    mysqli_stmt_close($stmt);

?>