<!DOCTYPE html>
<html lang="en">

<?php

session_start();

include ('doctorquery/fetch_select.php');
$getapt= $_GET['aptid'];
?>



<!-- salary-view23:28-->
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
 

    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/select/jquery-editable-select.min.css"> -->
   
   
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
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Preclinic</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">L</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>

        <?php

 if( $_SESSION['type']=='doctor'){
                include ('sidebar/doctorsidebar.php');
            }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-4">
                        <h4 class="page-title">Patient Prescription</h4>
                    </div>
                    <div class="col-sm-7 col-8 text-right m-b-30">
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-white">CSV</button>
                            <button class="btn btn-white">PDF</button>
                            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                        </div>
                    </div>
                </div>

<?php
include ('auth/dbconnection.php');
$query="SELECT * FROM appointment WHERE apt_id= '".$_GET['aptid']."' ";
$results =mysqli_query($conn,$query);
if(mysqli_num_rows($results) > 0){
    while($row =mysqli_fetch_array($results))
    {
?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h4 class="payslip-title">Medical Prescription for <strong> <?php echo $row['patient_name'];  ?> </strong> </h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                    
                                </div>

                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Appointment ID #<?php echo $row['apt_id'];  ?></h3>
                                        <ul class="list-unstyled">
                                            <li>Patient ID: <span><?php echo $row['p_id'];    ?></span></li>
                                            <li>Apt Date: <span><?php echo $row['apt_date'];    ?></span></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-lg-12 m-b-20">
                                    <ul class="list-unstyled">
                                        <li>
                                            <h5 class="mb-0"><strong>Dr.</strong> <?php echo $row['doctor_name'];  ?>  </h5>  </li>
                                        <li><span><?php echo $row['specilization'];  ?> </span></li>
                                        <li>Doctor ID: <?php echo $row['user_id'];  ?>  </li>
                                        <!-- <li>Joining Date: 7 May 2015</li> -->
                                    </ul>
                                </div>
                            </div>


<!-- TAB START -->
                            <div class="col-md-12">
                        <div class="card-box">
                          
                            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-toggle="tab">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-toggle="tab">Testings</a></li>
                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-toggle="tab">Medical Prescribed</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="solid-rounded-justified-tab1">
                               


             
                                </div>


                                <div class="tab-pane" id="solid-rounded-justified-tab2">
                                       
                                 <strong> Please provide the teasting is avilable  </strong>  <br>   <br> 
                                
                                 <div class="form-group">
                                <!-- <label class="display-block">Schedule Status</label> -->
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pass" id="yes"  >
                                    <label class="form-check-label" for="product_active">
                                        Need
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pass" id="no" >
                                    <label class="form-check-label" for="product_inactive">
                                        Not Need
                                    </label>
                                </div>
                            </div>



                                <br>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-12"><strong> Mark the Specic Testing Needs </strong> </label>  <br> <br>
                                    <div class="col-md-12">
                                        <div class="checkbox">
<table>

<tr>
<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > Blood
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Urine"  disabled="disabled" > Urine
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="ECG"  disabled="disabled" > ECG
</label>   </td>
</tr>

<tr>
<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Colonoscopy"  disabled="disabled" > Colonoscopy
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Colonoscopy"  disabled="disabled" > Colonoscopy
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > Option 1
</label>   </td>
</tr>

<tr>
<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > Option 1
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > Scan
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > X-Ray
</label>   </td>
</tr>

<tr>
<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Blood"  disabled="disabled" > Option 1
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="Scan"  disabled="disabled" > Scan
</label>   </td>

<td width="40%">   
<label>
<input type="checkbox" class="getvalue" name="getvalue" id="getvalue" value="X-Ray"  disabled="disabled" > X-Ray
</label>   </td>
</tr>
</table>
<br>
<div class="form-group row">
                
                                </div>
                                          
            </div>                                                         
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-12"><strong>  Remark  </strong></label> <br> <br>
                                    <div class="col-md-10">
                                        <textarea rows="5" cols="5" id="testing_remark" name="testing_remark" class="form-control" placeholder="Enter your remark here"  disabled="disabled" ></textarea>
                                    </div>
                                </div>
                               
                               <br>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-12"><strong>  Reconsultation Date  </strong></label> <br> <br>
                                    <div class="col-md-6">
                                       <input type="date" class="form-control">
                                    </div>
                                </div>
<br>

                                </div>

                                


                 <div class="tab-pane" id="solid-rounded-justified-tab3">
                      <div class="col-lg-12">
                        <!-- <div class="card-box"> -->
                            <div class="card-block">
                                <!-- <h5 class="text-bold card-title">Striped Rows</h5> -->
								<form method="post" id="prescriptionn" enctype="multipart/form-data">  
                                 <div class="table-responsive">
									<table class="table table-bordered mb-0" id="medical">
										<thead>
											<tr>
												<th>Medicine Name</th>
												<th>Morning</th>
												<th>Noon</th>
                                                <th>Night</th>
                                                <th>Period</th>

												<th> <button type="button" name="add" id="add" class="btn btn-success btn-xs"> + </button>  </th>

                                            </tr>
										</thead>
									<tbody id="rows"> 
                                   
                                     </tbody>
									</table>
                                    <br><br>
                                    <div align="center">

                                    
                                    <input type="hidden" value="<?php echo $row['apt_id'] ?>" id="getapt" name="getapt" class="btn btn-primary">
                                    <input type="hidden" value="<?php echo $row['p_id'] ?>" id="getpid" name="getpid" class="btn btn-primary">

                                    <textarea rows="5" cols="5" id="dietadvice" name="dietadvice" class="form-control" placeholder="Enter your remark here"></textarea>
                               



                               
                                    <div class="m-t-20 text-center">
                                <input type="button" name="submit" id="submit" class="btn btn-primary" value="Enter Prescription">
                            </div>
                                    </div>
								</div>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
   </div>

   <center>  <div id="result" class="text text-success"> </div>  </center> <br>
      
                                <div class="col-sm-12">
                                    <p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php     }

}
else{

}  ?>

            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                          
                        
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                          
                      
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <script src="assets/ajax/jquery.min.js"></script>
    <script src="assets/ajax/jquery-3.4.1.min.js"></script>
    <!-- <script src="assets/select/jquery-editable-select.min.js"></script> -->

 

    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
  

    <script src="assets/js/app.js"></script>


    <script src="assets/js/tagsinput.js"></script>


<script>
$(document).ready(function(){

var count=0;
$(document).on('click','#add',function() {
    count++; 

    var html= '';
    html += '<tr>';

    html += '<td id="medicinename"> <select  name="med_name[]" id="med_name[]" class="form-control med_name" ><option value=""> Select Medicine</option> <?php echo fill_select_box($conn, "0");  ?></select></td>';
    html += '<td id="mor"> <input type="text" name="morning[]" id="morning[]" class="form-control morning" /> </td>';
    html += '<td id="noo"> <input type="text" name="noon[]" id="noon[]" class="form-control noon" /> </td>';
    html += '<td id="nigh"> <input type="text" name="night[]" id="night[]" class="form-control night" /> </td>';
    html += '<td id="period"> <input type="text" name="period[]" id="period[]" class="form-control period" /> </td>';
    html += '<td> <button type="button" name="remove" id="remove" class="btn btn-danger btn-xs remove" >  -  </button> </td>';
    html +=  '</tr>';

    $('#rows').append(html);

});
        });
</script>

<script>


$(function () {
        $("input[name='pass']").click(function () {
            if ($("#yes").is(":checked")) {

                $("#testing_remark").removeAttr("disabled");
                $("#testing_remark").focus();

                $(".getvalue").removeAttr("disabled");
                $(".getvalue").focus();
            } else {
                $("#testing_remark").attr("disabled", "disabled");

                $(".getvalue").attr("disabled", "disabled");
            }
        });
    });

        // var modess=  [
        //     $("input[id='morning[]']")
        //       .map(function()
        //       {  return $(this).val(); console.log(morning); }).get(),
        //       $("input[id='noon[]']")
        //       .map(function()
        //       {  return $(this).val(); console.log(noon); }).get(),           
        //       $("input[id='night[]']")
        //       .map(function()
        //       {  return $(this).val(); console.log(night); }).get(),            
        // ]
            // var modes = $('select[name="med[]"]').map(function()
            //   {  return $(this).val(); console.log(modes); }).get();
            //   var morning = $("input[id='morning[]']")
            //   .map(function()
            //   {  return $(this).val(); console.log(morning); }).get();    
            //   var noon = $("input[id='noon[]']")
            //   .map(function()
            //   {  return $(this).val(); console.log(noon); }).get();     
            //   var night = $("input[id='night[]']")
            //   .map(function()
            //   {  return $(this).val(); console.log(night); }).get();
            //   var morning = JSON.stringify(morning);
            //    var noon = JSON.stringify(noon);
            //    var night = JSON.stringify(night);       
            //    const medic = [...morning, ...noon, ...night];
            //    console.log(medic);

            $(document).ready(function () {

             $(document).on('click', '#submit', function () {

             var test= [];
			$.each($('input[class="getvalue"]:checked'),function(){
				test.push($(this).val());

         });

             var test=test.join(", ");

             var testings = JSON.stringify({
            "testingremark": $('#testing_remark').val(), 
            "testings": $( ".getvalue:checked" ).map(function() {
                    return $(this).val();
                }).get()
   });



                var getapt = $('#getapt').val();  
                var getpid = $('#getpid').val();  
                var dietadvice = $('#dietadvice').val();  



                var ids={ 
                'getapt': getapt,
                'getpid': getpid,
                'dietadvice': dietadvice,
}



                var modess = $('#rows tr').map(function() {
                let $tr = $(this);

                return [ { 
                //     getapt,
                //   getpid,
               "medname": $(this).find('.med_name').val(),
               "morning":$(this).find('.morning').val(),
               "noon":$(this).find('.noon').val(),
               "night": $(this).find('.night').val(),
               "period": $(this).find('.period').val(),

                 } ]
                 console.log(modess);
                       });


   var ids = JSON.stringify(ids);
   //var medical = JSON.stringify(modess);
   var medical = JSON.stringify( $.makeArray(modess) );

    //   var valid;
    //   valid = validateContact();
    //  if (valid) {

          $.ajax({
              url: "adminquery/pres.php", // Url to which the request is send
              method: "POST",             // Type of request to be send, called as method
              data:{
                   index1: medical, 
                   index2: ids
              },
              //dataType:'json',             
              cache: false,
              success: function(data){
              //  alert('Items added');
              $("success_mes").fadeIn().html(data);

            },
            error: function(e){
                console.log(e);
            }

          })

//           .done(function(data) {  
//                 console.log("test: ", data);
//                 $("#result").text(data);
// })
//                  .fail(function(data) {
//     console.log("error: ", data);
// });


 //     };

      // check validations
    //   function validateContact() {
    //       var valid = true;
    //       $(".demoInputBox").css('background-color', '');
    //       $(".info").html('');

    //       if (!$("#dept_name").val()) {
    //           $("#blogtitle").html("(required)");
    //         //  $("#username").css('background-color', '#FFFFDF');
    //           valid = false;
    //       }
    //       if (!$("#dept_desc").val()) {
    //           $("#blogsub").html("(Required)");
    //        //   $("#email").css('background-color', '#FFFFDF');
    //           valid = false;
    //       }
  
    //       return valid;
    //   }

});

});
</script>






</body>


<!-- salary-view23:28-->
</html>









