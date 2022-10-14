<html>

<?php  
   // Initialize the session
   session_start();

   if(!isset($_SESSION['user_id'])){
	header('location:../login.php');
}

    //  redirect to main page according to the user role 
	if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1){
        header("location: ../index-2.php");
        exit;
     }


     
     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 3){
        header("location: ../index-lab.php");
        exit;
     }

     if(isset($_SESSION['user_id']) && $_SESSION['role_id'] == 4){
        header("location: ../index-recep.php");
        exit;
     }





	  include ("config.php");
	  
?>

<head>


    <style>
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #0C0D58;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>





<style>

* { margin: 0px; padding: 0px; }
body {
	background: #f0f1f2;
	font:12px "Open Sans", sans-serif; 
}
#view-code{
  color:#89a2b5;    
  opacity:0.7;
  font-size:14px;
  text-transform:uppercase;
  font-weight:700;
  text-decoration:none;
  position:absolute;top:660px;
  left:50%;margin-left:-50px;
  z-index:200;
}
#view-code:hover{opacity:1;}
#chatbox{
	width:290px;
	background:#fff;
	border-radius:6px;
	overflow:hidden;
	height:484px;
	position:absolute;
	top:100px;
	left:50%;
	margin-left:-155px;
}

#friendslist{
	position:absolute;
	top:0;
	left:0;
	width:290px;
	height:484px;
}
#topmenu{
	height:69px;
	width:290px;
	border-bottom:1px solid #d8dfe3;	
}
#topmenu span{
	float:left;	
	width: 96px;
    height: 70px;
    background: url("img/top-menu.png") -3px -118px no-repeat;
}
#topmenu span.friends{margin-bottom:-1px;}
#topmenu span.chats{background-position:-95px 25px; cursor:pointer;}
#topmenu span.chats:hover{background-position:-95px -46px; cursor:pointer;}
#topmenu span.history{background-position:-190px 24px; cursor:pointer;}
#topmenu span.history:hover{background-position:-190px -47px; cursor:pointer;}
.friend{
	height:70px;
	border-bottom:1px solid #e7ebee;		
	position:relative;
}
.friend:hover{
	background:#f1f4f6;
	cursor:pointer;
}
.friend img{
	width:40px;
	border-radius:50%;
	margin:15px;
	float:left;
}
.floatingImg{
	width:40px;
	border-radius:50%;
	position:absolute;
	top:0;
	left:12px;
	border:3px solid #fff;
}
.friend p{
	padding:15px 0 0 0;			
	float:left;
	width:220px;
}
.friend p strong{
  font-weight:600;
  font-size:15px;
	color:#597a96;  

}
.friend p span{
	font-size:13px;
	font-weight:400;
	color:#aab8c2;
}

.friend p spans{
	font-size:13px;
	font-weight:400;
	color:#aab8c2;
}

.friend .status{
	background:#26c281;
	border-radius:50%;	
	width:9px;
	height:9px;
	position:absolute;
	top:31px;
	right:17px;
}
.friend .status.away{background:#ffce54;}
.friend .status.inactive{background:#eaeef0;}
#search{
	background:#e3e9ed url("img/search.png") -11px 0 no-repeat;
	height:60px;
	width:290px;
	position:absolute;
	bottom:0;
	left:0;
}
#searchfield{
	background:#e3e9ed;
	margin:21px 0 0 55px;
	border:none;
	padding:0;
	font-size:14px;
	font-family:"Open Sans", sans-serif; 
	font-weight:400px;
	color:#8198ac;
}
#searchfield:focus{
	 outline: 0;
}
#chatview{
	width:290px;
	height:484px;
	position:absolute;
	top:0;
	left:0;	
	display:none;
	background:#fff;
}
#profile{
	height:153px;
	overflow:hidden;
	text-align:center;
	color:#fff;
}
.p1 #profile{
	background:#fff url("img/timeline1.png") 0 0 no-repeat;
}
#profile .avatar{
	width:68px;
	border:3px solid #fff;
	margin:23px 0 0;
	border-radius:50%;
}
#profile  p{
	font-weight:600;
	font-size:15px;
	margin:118px 0 -1px;
	opacity:0;
	-webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	   -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	    -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	     -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	        transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);	
}
#profile  p.animate{
	margin-top:97px;
	opacity:1;
	-webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	   -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	    -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	     -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	        transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);	
}
#profile  span{
	font-weight:400;
	font-size:11px;
}
#chat-messages{
	opacity:0;
	margin-top:30px;
	width:290px;
	height:270px;
	overflow-y:scroll;	
	overflow-x:hidden;
	padding-right: 20px;
	-webkit-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	   -moz-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	    -ms-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	     -o-transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
	        transition: all 200ms cubic-bezier(0.000, 0.995, 0.990, 1.000);
}

#chat-messages.animate{
	opacity:1;
	margin-top:0;
}
#chat-messages label{
	color:#aab8c2;
	font-weight:600;
	font-size:12px;
	text-align:center;
	margin:15px 0;
	width:290px;
	display:block;	
}
#chat-messages div.message{
	padding:10 0 30px 58px;
	margin-left: -40px;
	clear:both;
	margin-bottom:45px;
}
#chat-messages div.message.right{
	padding: 10 58px 30px 0;
	  margin-right: -55px;
	  margin-left: 19px;
}
#chat-messages .message img{
	  float: left;
	  margin-left: -38px;
	  border-radius: 50%;
	  width: 30px;
	  margin-top: 12px;
}
#chat-messages div.message.right img{
	float: right;	
    margin-left: 0;
	margin-right: -38px;	
}
.message .bubble{	
	background:#f0f4f7;
	font-size:13px;
	font-weight:600;
	padding:12px 13px;
	border-radius:5px 5px 5px 0px;
	color:#8495a3;
	position:relative;
	float:left;
}
#chat-messages div.message.right .bubble{
	float:right;
	border-radius:5px 5px 0px 5px ;
}
.bubble .corner{
	background:url("img/bubble-corner.png") 0 0 no-repeat;
	position:absolute;
	width:7px;
	height:7px;
	left:-5px;
	bottom:0;
}
div.message.right .corner{
	background:url("img/bubble-cornerR.png") 0 0 no-repeat;
	left:auto;
	right:-5px;
}
.bubble span{
	  color: #aab8c2;
	  font-size: 11px;
	  position: absolute;
	  right: 0;
	  bottom: -22px;
}
#sendmessage{
	height:60px;
	border-top:1px solid #e7ebee;	
	position:absolute;
	bottom:0;
	right:0px;
	width:290px;
	background:#fff;
	padding-bottm:50px;
}
#sendmessage input{
	border
}
#sendmessage input{
	background:#fff;
	margin:21px 0 0 21px;
	border:none;
	padding:0;
	font-size:14px;
	font-family:"Open Sans", sans-serif; 
	font-weight:400px;
	color:#aab8c2;
}
#sendmessage input:focus{
	 outline: 0;
}
#sendmessage button{
	background:#fff url("img/send.png") 0 -41px no-repeat;
	width:30px;
	height:30px;
	position:absolute;
	right: 15px;
	top: 23px;
	border:none;
}
#sendmessage button:hover{
	cursor:pointer;
	background-position: 0 0 ;
}
#sendmessage button:focus{
	 outline: 0;	 
}

#close{
	position:absolute;
	top: 8px;	
	opacity:0.8;
 	right: 10px;
	width:20px;
	height:20px;
	cursor:pointer;
}
#close:hover{
	opacity:1;
}
.cx, .cy{
	background:#fff;
	position:absolute;
	width:0px;
	top:15px;
	right:15px;
	height:3px;
	-webkit-transition: all 250ms ease-in-out;
	   -moz-transition: all 250ms ease-in-out;
		-ms-transition: all 250ms ease-in-out;
		 -o-transition: all 250ms ease-in-out;
			transition: all 250ms ease-in-out;
}
.cx.s1, .cy.s1{	
	right:0;	
	width:20px;	
	-webkit-transition: all 100ms ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ms ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}
.cy.s2{	
	-ms-transform: rotate(50deg); 
	-webkit-transform: rotate(50deg); 
	transform: rotate(50deg);		 
	-webkit-transition: all 100ms ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ms ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}
.cy.s3{	
	-ms-transform: rotate(45deg); 
	-webkit-transform: rotate(45deg); 
	transform: rotate(45deg);		 
	-webkit-transition: all 100ms ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ms ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}
.cx.s1{	
	right:0;	
	width:20px;	
	-webkit-transition: all 100ms ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ms ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}
.cx.s2{	
	-ms-transform: rotate(140deg); 
	-webkit-transform: rotate(140deg); 
	transform: rotate(140deg);		 
	-webkit-transition: all 100ms ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}
.cx.s3{	
	-ms-transform: rotate(135deg); 
	-webkit-transform: rotate(135deg); 
	transform: rotate(135deg);		 
	-webkit-transition: all 100ease-out;
	   -moz-transition: all 100ms ease-out;
		-ms-transition: all 100ms ease-out;
		 -o-transition: all 100ms ease-out;
			transition: all 100ms ease-out;
}


#chatview, #sendmessage { 
overflow:hidden; 
border-radius:6px; 
}


</style>


<script type="text/javascript" src="resources/jquery.js"></script>



</head>

<body>
    
<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'> -->


<div id="chatbox">
	<div id="friendslist">
    	<div id="topmenu">
        	<span class="friends"></span>
            <span class="chats"></span>
            <span class="history"></span>
        </div>
        
        <div id="friends">

		<?php




$query=$pdo->prepare("SELECT DISTINCT * FROM patients as p INNER JOIN appointment as a ON p.p_id=a.p_id AND a.doctor_status='1' AND a.user_id='".$_SESSION['user_id']."'  GROUP BY p.p_id  ");

$row=$query->execute();
$rs=$query->fetchAll(PDO::FETCH_OBJ);





foreach ($rs as $message){

          

	

?>

		
        	<div class="friend">


			<img src="resources/users.jpg" />
                <p>
				<strong>  <?php  echo $message->prefix ?>  <?php echo $message->patient_name   ?></strong> <br>
				<span id="email"><?php  echo $message->email   ?></span>

                </p>
                <div class="status available"></div>
        </div>

		<?php   } ?>

            <!-- <div id="search">
	            <input type="text" id="searchfield" value="Search contacts..." />
            </div> -->
            
        </div>                
        
    </div>	
    
    <div id="chatview" class="p1">    	
        <div id="profile">

            <div id="close">
                <div class="cy"></div>
                <div class="cx"></div>
            </div>
            
            <p>Miro Badev</p>
            <span>miro@badev@gmail.com</span>
        </div>
		

        <div id="chat-messages">
        	<label>Thursday 02</label>
               
                        
        </div>

	<form class="" id="msgform" action="chat.php" method="post">    	
        <div id="sendmessage">
		<input type="hidden"   class="emails" name="emails" id="emails"/>

        	<input type="text" placeholder="Send message..." minlength="5"  class="textarea" name="message"/>
            <button id="send" class="textarea" ></button>
        </div>
	</form>

                            <div id="snackbar">Empty message can't be sent :(</div>

    </div>        
</div>	
    
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->



<script>

$(document).ready(function(){
	
    var preloadbg = document.createElement("img");
    preloadbg.src = "../images/h-adm1.jpg";
    
      $("#searchfield").focus(function(){
          if($(this).val() == "Search contacts..."){
              $(this).val("");
          }
      });
      $("#searchfield").focusout(function(){
          if($(this).val() == ""){
              $(this).val("Search contacts...");
              
          }
      });
           
      $(".friend").each(function(x){		
          $(this).click(function(){
              var childOffset = $(this).offset();
              var parentOffset = $(this).parent().parent().offset();
              var childTop = childOffset.top - parentOffset.top;
              var clone = $(this).find('img').eq(0).clone();
              var top = childTop+12+"px";
              
              $(clone).css({'top': top}).addClass("floatingImg").appendTo("#chatbox");									
              
              setTimeout(function(){$("#profile p").addClass("animate");$("#profile").addClass("animate");}, 100);
              setTimeout(function(){
                  $("#chat-messages").addClass("animate");
                  $('.cx, .cy').addClass('s1');
                  setTimeout(function(){$('.cx, .cy').addClass('s2');}, 100);
                  setTimeout(function(){$('.cx, .cy').addClass('s3');}, 200);			
              }, 150);														
              
              $('.floatingImg').animate({
                  'width': "68px",
                  'left':'108px',
                  'top':'20px'
              }, 200);
              
              var name = $(this).find("p strong").html();
              var email = $(this).find("p span").html();
				
			  LoadChat(email);

			
								
              $("#profile p").html(name);
              $("#profile span").html(email);
			  $("#emails").val(email);
	
              
              $(".message").not(".right").find("img").attr("src", $(clone).attr("src"));									
              $('#friendslist').fadeOut();
              $('#chatview').fadeIn();
          
              
              $('#close').unbind("click").click(function(){				
                  $("#chat-messages, #profile, #profile p").removeClass("animate");
                  $('.cx, .cy').removeClass("s1 s2 s3");
                  $('.floatingImg').animate({
                      'width': "40px",
                      'top':top,
                      'left': '12px'
                  }, 200, function(){$('.floatingImg').remove()});				
                  
                  setTimeout(function(){
                      $('#chatview').fadeOut();
                      $('#friendslist').fadeIn();				
                  }, 50);

				  
              });
              
          });
      });			
  });



</script>



<script type="text/javascript">
    LoadChat(email);


	
    setInterval(function () {
        LoadChat(email);
    }, 1000);

	function LoadChat(email) {
        var email = $('.emails').val();

// $.post('handlers/messages.php?action=getMessages', function (response) {
		$.post("handlers/messages.php", {action: "getMessages",  email: email}, function (response) {            //alert(response);


	var scrollpos = $('#chat-messages').scrollTop();
	var scrollpos = parseInt(scrollpos) + 350;
	var scrollHeight = $('#chat-messages').prop('scrollHeight');

	// $("#sendmessage input").focus(function(){
    //       if($(this).val() == "Send message..."){
    //           $(this).val("");
    //       }
    //   });
    //   $("#sendmessage input").focusout(function(){
    //       if($(this).val() == ""){
    //           $(this).val("Send message...");
              
    //       }
    //   });


	$('#chat-messages').html(response);
	if (scrollpos < scrollHeight){

	} else{
		$('#chat-messages').scrollTop($('#chat-messages').prop('scrollHeight'));
	}

})

}



    $('form').submit(function () {

        //alert('form is submit jquery');
		

        var email = $('.emails').val();


        var message = $('.textarea').val();
		
			if ($(".textarea").val()) {

		$.post("handlers/messages.php", {action: "sendMessage", message: message, email: email}, function (response) {            //alert(response);
            
			if (response){

                LoadChat();
                document.getElementById('msgform').reset();
            }
        });


	} else {

		myFunction();


}


        return false;






    })

 function myFunction() {
  var x = document.getElementById("snackbar");
  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
 




 }



	
</script>




</body>











</html>