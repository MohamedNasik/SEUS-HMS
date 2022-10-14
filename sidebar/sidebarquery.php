<?php      

require_once 'auth/dbconnection.php';

$sql = "SELECT type FROM users WHERE user_id = '".$_SESSION["user_id"]."' ";
    if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        
        $row['type'];

if($row['type']=='doctor'){

include ('sidebar/doctorsidebar.php');
}

if($row['type']=='admin'){

include ('sidebar/adminsidebar.php');

}

}
 mysqli_free_result($result);
       
 } 
  else{
        echo "No records matching your query were found.";
       }
       }
    


        ?>
