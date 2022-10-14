<?php

$conn=mysqli_connect("localhost","root","","hmsproject");

// Check connection
if (mysqli_connect_errno($conn))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


function fill_select_box($conn,$medicine_name)
{ 
    $output = '';
    $stmt = $conn->prepare("SELECT * FROM medicines");
  
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0) exit('No rows');
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["medicine_name"].'">'.$row["medicine_name"].'</option>';
 }
 return $output;
}


?>