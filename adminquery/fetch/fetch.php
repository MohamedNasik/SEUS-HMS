<?php

session_start();

// Include config file
require_once "../../auth/dbconnection.php";

$output='';    

    
$sql='SELECT u.user_id,u.fname,u.lname,u.address,u.image,u.email FROM users as u  WHERE u.user_id= ?  ';
$stmt=$conn->prepare( $sql );
$stmt->bind_param( 's',$_SESSION['user_id']  );


$res=$stmt->execute();
if( $res ){
    $stmt->store_result();
    $stmt->bind_result($user_id,$fname,$lname,$address,$image,$email);

    while( $stmt->fetch() ){
   
        $filepath="../../profile/blog/";


             
$output .= '

<div class="image_area">

<div class="profile-img-wrap">';

$output .=  '<img class="inline-block" src="data:image/png;base64, '.base64_encode(file_get_contents($filepath.$image) ).'" alt="" />'; 
$output .= '
<div class="fileupload btn">
    <span class="btn-text">Change</span>
    <input class="upload" type="file" name="upload_image" id="upload_image">
    </div></div>
</div>';


}

echo $output;


$stmt->free_result();
$stmt->close();
$conn->close();

}


?>