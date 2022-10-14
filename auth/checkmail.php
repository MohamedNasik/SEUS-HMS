<?php

include('dbconnection.php');

if(isset($_POST['email']))
{
 $email=$_POST['email'];

 $checkdata=" SELECT email FROM users WHERE email='$email' ";

 $query=mysqli_query($conn,$checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "This Email Address is Already Exist"; 
 }

 else

 {
echo "You can use this Email ID";
}
exit();
}












?>




