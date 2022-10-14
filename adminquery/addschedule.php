
<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";


  $jsondata = json_decode($_POST["index2"]);


  $doctor_name= $jsondata->doctor_name;
  $doc_specialization= $jsondata->specilization;
 
   $query = "SELECT username,user_id FROM users WHERE user_id = '$doctor_name' ";
   if($result = mysqli_query($conn,$query));
    if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result)){
      $row['username'];
      $row['user_id'];

     $username= $row['username'];
     $user_id= $row['user_id'];

     //$days=implode(',',$available_days);
 
  $sql= "INSERT INTO schedule (user_id,username,specilization) 
  VALUES ('". $user_id."','".  $username."','". $doc_specialization."')  ";
  
  if(mysqli_query($conn,$sql) ){
    echo'Successfully saved';
   


  }
  else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  }

}

mysqli_free_result($result);

} 
else{
  echo  " <center> These types of users not available. <br> Please try again later with appropriate user types </center>";
}

// Close connection
mysqli_close($conn);
exit();


 ?>