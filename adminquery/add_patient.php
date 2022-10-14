<?php

 // Initialize the session
 session_start();

require_once '../auth/dbconnection.php';



if (isset($_POST['email'])) {
 

    $GLOBALS['first_name'] = $_POST['first_name'];
    $GLOBALS['last_name'] = $_POST['last_name'];
    $GLOBALS['address'] = "";
    $GLOBALS['gender'] = $_POST['gender'];
    $GLOBALS['dob'] = $_POST['dob'];
    $GLOBALS['contact'] = "";
    $GLOBALS['state'] = "";
    $GLOBALS['nic'] = "";
    $GLOBALS['prefix'] = $_POST['prefix'];
 
    $GLOBALS['email'] = $_POST['email'];
    $passwordnormal=$_POST["password"];
    $GLOBALS['password']  = md5($passwordnormal);
 
 
    function add($a){
     global $conn;
 
   $sql= "INSERT INTO patients (p_id,prefix,p_fname,p_lname,p_address,p_gender,dob,p_contact,p_state,email,password,nic) 
   VALUES ('". $GLOBALS['a']."','". $GLOBALS['prefix']."','". $GLOBALS['first_name']."','".  $GLOBALS['last_name']."','".  $GLOBALS['address']."', '".  $GLOBALS['gender']."','".  $GLOBALS['dob']."','".  $GLOBALS['contact']."', '".  $GLOBALS['state']."','".  $GLOBALS['email']."', '".  $GLOBALS['password']."' , '".  $GLOBALS['nic']."')  ";
    
     if (mysqli_query($conn, $sql)) {
     $id = mysqli_insert_id($conn);
 
       echo 'Successfully Saved';
     }else {
       echo "Error: ". mysqli_error($conn);
     }
 
    }
 
   //  search patient wherether they available
   $query = "SELECT * FROM patients ORDER BY p_id DESC LIMIT 1";
   $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
 
     $lastid=$row['p_id'];
   }
 
   $search = 'PAT-' ;
 
 
    $trimmed = str_replace($search,'',$lastid) ;
 
 
   $srting_trimmed = (string)$trimmed;
    $id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010
 
    $var='PAT-';
 
      $new_id=$var.''.$id;
      $GLOBALS['a'] =  $new_id;
 
 add(12);
 
   
   }else{
     
     $var='PAT-';
     $num= '0001';
 
   $new_id=$var.''.$num;
   $GLOBALS['a'] =  $new_id;
 
  add(12);
 
 
   }
 
 
 
    
 
 
 
    
 }







 exit();





?>