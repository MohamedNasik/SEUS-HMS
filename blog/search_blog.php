<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";

if (isset($_POST['search_text'])) {


$search_text = "%{$_POST['search_text']}%";


$output='';    

//  search blogs
$stmt = $conn->prepare("SELECT * FROM blog WHERE status='Active' AND  (title LIKE ? OR sub_title LIKE ?) ");
$stmt->bind_param( 'ss',$search_text,$search_text);

  $stmt->execute();
   $result = $stmt->get_result();
   if(mysqli_num_rows($result)>0){
   while($row = $result->fetch_assoc()) {
            /* 
                You store the filename ( possibly path too ) 
                so you need to read the file to find it's
                raw data which you will use a simage source
            */
            $filepath="../assets/img/blog_images/";
            $image=$row['image'];

            $sub_title=$row['sub_title'];
            $title=$row['title'];
            $published=$row['published'];
            $blog_id=$row['blog_id'];
            $username=$row['publisher'];
            $body=$row['body'];

            $title= substr($title,0,30);
             $body= substr($body,0,500);
             
             $date=   date('dS F Y', strtotime($published));

             
$output .=  '
<div class="col-sm-4 col-md-4 col-lg-4" >

<div class="blog grid-blog">
    <div class="blog-image">
        <a href="#">';

        $output .=  '<img style="height:190px; width:330px;" class="img-fluid" src="data:image/png;base64, '.base64_encode(file_get_contents($filepath.$image) ).'" alt="" />'; 
        //  base64_encode(file_get_contents($filepath.$image) ) ;     
     
         $output .=  '
  </a>
    </div>
    <div class="blog-content">
        <h3 class="blog-title"><a href="blog-details.html">
        '.$title.'
         </a></h3>
         <p> <code>    '.$sub_title.'  </code> </p> <br>
         <a href="#."><i class="fa fa-user-md"></i> <span>  '.$username.' </span></a>
        <div class="blog-info clearfix">
            <div class="post-left">
                <ul>
                    <li><a href="#."><i class="fa fa-calendar"></i> <span>'.$date.'</span></a></li>
                </ul>
            </div>
            <div class="post-right">
            
            <a href="blog-details.php?blogid='.$blog_id .'"><i class="fa fa-eye"></i> </a>
             </div>
        </div>
    </div>

   
    </div>
</div>';



}

echo $output;


$stmt->free_result();
$stmt->close();
$conn->close();

}else{

    
    echo '<center> Ooops !!! No any blogs found </center> ';  


}

}



?>