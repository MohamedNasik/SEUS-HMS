<html>

<?php
        // Initialize the session
         session_start();
         
        //  redirect to main page according to the user role 
         if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
            header("location: index-2.php");
            exit;
         }

         if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2){
            header("location: index.php");
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
        
        ?>

<!-- login23:11-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</head>

<body>
    <div id="box">
        <div class="main-wrapper account-wrapper">
            <div class="account-page">
                <div class="account-center">

                    <div class="account-box">
<!-- login form starts -->
                        <form method="POST" class="form-signin">
                            <div class="account-logo">
                                <img src="assets/img/logo-dark.png" alt="">
                            </div>
                            <div class="form-group">
                                <label> Email</label>
                                <input type="email" name="email" id="email" autofocus="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group text-right">
                                <a href="forgot-password.php">Forgot your password?</a>
                            </div>
                            <div class="form-group text-center">
                                <input type="button" class="btn btn-primary account-btn" name="login" value="LOGIN" id="login_button">
                            </div>
                            <center>
                                <div id="error"> </div>
                            </center>
                            <center>
                                <div id="requered"> </div>
                            </center>


                            <div class="text-center register-link">
                                <!-- Don’t have an account? <a href="register.php">Register Now</a> -->
                            </div>
                        </form>
                        <!-- form ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>


    <script>


        $(document).ready(function () {
            $('#login_button').click(function () {

                var email = $('#email').val();
                var password = $('#password').val();

                if ($.trim(email).length > 0 && $.trim(password).length > 0) {
                    $.ajax({

                        type: "POST",  // Type of request to be send, called as method
                        url: "auth/logged.php", // Url to which the request is send
                        data: { "email": email, "password": password },
                        cache: false,

                        beforeSend: function () {
                            $('#login_button').val("connecting.....");
                        },
                        success: function (data) {
                            console.log(data);
                            if (data) {

                                if (data == "admin") { // if the response is 1
                                    window.location.replace('index-2.php');
                                    return true;
                                } if (data == "doctor") {
                                    window.location.replace('index.php');
                                    return true;
                                }

                                if (data == "laboratorist") {
                                    window.location.replace('index-lab.php');
                                    return true;
                                }

                                if (data == "receptionist") {
                                    window.location.replace('index-recep.php');
                                    return true;
                                }

                            } else {


                                $('#login_button').val('Login');
                                $('#error').html("<span class='text-danger'> Invalid email or password </span>");


                            }

                        }


                    });



                } else {


                    $('#requered').html("<span class='text-danger'> Both fields are requered </span>");



                }



            });

        });



    </script>



</body>


</html>