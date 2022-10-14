<!DOCTYPE html>
<html lang="en">


<!-- forgot-password24:03-->

<head>
    <meta charset="utf-8">
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

    <div class="main-wrapper account-wrapper">
        <div id="warn"> </div>

        <div class="account-page">
            <div class="account-center">
                <div class="account-box">

<!-- form starts -->
                    <form class="form-signin" action="#">
                        <div class="account-logo">
                            <a href="index-2.html"><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" class="form-control" id="email" autofocus>
                        </div>
                        <div class="form-group text-center">

                            <input type="button" class="btn btn-primary account-btn" name="reset" value="Reset Password"
                                id="reset">
                        </div>
                        <div class="text-center register-link">
                            <a href="login.php">Back to Login</a>
                        </div>
                    </form>
                    <!-- form ends -->
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

        //    start query
        $(document).ready(function () {

            // forgot password ajax query
            $(document).on('click', '#reset', function () {

                var email = $('#email').val();

                var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "adminquery/reset.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {

                            'email': email,

                        },

                        success: function (response) {

                            if ($.trim(response) === 'Password Sent') {

                                $('#warn').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> The activation code has sent to your <a href="#" class="alert-link"> Mail. </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                            } else {
                                //our handled error
                                $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> Failed to sent activation code. Try it by correct email :( <a href="#" class="alert-link"></a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                            }

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal("Error Saved!", "Please try again", "error");
                        }

                    });

                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');


                    if (!$("#email").val()) {
                        $("#email_info").html("(Required)");
                        $("#email").css('background-color', '#FFFFDF');
                        valid = false;
                    }
                    if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                        $("#email_info").html("(Invalid Email Address)");
                        $("#email").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    return valid;
                }

            });



        });




    </script>






</body>


<!-- forgot-password24:03-->

</html>