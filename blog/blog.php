<?php

session_start();
require_once "../auth/dbconnection.php";

if (isset($_POST['blog_title'])) {
 
    $croped_image = $_POST['image'];
    list($type, $croped_image) = explode(';', $croped_image);
    list(, $croped_image)      = explode(',', $croped_image);
    $croped_image = base64_decode($croped_image);
    $image_name = time().'.png';


 // Valid file extensions
 $allowTypes = array('gif', 'bmp', 'jpg', 'png', 'jpeg' , 'JPG');

// insert blogs 
    if($stmt = mysqli_prepare($conn,"INSERT INTO blog (user_id,publisher,title,sub_title,blog_category,image,body,published,created_at,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){

        $cur_date = date('Y-m-d H:i:s');

        // if($_POST["status"]='active'){
        $publised_date=date('Y-m-d H:i:s');  

        $user_id= $_SESSION['user_id'];
        $publisher= $_SESSION['usernames'];
        $title=$_POST["blog_title"];
        $sub_title=$_POST["blog_sub_title"];
        $blog_category= $_POST["blog_cat"];
        $editor1= $_POST["body"];
        $published= $publised_date;
        $created_at= $cur_date;
        // $tags= $_POST["tags"];
        $status= $_POST["blog_status"];

        mysqli_stmt_bind_param($stmt, "ssssssssss",$user_id,$publisher,$title,$sub_title,$blog_category,$image_name,$editor1,$published,$created_at,$status);

       echo "Records inserted successfully.";
       file_put_contents('../assets/img/blog_images/'.$image_name, $croped_image);
    // echo 'Image Uploaded Successfully.';

      mysqli_stmt_execute($stmt);
      
} else{

    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);


}


    }else{

        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

    }


//    mysqli_stmt_close($stmt);

?>