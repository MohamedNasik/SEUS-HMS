<?php

include('../auth/dbconnection.php');

if(isset($_POST['name']))
{
 $id=$_POST['name'];

 $checkdata=" SELECT user_id FROM schedule WHERE user_id='$id' ";

 $query=mysqli_query($conn,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "Already added to the schedule"; 
 }

 else

 {
// echo "You can use this Email ID";
}
exit();
}












?>




