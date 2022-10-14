<?php

// Initialize the session
 session_start();

 if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }
 require_once 'auth/dbconnection.php';


?>


<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">



    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>


    <!-- <link rel="stylesheet" href="assets/crop/croppie.css" />
    <script src="assets/crop/croppie.js"></script> -->

   <link rel="stylesheet" href="assets/crop/cropper.css" />
    <script src="assets/crop/cropper.js"></script>



    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">
    <script src="assets/sweetalert/bestsweet.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>

    <style>

.image_area {
  position: relative;
}

img {
      display: inline-block;
      max-width: 100%;
}

.preview {
      overflow: hidden;
      width: 160px; 
      height: 160px;
      margin: 10px;
      border: 1px solid red;
}

.modal-lg{
      max-width: 1000px !important;
      max-height: 1000px !important;

}

.overlay {
  position: absolute;
  bottom: 10px;
  left: 0;
  right: 0;
  background-color: rgba(255, 255, 255, 0.5);
  overflow: hidden;
  height: 0;
  transition: .5s ease;
  width: 100%;
}

.image_area:hover .overlay {
  height: 50%;
  cursor: pointer;
}

.text {
  color: #333;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
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
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>

                <form>
                    <div class="card-box">

                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="user_data">

                                <?php



// Include config file
require_once "auth/dbconnection.php";

$output='';    

$sql1='SELECT u.user_id,u.fname,u.lname,u.address,u.image,u.email FROM users as u  WHERE u.user_id= ?  ';
$stmt1=$conn->prepare( $sql1 );
$stmt1->bind_param( 's',$_SESSION['user_id']  );


$res1=$stmt1->execute();
if( $res1 ){
    $stmt1->store_result();
    $stmt1->bind_result($user_id,$fname,$lname,$address,$image,$email);

    while( $stmt1->fetch() ){
   
        $filepath="profile/blog/";


             
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


$stmt1->free_result();
$stmt1->close();


}


?>




                                </div>


                                <?php
    if( !empty( $_SESSION['user_id'] ) ){



        $sql='select `fname`,`lname`,`dob`,`gender`, `address`,`state`,`contact`,`nic`,`image` from `users` where `user_id`=?';
        $stmt=$conn->prepare( $sql );
        $stmt->bind_param( 's',$_SESSION['user_id'] );


        $res=$stmt->execute();
        if( $res ){
            $stmt->store_result();
            $stmt->bind_result($fname,$lname,$dob,$gender,$address,$state,$contact,$nic,$filename);

            while( $stmt->fetch() ){
                /* 
                    You store the filename ( possibly path too ) 
                    so you need to read the file to find it's
                    raw data which you will use a simage source
                */
                $filepath="profile/blog/";
               
                // printf(
                //     '<img class="inline-block" src="data:image/png;base64, %s" alt="user" />',
                //          base64_encode(file_get_contents($filepath.$filename ) )
                // );      

                ?>



                                <form id="useracc" method="POST">
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">First Name</label>
                                                    <input type="text" class="form-control floating" id="first_name"
                                                        value="<?php echo $fname  ?>">
                                                        
                                                </div>
                                                <span id="fname_info" class="info text-danger"></span>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">Last Name</label>
                                                    <input type="text" class="form-control floating" id="last_name"
                                                        value="<?php echo $lname  ?>">
                                                        
                                                </div>
                                                <span id="lname_info" class="info text-danger"></span>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">Address</label>
                                                    <input type="text" class="form-control floating" id="address"
                                                        value="<?php echo $address  ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-focus">

                                                    <label class="focus-label" for="contact">Contact Number</label>
                                                    <input type="text" class="form-control floating" id="contact"
                                                        maxlength="10" placeholder="tel: input ten numbers"
                                                        value="<?php echo $contact  ?>">
                                                </div>
                                                <div id="error" class="info text-danger"> </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group ">
                                                    <!-- <label class="focus-label">Birth Date</label> -->

                                                    <input class="form-control" id="dobb" type="date"  value="<?php echo $dob  ?>">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">NIC</label>
                                                    <input type="text" class="form-control floating" maxlength="10" id="nic"
                                                        value="<?php echo $nic  ?>">
                                                </div>
                                                <span id="comment" class="info text-danger"></span>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <label class="focus-label">State</label>
                                                    <input type="text" class="form-control floating" id="state"
                                                        value="<?php echo $state  ?>">
                                                </div>
                                            </div>
<br> <br>
                                            <div class="col-md-6">
                                            <strong> Select gender </strong> <br> <br>
                            <div class="form-group">
                                <!-- <label class="display-block">Schedule Status</label> -->
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="yes"  <?php if($gender == "Male") { echo "checked"; }?> value="Male">
                                    <label class="form-check-label" for="product_active"> Male </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input gender" type="radio" name="gender" id="no"  <?php if($gender == "Female") { echo "checked"; }?> value="Female" >
                                    <label class="form-check-label" for="product_inactive"> Female </label>
                                </div>
                            </div>
                                            </div>

                                        </div>
                                        <!-- <a href="dsds">sdsdsd</a> -->

                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="button" class="btn btn-success" id="save"
                                                        value="Save Settings">

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                            </div>
                        </div>
                    </div>


                </form>
                <?php               }
            $stmt->free_result();
            $stmt->close();
            $conn->close();
        }
    }
?>


                <form action="post">
                    <div class="card-box">
                        <h3 class="card-title">Change Password</h3>
                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Current Password</label>
                                    <input type="password" class="form-control floating" id="curpass">
                                </div>
                                <span id="curpass_info" class="info text-danger"></span>
                            </div>



                       
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Confirm Password</label>
                                    <input type="password" class="form-control floating" id="conpass" value="">

                                </div>
                                <span id="conpass_info" class="info text-danger"></span>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">New Password</label>
                                    <input type="password" class="form-control floating" id="newpass" value="">

                                </div>
                                <span id="newpass_info" class="info text-danger"></span>

                            </div>



                        </div>



                        <br>
                        <div class="add-more">
                            <input type="button" class="btn btn-success" id="change" value="Change">
                        </div>

                </form>
            </div>


            <!-- crop image  -->
            <div id="uploadimageModal" class="modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Upload & Crop Image</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 text-center">
                                    <div id="image_demo" style="width:350px; margin-top:30px"></div>
                                </div>
                                <div class="col-md-4" style="padding-top:30px;">
                                    <br />
                                    <br />
                                    <br />
                                    <button class="btn btn-success crop_image">Crop & Upload Image</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Crop Image Before Upload</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>			
		</div>


            
            <div class="sidebar-overlay" data-reff=""></div>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/select2.min.js"></script>
            <script src="assets/js/moment.min.js"></script>
            <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/js/app.js"></script>



            <script>





                // load_data();
                // function load_data() {
                //     $.ajax({
                //         url: "adminquery/fetch/fetch.php", // Url to which the request is send
                //         type: "POST",             // Type of request to be send, called as method

                //         success: function (data) {

                //             $('#user_data').html(data);

                //         }

                //     });

                // }

                // crop image
                // $(document).ready(function () {
                //     $image_crop = $('#image_demo').croppie({
                //         enableExif: true,
                //         viewport: {
                //             width: 150,
                //             height: 150,
                //             type: 'square' //circle
                //         },
                //         boundary: {
                //             width: 300,
                //             height: 300
                //         }


                //     });

                //     $('#upload_image').on('change', function () {
                //         var reader = new FileReader();
                //         reader.onload = function (event) {
                //             $image_crop.croppie('bind', {
                //                 url: event.target.result
                //             }).then(function () {
                //                 console.log('jQuery bind complete');
                //             });
                //         }
                //         reader.readAsDataURL(this.files[0]);
                //         $('#uploadimageModal').modal('show');
                //     });

                //     $('.crop_image').click(function (event) {
                //         $image_crop.croppie('result', {
                //             type: 'canvas',
                //             size: 'viewport'
                //         }).then(function (response) {
                //             $.ajax({
                //                 url: "profile/profilepic.php",
                //                 type: "POST",
                //                 data: { "image": response },
                //                 success: function (data) {
                //                     $('#uploadimageModal').modal('hide');
                //                     $('#uploaded_image').html(data);

                //                     load_data();

                //                 }




                //             });



                //         })

                //     });




                // });  

// new 

$(document).ready(function(){

var $modal = $('#modal');

var image = document.getElementById('sample_image');

var cropper;

$('#upload_image').change(function(event){
    var files = event.target.files;

    var done = function(url){
        image.src = url;
        $modal.modal('show');

        
    };

    if(files && files.length > 0)
    {
        reader = new FileReader();
        reader.onload = function(event)
        {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview:'.preview'
    });
}).on('hidden.bs.modal', function(){
    cropper.destroy();
       cropper = null;
});

$('#crop').click(function(){
    canvas = cropper.getCroppedCanvas({
        width:400,
        height:400
    });

    canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
            var base64data = reader.result;
            $.ajax({
                url: "profile/profilepic.php",
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                    $modal.modal('hide');
                    $("#uploaded_image").load(location.href + " #uploaded_image");
                     location.reload(true);
                    // load_data();
                               

                 
                }
            });
        };
    });
});

});







            </script>

<script>
$("#nic").on("keyup", function (a) {
            let inputElement = document.getElementById("nic");
  let divElement = document.getElementById("comment");
  var message = "";

  let inputValue = inputElement.value.trim();
  let pattern = new RegExp(/^\d{9}[a-zøæ]{1}/, "i");
  
  if (isValid(inputValue, pattern)) {
    message = "Correct NIC Number" 
    $('input[id=save]').prop('disabled', false);

  }else if(a.target.value.length === 0){
    var message = "";
    $('input[id=save]').prop('disabled', false);
  }
  else{
    $('input[id=save]').prop('disabled', true);
    message = "Wrong NIC Number"  

  }

  
  
  divElement.innerHTML = message;

  function isValid(str, pattern) {
  return str.match(pattern);
}



        });




$(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#dob').attr('max', maxDate);
});





</script>




            <script>

                $(document).ready(function () {


                    $("#contact").on("keyup", function (e) {
                        e.target.value = e.target.value.replace(/[^\d]/, "");
                        if (e.target.value.length === 10) {
                            // do stuff
                            var ph = e.target.value.split("");
                            ph.splice(3, 0, "-"); ph.splice(7, 0, "-");

                            // $("label").html(ph.join(""))
                            $('input[id=save]').prop('disabled', false);
                            $('#error').html('');

                        }else if(e.target.value.length === 0) {
                          // do stuff
                          var ph = e.target.value.split("");
                            ph.splice(3, 0, "-"); ph.splice(7, 0, "-");

                            // $("label").html(ph.join(""))
                            $('input[id=save]').prop('disabled', false);
                            $('#error').html('');

                        } else{

                            $('input[id=save]').prop('disabled', true);
                            $('#error').html('Contact Number should be 10 digits');


                        }


                    });



// edit profile
                    $(document).on('click', '#save', function () {

                        var fname = $('#first_name').val();
                        var lname = $('#last_name').val();
                        var contact = $('#contact').val();
                        var dob = $('#dobb').val();
                        var address = $('#address').val();
                        var state = $('#state').val();
                        var nic = $('#nic').val();


                        var valid;
                        valid = validateContact();

                        if (valid) {
                            
                        swal({
                            title: "Are you sure?",
                            text: "You wanna edit your profile!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Yes, Update It!",
                            closeOnConfirm: false
                        },
                            function (isConfirm) {
                                if (!isConfirm) return;
                                $.ajax({
                                    url: "doctorquery/update_profile.php", // Url to which the request is send
                                    method: "POST",             // Type of request to be send, called as method
                                    data: {

                                        'fname': fname,
                                        'lname': lname,
                                        'dob': dob,
                                        'address': address,
                                        'state': state,
                                        'contact': contact,
                                        'nic': nic,

                                    },

                                    success: function (response) {
                                        // $("success_mes").fadeIn().html(response);
                                        if ($.trim(response) === 'Successfully Updated') {

                                        swal("Saved!", "Your Profile has updated", "success");
                                    }else{
                                        swal("Sorry!", "Somthing went wrong !!", "error");''
                                    }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        swal("Error Saved!", "Please try again", "error");
                                    }

                                });

                            });

                        };

        // check validations
        function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    if (!$("#last_name").val()) {
                        $("#lname_info").html("(Last name is required)");
                        $("#last_name").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#first_name").val()) {
                        $("#fname_info").html("(First name is required)");
                        $("#first_name").css('background-color', '#FFFFDF');
                        valid = false;
                    }

        
                    return valid;
                }





                    });


                    // change password to database
                    $(document).on('click', '#change', function () {

                        var curpass = $('#curpass').val();
                        var newpass = $('#newpass').val();
                        var conpass = $('#conpass').val();

                        var valid;
                        valid = validateContact();

                        if (valid) {

                            swal({
                                title: "Are you sure?",
                                text: "You wanna change this Password!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Yes, Change It!",
                                closeOnConfirm: false
                            },
                                function (isConfirm) {
                                    if (!isConfirm) return;
                                    $.ajax({
                                        url: "profile/update_pass.php", // Url to which the request is send
                                        type: "POST",             // Type of request to be send, called as method
                                        data: {
                                            'curpass': curpass,
                                            'newpass': newpass,
                                            // 'conpass': conpass,

                                        },


                                        success: function (data) {
                                            if (data == 'Password Changed') {
                                                swal("Success", "Password has been changed :)", "success");

                                                $('#curpass').val('');
                                                $('#newpass').val('');
                                                $('#conpass').val('');
                                            } else {
                                                //our handled error
                                                swal("Sorry", "Failed to change password. Try it by correct password :(", "error");
                                            }
                                        },
                                        error: function (data) {
                                            //other errors that we didn't handle
                                            swal("Sorry", "Failed to send order. Please try later :(", "error");
                                        }


                                    });

                                });



                        };

                        // check validations
                        function validateContact() {
                            var valid = true;
                            $(".demoInputBox").css('background-color', '');
                            $(".info").html('');


                            if (!$("#curpass").val()) {
                                $("#curpass_info").html("(Required)");
                                $("#curpass").css('background-color', '#FFFFDF');
                                valid = false;
                            }

                            if (!$("#newpass").val()) {
                                $("#newpass_info").html("(Required)");
                                $("#newpass").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if (!$("#conpass").val()) {
                                $("#conpass_info").html("(Required)");
                                $("#conpass").css('background-color', '#FFFFDF');
                                valid = false;
                            }
                            if ($("#curpass").val() != $("#conpass").val()) {
                                $("#conpass_info").html("(Password do not match)");
                                //$("#password1").css('background-color', '#FFFFDF');
                                valid = false;
                            }


                            return valid;
                        }

                    });







                });

            </script>











</body>


<!-- edit-profile23:05-->

</html>