<!DOCTYPE html>
<html lang="en">


<?php
        // Initialize the session
         session_start();

         if(isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>

<!-- register24:03-->

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">

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
    <div class="main-wrapper  account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">

                    <form method="POST" id="poster" class="form-signin">
                        <div class="account-logo">
                            <a><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>

                        <div class="form-group">
                            <label>Select Prefix</label>
                            <select class="select" id="prefix" name="prefix">
                              <option value="Select">Select</option>
                              <option value="Mr.">Mr.</option>
                              <option value="Ms.">Ms.</option>
                              <option value="Prof.">Prof.</option>

                             </select>   
                        <span id="prefix_info" class="info text-danger"></span>

                        </div>

                        <div class="row">



                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" id="fname" class="form-control">
                            <span id="fname-info" class="info text-danger"></span>
                        </div></div>
                        
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" name="lname" id="lname" class="form-control">
                            <span id="lname-info" class="info text-danger"></span>
                        </div></div>
                        
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" onblur="checkemail();" onkeyup="checkemail();" onchange="checkemail();">
                            <span id="userEmail-info" class="info"></span>
                            <span id="email_status" name="email_status"></span>

                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <span id="pass" class="info text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password1" id="password1" class="form-control">
                            <span id="pass1" class="info text-danger"></span>
                            <span id="invalid" class="info text-danger"></span>

                            </div>

                       
                         <div class="form-group">
                           <label>Date Of Birth</label>
                            <input class="form-control date" type="date" id="date" name="date">
                            <span id="dobs" class="info text-danger"></span>
                         </div>
                        

                            <strong> Select gender  </strong>  <br>   <br> 
                                
                                <div class="form-group">
                               <!-- <label class="display-block">Schedule Status</label> -->
                               <div class="form-check form-check-inline">
                               <input class="form-check-input gender" type="radio" name="gender" id="yes" value="Male">
                                   <label class="form-check-label" for="product_active">
                                       Male
                                   </label>
                               </div>
                               <div class="form-check form-check-inline">
                               <input class="form-check-input gender" type="radio" name="gender" id="no" value="Female">
                                   <label class="form-check-label" for="product_inactive">
                                       Female
                                   </label>
                               </div>
                               <span id="genders" class="info text-danger"></span>

                           </div>

                <center>  <div id="success_mes" class="text text-success">    </div>  </center> <br>
                       
                       
                       <div class="form-group text-center">
                            <input type="button" value="Register" id="Register" name="Register"
                                class="btn btn-primary account-btn">
                        </div> 
                        <div class="text-center login-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src="assets/ajax/vendor.js"></script>
    <script type="text/javascript" src="assets/ajax/app.js"></script>


    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>



    <script>

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
    $('#date').attr('max', maxDate);
});

      function checkemail() {
                    var email = document.getElementById("email").value;

                    if (email) {

                        $.ajax({
                            type: 'post',
                            url: "adminquery/checkmail.php", // request file the 'check_email.php'
                            data: {
                                email: email,
                            },

                            success: function (response) {
                                $('#email_status').html(response);
                                if (response == "This Email Address is Already Exist") {
                                    $("email_status").fadeIn().html(response);
                                    $('input:button').attr('disabled', true);

                                    return false;
                                }
                                else {
                                    $('input:button').attr('disabled', false);

                                    return true;
                                }
                            }
                        });
                    }
                    else {
                        $('#email_status').html("");
                        return false;

                    }
                }




$(document).ready(function () {
  // save comment to database
  $(document).on('click', '#Register', function () {

      var fname = $('#fname').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var password1 = $('#password1').val();
      var gender = $(".gender:checked").val();
      var lname = $('#lname').val();
      var prefix = $('#prefix').val();
      var dob = $('#date').val();


      var valid;
      valid = validateContact();

      if (valid) {

          $.ajax({
              url: "auth/register.php", // Url to which the request is send
              type: "POST",             // Type of request to be send, called as method
              data: {
                  'fname': fname,
                  'email': email,
                  'password': password,
                  'gender': gender,
                  'lname': lname,
                  'prefix': prefix,
                  'dob': dob,

              },

              success: function (response) {

                  $('#fname').val('');
                  $('#lname').val('');
                  $('#email').val('');
                  $('#password').val('');
                  $('#password1').val('');
                   $('#dob').val('');
                $('#prefix').val('');

                  $('#success_mes').fadeIn().html(response);
                  $('#success_mes').html(response);

                  if (response == "Successfully saved") { // if the response is 1
                        $("success_mes").fadeIn().html("Saved Successfully");
                                setTimeout(function(){  
                               $('#success_mes').fadeOut("Slow");  
                          }, 5000); 
                        return true;
 
                    } else{
                        $("success_mes").fadeIn().html(response);
                          setTimeout(function(){  
                         $('#success_mes').fadeOut("Slow");  
                    }, 5000); 

                    } 
              }

          });
      };

      // check validations
      function validateContact() {
          var valid = true;
          $(".demoInputBox").css('background-color', '');
          $(".info").html('');

          var minLength = 8;
                    var value = $("#password").val();

          if (value.length < minLength){ 
          $("#pass").html("(Password contains Minimum 8 Characters)");
          valid = false;
           }

          if (!$("#fname").val()) {
              $("#fname-info").html("(required)");
              $("#fname").css('background-color', '#FFFFDF');
              valid = false;
          }

          if (!$("#lname").val()) {
              $("#lname-info").html("(required)");
              $("#lname").css('background-color', '#FFFFDF');
              valid = false;
          }

          if (!$("#email").val()) {
              $("#userEmail-info").html("(Required)");
              $("#email").css('background-color', '#FFFFDF');
              valid = false;
          }
          if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
              $("#userEmail-info").html("(Invalid Email Address)");
              $("#email").css('background-color', '#FFFFDF');
              valid = false;
          }
          if (!$("#password").val()) {
              $("#pass").html("(Required)");
              $("#password").css('background-color', '#FFFFDF');
              valid = false;
          }
          if (!$("#password1").val()) {
              $("#pass1").html("(Required)");
              $("#password1").css('background-color', '#FFFFDF');
              valid = false;
          }
          if ($("#password").val() != $("#password1").val()) {
              $("#password1").html("(Password do not match)");
              // $("#password1").css('background-color', '#FFFFDF');
              valid = false;
          }
          if ($("#types").val() == 'select') {
              $("#type").html("(Please select appropriate type)");
              // $("#password1").css('background-color', '#FFFFDF');
              valid = false;
          }
          if ($("#prefix").val() == 'Select') {
              $("#prefix_info").html("(Please select)");
                valid = false;
             }

          if (!$("input[name='gender']:checked").val()) {
              $("#genders").html("(Gender Required)");
               valid = false;
                     }

                     
           if (!$("#date").val()) {
              $("#dobs").html("(Required)");
               $("#date").css('background-color', '#FFFFDF');
                valid = false;
             }

          return valid;
      }
  });
});

    </script>











</body>


<!-- register24:03-->

</html>