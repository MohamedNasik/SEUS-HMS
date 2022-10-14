<!DOCTYPE html>
<html lang="en">
<?php

session_start();

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
        <!--  activation code form starts -->
            <form action="#">
                <div class="lock-user">
                    <img class="rounded-circle" src="assets/img/user.jpg" alt="">
                    <h6>Enter your activation code</h6>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Enter code" type="text" id="passcode">
                </div>
                <input type="hidden" name="mail" id="mail" value="<?php echo $_GET['email']   ?>">
                <input type="hidden" name="person" id="person" value="<?php echo $_GET['personid']   ?>">

                <div id="warn"> </div>

                <div class="form-group text-center">

<input type="button" class="btn btn-primary account-btn" name="login" value="Submit" id="login">
</div>

                <div class="text-center">

                </div>
            </form>
            <!-- form finished -->
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
                var passcode = $('#passcode').val();
                var mail = $('#mail').val();
                var person = $('#person').val();



                var valid;
                valid = validateContact();

                if (valid) {

                    $.ajax({
                        url: "adminquery/passcode.php", // Url to which the request is send
                        type: "POST",             // Type of request to be send, called as method
                        data: {
                            'passcode': passcode,
                            'mail': mail,
                            'person': person,

                        },



                        success: function (response) {

                            $('#success_mes').html(response);

                            if ($.trim(response) === 'Success') {

                                $('#warn').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> The activation code is found. <a href="#" class="alert-link">  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


                                setTimeout(function () {
                                    //Redirect with JavaScript
                                    window.location.href = 'change-password2.php?email=<?php echo $_GET['email']   ?>&person=<?php echo $_GET['personid']   ?>';
                                }, 2000);


                            }else if ($.trim(response) === 'Wrong Activation code'){

                                $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> The activation code is wrong. <a href="#" class="alert-link">  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


                            }else{

                                $('#warn').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> Something went wrong. <a href="#" class="alert-link">  </a>.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');


                            }



                        }

                    });
                };

                // check validations
                function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');


                    if (!$("#passcode").val()) {
                        $("#passed").html("(Required)");
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