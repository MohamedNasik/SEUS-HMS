<!DOCTYPE html>
<html lang="en">
<?php
        // Initialize the session
         session_start();

         include "auth/dbconnection.php";

?>

<!-- change-password224:03-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div id="warns"> </div>

        <div class="account-page">

            <div class="account-center">
                <div class="account-box">

                    <!-- reset password form starts -->
                    <form class="form-signin" action="#">
                        <div class="account-logo">
                            <a href="index-2.php"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="passcode1" autofocus>
                            <small> <span id="passed1" class="info"></span> </small>

                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" id="passcode2" autofocus>
                            <small> <span id="passed2" class="info"></span> </small>

                        </div>

                        <input type="hidden" name="mail" id="mail" value="<?php echo $_GET['email']   ?>">
                        <input type="hidden" name="person" id="person" value="<?php echo $_GET['person']   ?>">

                        <center> <div id="error"> </div> </center> <br>


                        <div class="form-group text-center">
                            <input type="button" class="btn btn-primary account-btn" name="submit" value="Reset Password" id="submit">

                        </div>
                        <div class="text-center register-link">
                            <!-- <a href="login.php">Back to Login</a> -->
                        </div>
                    </form>
                    <!-- form finished -->
                </div>
            </div>
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


            $(document).on('click', '#submit', function () {
                var passcode1 = $('#passcode1').val();
                var passcode2 = $('#passcode2').val();
                var mail = $('#mail').val();
                var person = $('#person').val();

                var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "adminquery/pass_reset.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'passcode1': passcode1,
                            'passcode2': passcode2,
                            'mail': mail,
                            'person': person,

                        },

                        success: function (response) {

                            if ($.trim(response) === 'Password Changed') {

                                // $('#real').html(response);
                                $('#warns').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> The password has changed. <a href="#" class="alert-link"> </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                                setTimeout(function () {
                                    //Redirect with JavaScript
                                    window.location.href = 'login.php';
                                }, 2000);

                            }

                            var passcode1 = $('#passcode1').val('');
                            var passcode2 = $('#passcode2').val('');

                        }

                    });
                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                    var minLength = 8;
                    var value = $("#passcode1").val();

                    if (value.length < minLength) {
                        $("#error").html("(Password contains Minimum 8 Characters)");
                        valid = false;
                    }


                    if (!$("#passcode1").val()) {
                        $("#passed1").html("(Required)");
                        $("#passcode1").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#passcode2").val()) {
                        $("#passed2").html("(Required)");
                        $("#passcode2").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if ($("#passcode1").val() != $("#passcode2").val()) {
                        $("#error").html("(Password do not match)");
                        //$("#password1").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    return valid;
                }

            });

        });



    </script>





</body>


<!-- change-password224:03-->

</html>