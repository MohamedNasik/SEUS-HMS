<?php
 // Create connection

 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 try {
   $conn = new mysqli("localhost", "root", "", "hmsproject");
   $conn->set_charset("utf8mb4");
 } catch(Exception $e) {
   error_log($e->getMessage());
   exit('Error connecting to database'); //Should be a message a typical user could understand
 }
 
 
// $conn=mysqli_connect("localhost","root","","hmsproject");

// // Check connection
// if (mysqli_connect_errno($conn))
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }




  
?>