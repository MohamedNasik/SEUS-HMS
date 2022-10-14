<!DOCTYPE html>
<html lang="en">

<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }
require_once 'auth/dbconnection.php';

?>

<!-- blog23:34-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/jquery-3.2.1.min.js"></script>

</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="#" class="logo">
                <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>SEUS HMS</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i>
                        <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                 
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span>You</span>
                    </a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                        <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                        <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="auth/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php

if( $_SESSION['role_id']=='1'){
    include ('sidebar/adminsidebar.php');
            }  if( $_SESSION['role_id']=='2'){
                include ('sidebar/doctorsidebar.php');
            }
          if( $_SESSION['role_id']=='3'){
            include ('sidebar/laboratorist.php');
        }
        if( $_SESSION['role_id']=='4'){
            include ('sidebar/receptionist.php');
        }



?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-8 col-4">
                        <h4 class="page-title">Blog</h4>
                    </div>

                </div>
                <div class="row">

                    <aside class="col-lg-12">
                        <div class="widget search-widget">
                            <h4>Blog Search</h4>
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search with Blog Title Name" class="form-control" id="search"
                                        onblur="checkemail();" onkeyup="checkemail();" onchange="checkemail();">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>


                <div class="row" id="lists">



                    <?php

  $sql='select `image`,`title`,`sub_title`,`publisher`,`blog_id`,`body`,`published` from `blog` WHERE status="Active" ORDER BY  blog_id DESC LIMIT 5';
  $stmt=$conn->prepare( $sql );
 // $stmt->bind_param( 's',$_SESSION['user_id'] );


  $res=$stmt->execute();
  if( $res ){
      $stmt->store_result();
      $stmt->bind_result($image,$title,$sub_title, $publisher, $blog_id,$body,$published);

      while( $stmt->fetch() ){
   
          $filepath="assets/img/blog_images/";
          $date=   date('dS F Y', strtotime($published));
          $title= substr($title,0,30);
          ?>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="#">
                                    <?php     printf(
                    '<img style="height:190px; width:330px;" class="img-fluid" src="data:image/png;base64, %s" alt="" />',
                         base64_encode(file_get_contents($filepath.$image ) ) );  ?>

                                </a>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="blog-details.php?blogid= <?php  echo $blog_id  ?> "><?php echo $title   ?></a></h3>
                                <p> <code>  <?php echo $sub_title   ?> </code> </p> <br>
                                <a href="#."><i class="fa fa-user-md"></i> <span><?php echo $publisher   ?></span></a>


                                <div class="blog-info clearfix">

                                    <div class="post-left">
                                        <ul>
                                            <li><a href="#."><i class="fa fa-calendar"></i>
                                                    <span><?php echo $date   ?></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="post-right">
                                    <!-- <a href="#."><i class="fa fa-heart-o"></i></a>  -->
                                    <a href="blog-details.php?blogid= <?php  echo $blog_id  ?> "><i
                                                class="fa fa-eye"></i></a> 
                                                <!-- <a href="#."><i class="fa fa-comment-o"></i></a> -->
                                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php               }
            $stmt->free_result();
            $stmt->close();
            $conn->close();
        }
   
?>

                </div>
            </div>

    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>


    <script>

        function checkemail() {

            var search_text = document.getElementById("search").value;

            if (search) {

                $.ajax({
                    type: 'post',
                    url: "blog/search_blog.php", // Url to which the request is send
                    data: {
                        search_text: search_text,
                    },

                    success: function (response) {

 

                        $('#lists').html(response);

                    }
                });
            }
            else {

                return false;

            }
        }

    </script>



</body>


<!-- blog23:51-->

</html>