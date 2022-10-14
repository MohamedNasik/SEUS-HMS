<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['testname'])) {

    $testname=$_POST['testname'];

    $checkdata=" SELECT testing_name FROM testings WHERE testing_name='$testname' ";
   
    $query=mysqli_query($conn,$checkdata);
   
    if(mysqli_num_rows($query)>0)
    {
     echo "This Test is Already Exist"; 
    }
   
    else
   
    {
  //  echo "You can use this Email ID";
   }
   exit();
 

    }






if (isset($_POST['testing_charge'])) {


    if($stmt = mysqli_prepare($conn,"INSERT INTO testings (testing_name,testing_description,testing_charge,status) VALUES (?, ?, ?, ?)")){

       
        $testing_description=$_POST["testing_description"];
        $testing_charge=$_POST["testing_charge"];
        $status=$_POST["blog_status"];
        $testings=$_POST["testing_name"];

        mysqli_stmt_bind_param($stmt, "ssss",$testings,$testing_description,$testing_charge,$status);

       echo "Testing Added Successfully";
   
       mysqli_stmt_execute($stmt);

} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

}



    }else{
echo  "Failed to Save";

    }

    


   mysqli_stmt_close($stmt);

?>