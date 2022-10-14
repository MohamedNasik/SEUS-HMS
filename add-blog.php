<!DOCTYPE html>
<html lang="en">

<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

    //  redirect to main page according to the user role 

    if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: index-recep.php");
        exit;
     }
     
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
        header("location: index-lab.php");
        exit;
     }



        ?>

<!-- add-blog23:56-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/tagsinput.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/summernote/summernote.css">
    <link rel="stylesheet" href="assets/crop/croppie.css" />

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">
    <script src="assets/sweetalert/bestsweet.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>


    <style type="text/css">
        input[type=file] {
            display: inline;
        }

        /* #image_preview{
      border: 1px solid black;
      padding: 1px;
    } */
        #image_preview img {
            width: 120px;
            height: 100px;
        }
    </style>




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
                        <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                            Profile</a>
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
                    <a class="dropdown-item" href="profile.php?userid=<?php echo $_SESSION['user_id']   ?>">My
                        Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                    <a class="dropdown-item" href="auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
        <?php

if( $_SESSION['role_id']=='1'){
    include ('sidebar/adminsidebar.php');
  } if( $_SESSION['role_id']=='2'){
  
      include ('sidebar/doctorsidebar.php');
  
  } if( $_SESSION['role_id']=='3'){
  
      include ('sidebar/laboratorist.php');
  
  }
  if( $_SESSION['role_id']=='4'){
      include ('sidebar/receptionist.php');
  }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Blog</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post" enctype="multipart/form-data" id="blog_post">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="blog_title" id="blog_title">
                                <span id="blogtitle" class="info text-danger"></span>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub Title <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="blog_sub_title"
                                            id="blog_sub_title">
                                        <span id="blogsub" class="info text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Blog Category <span class="text-danger">*</span></label>
                                        <select class="select" name="blog_cat" id="blog_cat">
                                            <option value="select">Select</option>
                                            <option>Health Care</option>
                                            <option>Child</option>
                                            <option>Hospital</option>

                                        </select>
                                        <span id="select_cat" class="info text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Blog Description <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <textarea class="summernote hidden" id="body"
                                        placeholder="Type Your Message.."></textarea>
                                    <span id="blogbody" class="info text-danger"></span>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label>Tags </label>
                                <input type="text" placeholder="Enter your tags" data-role="tagsinput"
                                    class="form-control" id="tags" name="tags">
                                <span id="blogtags" class="info text-danger"></span>

                            </div> -->

                            <div class="form-group">
                                <label>Blog Images <span class="text-danger">*</span></label>
                                <div>
                                    <input class="form-control" type="file" name="image" id="image">
                                    <small class="form-text text-muted">Allowed images: jpg, gif, png.</small>
                                    <span id="blogimage" class="info text-danger"></span>

                                </div>

                                <p id="error1" style="display:none; color:#FF0000;">
                                    Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                                </p>
                                <br>

                                <p id="error2" style="display:none; color:#FF0000;">
                                    Maximum File Size Limit is 5MB.
                                </p>

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                    </div>
                                    <div class="col-md-4" style="padding-top:30px;"> </div>
                                </div>

                                <div class="form-group">
                                    <label class="display-block">Blog Status <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input blog_status " type="radio" name="blog_status" id="blog_status"  value="Active" >
                                        <label class="form-check-label" for="blog_active">
                                        Active
                                        </label>
                                        </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input blog_status" type="radio" name="blog_status" id="blog_status"  value="Inactive" checked>
                                        <label class="form-check-label" for="blog_inactive">
                                        Inactive
                                        </label>
                                    </div>
                                </div>

                         
                                <div class="m-t-20 text-center">
                                <input type="button" id="publish" name="publish" class="btn btn-primary submit-btn" value="Publish Blog">
                            </div>
                        </form>

                        <div id="preview"></div>



                    </div>
                </div>
            </div>

           
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/crop/croppie.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/tagsinput.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/summernote/summernote.js"></script>


    <script>
    $(document).ready(function() { 
      $('.summernote').summernote({
        height: 300,
        tabsize: 2
      });
	  
	   $('input[type="file"]').imageuploadify();
    });


// desable button for unsuitable select image
$(document).ready(function () {
$('input[type="button"]').prop("disabled", true);
var a=0;

//binds to onchange event of your input field
$('#image').bind('change', function() {

if ($('input:button').attr('disabled',false)){

 $('input:button').attr('disabled',true);

 }

var ext = $('#image').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
 $('#error1').slideDown("slow");
 $('#error2').slideUp("slow");
 a=0;

 }else{

 var picsize = (this.files[0].size);

 
 if (picsize > 5000000){
 $('#error2').slideDown("slow");
 a=0;
 }else{
 a=1;
 $('#error2').slideUp("slow");
 }
 $('#error1').slideUp("slow");
 if (a==1){
 $('input:button').attr('disabled',false);
 }

}

});


  // save BLOG to database
  $(document).on('click', '#publish', function () {


            var blog_sub_title = $('#blog_sub_title').val();
            var blog_title = $('#blog_title').val();
            var blog_cat = $('#blog_cat').val();
            var body = $('#body').val();
            // var tags = $('#tags').val();
            var blog_status = $("#blog_status:checked").val();



      var valid;
      valid = validateContact();

      if (valid) {

        swal({
            title: "Are you sure?",
            text: "Publish this Blog?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes, Save It!",
            closeOnConfirm: false
            },


        function(isConfirm){
             if (!isConfirm) return;

      $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){

          $.ajax({
              url: "blog/blog.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
              data: {
                'blog_title': blog_title,  
                'blog_sub_title': blog_sub_title,
                    'blog_cat': blog_cat,
                    'body': body,
                    // 'tags': tags,
                    'blog_status': blog_status,
                    'image':response
              },             
        

              success: function (response) {
                if ($.trim(response) === 'Records inserted successfully.') {


                swal("Saved!", "The blog has Updated", "success");


                  $('#blog_title').val('');
                  $('#blog_sub_title').val('');
                  $('#blog_cat').val('');
                  $('#image').val('');
                  $('#body').val('');
                //   $('#tags').val('');
                  $('#blog_status').val('');

                  setTimeout(function () {
          //Redirect with JavaScript
             window.location.href= 'blogs.php';
}, 2000);

}else{
          swal("Sorry!", "Somthing went wrong !!", "error");''
        }



                },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error Saved!", "Please try again", "error");
            }

          });
        })

});

      };

      // check validations
      function validateContact() {
          var valid = true;
          $(".demoInputBox").css('background-color', '');
          $(".info").html('');

          if (!$("#blog_title").val()) {
              $("#blogtitle").html("(required)");
            //  $("#username").css('background-color', '#FFFFDF');
              valid = false;
          }
          if (!$("#blog_sub_title").val()) {
              $("#blogsub").html("(Required)");
           //   $("#email").css('background-color', '#FFFFDF');
              valid = false;
          }


        //   if (!$("#tags").val()) {
        //       $("#blogtags").html("(Required)");
        //    //   $("#password").css('background-color', '#FFFFDF');
        //       valid = false;
        //   }
          if (!$("#body").val()) {
              $("#blogbody").html("(Required)");
            //   $("#password1").css('background-color', '#FFFFDF');
              valid = false;
          }
          if ($("#blog_cat").val() == 'select') {
              $("#select_cat").html("(Please select appropriate type)");
              // $("#password1").css('background-color', '#FFFFDF');
              valid = false;
          }

          
          return valid;
      }
  });


});

    </script>



<script> 
//  ajax query for upload image 
$(document).ready(function(){

	$image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width:650,
      height:390,
      type:'square' //circle
    },
    boundary:{
      width:690,
      height:450
    }
  });

  $('#image').on('change', function(){
    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    $('#uploadimageModal').modal('show');
  });



});  
</script>


</body>


<!-- add-blog23:57-->

</html>