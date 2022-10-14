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
 
//  edit update blogs
        if($stmt = mysqli_prepare($conn,"UPDATE blog SET title = ? ,sub_title = ?,blog_category = ? , image = ?,body = ?,published = ?,status = ? WHERE blog_id = ?")){
            
        // if($_POST["status"]='active'){

        $publised_date=date('Y-m-d H:i:s');  

        $title=$_POST["blog_title"];
        $sub_title=$_POST["blog_sub_title"];
        $blog_category= $_POST["blog_cat"];
        $body= $_POST["body"];
        $published= $publised_date;
        // $tags= $_POST["tags"];
        $blog_id= $_POST["blog_id"];
        $status= $_POST["blog_status"];
        
        mysqli_stmt_bind_param($stmt,"ssssssss",$title,$sub_title,$blog_category,$image_name,$body,$published,$status,$blog_id);

       echo "Records Updatetd successfully.";
       file_put_contents('../assets/img/blog_images/'.$image_name, $croped_image);

      mysqli_stmt_execute($stmt);

} else{


}


    }else{

        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);

    }


    mysqli_stmt_close($stmt);

?>