<!DOCTYPE html>
<html lang="en">
           
<?php
        // Initialize the session
         session_start();

         if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            }

        ?>

<!-- invoices23:24-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>SEUS HMS - Medical & Hospital </title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
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
                    <!-- <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a> -->
                 
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <!-- <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i>  <span class="badge badge-pill bg-danger float-right">8</span></a> -->
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
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
  } if( $_SESSION['role_id']=='2'){
  
      include ('sidebar/doctorsidebar.php');
  
  } if( $_SESSION['role_id']=='3'){
  
      include ('sidebar/laboratorist.php');
  
  }
  if( $_SESSION['role_id']=='4'){
      include ('sidebar/receptionist.php');
  }?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Search Available Appointments</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                 
                    </div>
                    
                </div>
                <div class="row">
           
                    <div class="col-sm-6 col-md-3">
                                          
                      <input type="text" class="form-control" placeholder="Enter Patient ID" id="pid">
                      <input type="hidden" class="form-control" placeholder="Enter Patient ID" id="pide">

                      
                            <br>          
                     <span id="selectid" class="info text-danger"></span><br />


                    </div>

              


                
                    <div class="col-sm-6 col-md-3">
                    <input type="hidden" name="user" id="user" value="<?php echo base64_decode($_GET['user'])   ?>" >

                        <input type="button" name="submit" id="submit" class="btn btn-primary" value="Check">

                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="result">
                           
                        </div>
                    </div>
                </div>


<br><br><br>
             <div class="row">
                <div class="col-sm-5 col-4">
                        <h4 class="page-title">Available Reports # <span id="presid"> </span></h4>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive" id="tests">
                           
                        </div>
                    </div>
                </div>
            </div>

            
		<!-- <div id="delete_invoice" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Invoice?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div> -->

    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>

    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>


<script>


$(document).on("click",".check",function(){ 
    
   var id = $(this).attr("data-id");
   var btnAttrId = $(this).attr('id');
   var btnDataId = $(this).data('id');

    $.ajax({
     url:"testquery/check_status.php",
     method:"POST",
     data:{id:id},

     beforeSend:function()
{
    $('#check'+btnDataId).text("Checking......");

},
     
     success:function(response){

        $( '#status'+btnDataId ).html(response);
               if(response=="No")
               {
               $("status").fadeIn().html(response);

                return false;
               }
               else
               {

                return true;
               }
     },

     complete: function() {
    $('#check'+btnDataId).text("Checked");
},
    

    });

   
  });




</script>


<script>
$(document).ready(function () {

$(document).on('click', '#submit', function () {
var id = $("#pid").val();
    $('#result').html('');
    $('#presid').html('');
    var user_id = $('#user').val();

    var valid;
    valid = validateContact();
    if (valid) {
    
    $.ajax({
              url: "payment/fetch_id.php", // Url to which the request is send
              method: "POST",             // Type of request to be send, called as method
              data:{
                   id: id,
                   user_id: user_id

              },
              dataType:'text',             
           
              success: function(data){
              
                $('#result').html(data);
                $('#tests').html('');
            },
            error: function(e){
                console.log(e);
            }

          });

        };

  // check validations
  function validateContact() {
                    var valid = true;
                    $(".demoInputBox").css('background-color', '');
                    $(".info").html('');

                
                    if (!$("#pid").val()) {
                        $("#selectid").html("(Insert ID)");
                        // $("#pid").css('background-color', '#FFFFDF');
                        valid = false;
                    }

                    if ($("#pid").val() != '<?php echo base64_decode($_GET['p_id']);   ?>') {
                        $("#selectid").html("(Wrong ID)");
                        // $("#pid").css('background-color', '#FFFFDF');
                        valid = false;
                    }    
                    
              
                    return valid;
                }

});

// select tests

$(document).on("click",".check",function(){ 

    var id = $(this).attr("data-id");
    $('#tests').html('');
    $('#presid').html(id);


    $.ajax({
              url: "payment/fetch_tests.php", // Url to which the request is send
              method: "POST",             // Type of request to be send, called as method
              data:{
                   id: id

              },
              dataType:'text',             
           
              success: function(data){
              
                $('#tests').html(data);

            },
            error: function(e){
                console.log(e);
            }

          });

});





});
</script>






</body>


<!-- invoices23:25-->
</html>