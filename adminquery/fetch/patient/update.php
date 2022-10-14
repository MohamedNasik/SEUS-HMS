<?php

session_start();

require_once '../../../auth/dbconnection.php';

$p_id=$_POST['p_id']; // current password



if(isset($_POST['fname'])){

    $fname=$_POST['fname']; // current password
    $lname=$_POST['lname']; // current password
    $dob=$_POST['dob']; // current password
    $contact=$_POST['contact']; // current password
    $address=$_POST['address']; // current password
    $state=$_POST['state']; // current password
    $gender=$_POST['gender']; // current password
    $nic=$_POST['nic']; // current password

try {

$stmt = mysqli_prepare($conn,"UPDATE patients SET p_fname=? ,p_lname=? ,p_address=? ,p_gender=? ,  dob=?,p_contact=?, p_state=?,nic=?   WHERE p_id=?");

$date=strtotime($_POST['dob']); 
$dobs=date("Y-m-d",$date);

/* Bind our params */
/* BK: variables must be bound in the same order as the params in your SQL.
 * Some people prefer PDO because it supports named parameter. */
mysqli_stmt_bind_param($stmt, 'ssssssssi', $fname,$lname , $address,$gender,$dobs,$contact,$state,$nic, $p_id);


/* Execute the prepared Statement */
 $status=$stmt->execute();

if ($status== true) {
    echo "Success";
} else {
  throw new Exception('cant change');
}

} catch (Exception $exc) {   
//handle any errors in your code, including connection issues
echo "ERROR: Could not prepare query: " . mysqli_error($conn);
//this will be your "flag" to handle on the client side
//and if you want, can also log the error with 
//$exc->getMessage() or $exc->getTraceAsString()

}

mysqli_stmt_execute($stmt); 

$stmt->close();

}

if(isset($_POST['pass'])){

  if($_POST['pass'] !== ''  ){


$password=$_POST['pass'];
    try {

        $stmt1 = $conn->prepare("UPDATE patients SET password=?  WHERE p_id=?");
        $password = md5($password); // current password md5
        
        
        /* Bind our params */
        /* BK: variables must be bound in the same order as the params in your SQL.
         * Some people prefer PDO because it supports named parameter. */
         $stmt1->bind_param("si",  $password, $p_id);

        /* Execute the prepared Statement */
         $status=$stmt1->execute();
        
        if ($status== true) {
            echo "Success";
        } else {
          throw new Exception('cant change');
        }
        
        } catch (Exception $exc) {   
        //handle any errors in your code, including connection issues
        echo "ERROR: Could not prepare query: " . mysqli_error($conn);
        //this will be your "flag" to handle on the client side
        //and if you want, can also log the error with 
        //$exc->getMessage() or $exc->getTraceAsString()
        
        }
        
        // mysqli_stmt_execute($stmt1); 
        
        $stmt1->close();



      }else{

        echo "Empty";
      }


}

?>