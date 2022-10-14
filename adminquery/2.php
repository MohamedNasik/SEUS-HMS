
<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";

if (isset($_POST['fname'])) {

  $GLOBALS['first_name'] = $_POST["fname"];
  $GLOBALS['last_name'] = $_POST["lname"];




   function add($a){
    global $conn;
    $sql= "INSERT INTO a (id,fname,lname) 
    VALUES ('".$GLOBALS['a']."','". $GLOBALS['first_name']."','". $GLOBALS['last_name']."')  ";
    
    if(mysqli_query($conn,$sql) ){
      echo'Successfully Saved';
  
    }
    else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }


  }
  

  $query = "SELECT * FROM a ORDER BY id DESC LIMIT 1";
  if($result = mysqli_query($conn,$query));
   if(mysqli_num_rows($result)>0){
   while($row = mysqli_fetch_array($result)){
 $lastid=$row['id'];
  }
  $search = 'USR-' ;


   $trimmed = str_replace($search,'',$lastid) ;

  //  $int_trimmed = (int)$trimmed;
  //  $int_trimmed=$int_trimmed + 1;
  //  $int_trimmed = (string)$int_trimmed;


  $srting_trimmed = (string)$trimmed;
   $id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010

   $var='USR-';

     $new_id=$var.''.$id;
     $GLOBALS['a'] =  $new_id;
add(12);

  
  }else{
    
    $var='USR-';
    $num= '0001';

  $new_id=$var.''.$num;
  $GLOBALS['a'] =  $new_id;

 add(12);


  }



// Close connection
mysqli_close($conn);
exit();
  }




 ?>