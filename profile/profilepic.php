<?php

// Initialize the session
session_start();
require_once '../auth/dbconnection.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (isset($_POST['image'])) {

    $croped_image = $_POST['image'];
    list($type, $croped_image) = explode(';', $croped_image);
    list(, $croped_image)      = explode(',', $croped_image);
    $croped_image = base64_decode($croped_image);
    $image_name = time().'.png';


 // Valid file extensions
 $allowTypes = array( 'bmp', 'jpg', 'png', 'jpeg' , 'JPG');

// if(in_array($fileType, $allowTypes)){

 $stmt = mysqli_prepare($conn,"UPDATE users SET image = ? WHERE user_id= ?");
 mysqli_stmt_bind_param($stmt, "ss",$image_name, $_SESSION['user_id']);
 $status = $stmt->execute();

 
    // $stmt = $conn->prepare("UPDATE users SET image = ? WHERE user_id= ?");
    // $stmt->bind_param("si", $image_name, $_SESSION['user_id']);
    // $stmt->execute();

    echo  "updated";

    if($stmt->affected_rows === 0);


      file_put_contents('blog/'.$image_name, $croped_image);
    // echo 'Image Uploaded Successfully.';
    



    }else{

        echo "ERROR: Could not prepare query: $stmt. " . mysqli_error($conn);

    }

    $stmt->close();
//    mysqli_stmt_close($stmt);



?>