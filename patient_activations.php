<!DOCTYPE html>
<html lang="en">

<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }

     //  redirect to main page according to the user role 
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
        header("location: index-2.php");
        exit;
     }


     
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
        header("location: index-lab.php");
        exit;
     }

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: index-recep.php");
        exit;
     }





if(isset($_SESSION['p_id'])){
    header("location: patient_appointments.php");
   
 }

require_once 'auth/dbconnection.php';

?>
<!-- lock-screen24:03-->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS- Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert/sweetalert.css">

    <script src="assets/sweetalert/bestsweet.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <script src="assets/sweetalert/sweetalert.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

</head>

<body>
    <div class="main-wrapper error-wrapper">
        <div class="error-box">
            <form action="http://dreamguys.co.in/preclinic/template/index.html">
                <div class="lock-user">
                    <img class="rounded-circle" src="assets/img/user.jpg" alt="">
                    <h5> Check Past History? </h5>
                </div>

                <div class="form-group">
                    <input class="form-control" placeholder="Enter Email" type="text" id="mail">

                </div>
                <div id="error"></div>
<br>
             
                <div id="warn"> </div>
                <div id="wars"> </div>

<div class="form-group text-center">

<input type="button" class="btn btn-primary account-btn" name="login" value="Submit" id="login">
</div>
                
                <div class="text-center">
                    <a href="all_patients.php">Back</a>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function () {


            $(document).on('click', '#login', function () {
                var mail = $('#mail').val();



                var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "doctorquery/verification.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'mail': mail,
                        },



                        success: function (response) {

                            $('#success_mes').html(response);

                            if ($.trim(response) === 'fail') {

                           

$('#warn').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong>     Email ID is wrong or You are not requested this Doctor before <a href="#" class="alert-link">  </a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

}else if ($.trim(response) === 'send fail') {
    $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong>    Email is not sended. Check the server. <a href="#" class="alert-link">  </a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


}else{

setTimeout(function () {
    $('#warn').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> OTP has found. <a href="#" class="alert-link">  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    //Redirect with JavaScript
    window.location.href = 'activation_verifications.php';
}, 2000);


}

                        }

                    });
                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');


                    if (!$("#mail").val()) {
                        $("#error").html("(Required)");
                        //   $("#email").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    return valid;
                }

            });

        });



    </script>



</body>


<!-- lock-screen24:03-->
</html>