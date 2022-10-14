<?php

session_start();

// Include config file
require_once "../auth/dbconnection.php";

$output='';    

    $sql='select `image`,`title`,`sub_title`,`publisher`,`blog_id`,`body`,`created_at`,`status` from `blog` WHERE user_id=? ';
    $stmt=$conn->prepare( $sql );
    $stmt->bind_param( 's',$_SESSION['user_id'] );


    $res=$stmt->execute();
    if( $res ){
        $stmt->store_result();
        $stmt->bind_result($image,$title,$sub_title, $publisher, $blog_id,$body,$created_at,$status);

        while( $stmt->fetch() ){
            /* 
                You store the filename ( possibly path too ) 
                so you need to read the file to find it's
                raw data which you will use a simage source
            */
            $filepath="../assets/img/blog_images/";

            $title= substr($title,0,30);
             $body= substr($body,0,500);
             
             $date=   date('dS F Y', strtotime($created_at));

             
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
        <h3 class="blog-title"><a href="#">
        '.$title.'
         </a></h3>
        <p>  <code>   </code>  </p> <br>
        <a href="blog-details.php?blogid='.$blog_id .'" class="read-more"> <i class="fa fa-long-arrow-right"></i> Read More</a>';
       
        if ($status =='Active') {
            $output .=  '   <div class="post-right"> <a href="#"><i class="fa fa-check-circle"></i> </a> </div>';

        }else{

            $output .=  '   <div class="post-right"> <a href="#"><i class="fa fa-times-circle"></i> </a> </div>'; 
        }

        $output .=  ' <div class="blog-info clearfix">
            <div class="post-left">
                <ul>
                    <li><a href="#."><i class="fa fa-calendar"></i> <span>'.$date.'</span></a></li>
                </ul>
            </div>
            <div class="post-right"> </a><a href="blog-details.php?blogid='.$blog_id .'"><i class="fa fa-eye"></i> </a> <a href="edit-blog.php?blog_id='.$blog_id .'"><i class="fa fa-pencil"></i> </a> <a href=""  data-toggle="modal" id="rep2" data_id= '.$blog_id.' data-target="#delete_blog"  ><i class="fa fa-trash-o"></i> </a></div>
        </div>
    </div>

   
    </div>
</div>';



}

echo $output;


$stmt->free_result();
$stmt->close();
$conn->close();

}


?>