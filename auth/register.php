
<?php

session_start();

// Include config file
require_once "dbconnection.php";


if (isset($_POST['email'])) {


  $GLOBALS['first_name'] =$_POST["fname"]; 
  $GLOBALS['last_name'] =$_POST["lname"]; 
  $GLOBALS['address'] ="SEUS Hospital Bandarawela";
  $GLOBALS['dob'] =$_POST["dob"]; 
  $GLOBALS['gender'] =$_POST["gender"]; 
  $GLOBALS['state'] =""; 
  $GLOBALS['contact'] =""; 
  $GLOBALS['nic'] =""; 
  $GLOBALS['prefix'] =$_POST["prefix"]; 
  $GLOBALS['image'] ="user.jpg";

  $GLOBALS['email'] =$_POST["email"]; 
  $password_1=$_POST["password"];
//  $password = password_hash($passwordnormal, PASSWORD_DEFAULT); // Creates a password hash
  $GLOBALS['password'] =md5($password_1);

  
function add($a){
  global $conn;

  $sql= "INSERT INTO users (user_id,prefix,fname,lname,address,state,gender,dob, contact,nic,email,password,image,role_id) 
  VALUES ('". $GLOBALS['a']."','". $GLOBALS['prefix']."','". $GLOBALS['first_name']."','". $GLOBALS['last_name']."','". $GLOBALS['address']."','". $GLOBALS['state']."',  '". $GLOBALS['gender']."','". $GLOBALS['dob']."','".$GLOBALS['contact']."',  '".$GLOBALS['nic']."','". $GLOBALS['email']."', '".$GLOBALS['password']."' , '". $GLOBALS['image']."',  '".$GLOBALS['role_id']."')  ";
  
  if(mysqli_query($conn,$sql) ){
    echo'Successfully saved';
  
  }
  else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  }




}

   $query = "SELECT * FROM roles WHERE role_name = 'admin' ";
   if($result = mysqli_query($conn,$query));
    if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){

      $row['role_id'];
      $row['role_name'];
      $GLOBALS['role_id']= $row['role_id'];
      
  //  search patient wherether they available
  $query = "SELECT * FROM users WHERE role_id='".$GLOBALS['role_id']."' ORDER BY user_id DESC LIMIT 1";
  if($result = mysqli_query($conn,$query));
   if(mysqli_num_rows($result)>0){
   while($row = mysqli_fetch_array($result)){

    $lastid=$row['user_id'];
  }

  $search = 'ADM-' ;


   $trimmed = str_replace($search,'',$lastid) ;


  $srting_trimmed = (string)$trimmed;
   $id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010

   $var='ADM-';

     $new_id=$var.''.$id;
     $GLOBALS['a'] =  $new_id;

add(12);

  
  }else{
    
    $var='ADM-';
    $num= '0001';

  $new_id=$var.''.$num;
  $GLOBALS['a'] =  $new_id;

 add(12);


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
  }

?>