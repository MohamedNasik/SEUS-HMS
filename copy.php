<?php


session_start();

// Include config file
require_once "auth/dbconnection.php";



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Crop Image Before Upload using CropperJS with PHP</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
		<!-- <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" /> -->
		<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
		<!-- <script src="https://unpkg.com/dropzone"></script> -->
		<script src="https://unpkg.com/cropperjs"></script>


		
		<style>

		.image_area {
		  position: relative;
		}

		img {
		  	display: block;
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
		<div class="container" align="center">
			<br />
			<h3 align="center">Crop Image Before Upload using CropperJS with PHP</h3>
			<br />
			<div class="row">
				<div class="col-md-4">&nbsp;</div>
				<div class="col-md-4">
                <div class="image_area">
<?php 
                $output='';    

    
$sql='SELECT u.user_id,u.fname,u.lname,u.address,u.image,u.email FROM users as u  WHERE u.user_id= ?  ';
$stmt=$conn->prepare( $sql );
$stmt->bind_param( 's',$_SESSION['user_id']  );


$res=$stmt->execute();
if( $res ){
    $stmt->store_result();
    $stmt->bind_result($user_id,$fname,$lname,$address,$image,$email);

    while( $stmt->fetch() ){
   
        $filepath="profile/blog/";

        $output .= '
            <div class="image_area">
				
        <label for="upload_image">';
        
$output .=  '<img src="data:image/png;base64, '.base64_encode(file_get_contents($filepath.$image) ).'" id="uploaded_image" class="img-responsive img-circle" />
            <div class="overlay">
                <div class="text">Click to Change Profile Image</div>
            </div>
            <input type="file" name="image" class="image" id="upload_image" style="display:none" />
        </label>

        </div>';



}

echo $output;


$stmt->free_result();
$stmt->close();
$conn->close();

}


?>




<!--  -->



					</div>
			    </div>
    		<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Crop Image Before Upload</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">??</span>
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








	</body>
</html>

<script>

        //    load_data();
        //         function load_data() {
        //             $.ajax({
        //                 url: "adminquery/fetch/copy.php", // Url to which the request is send
        //                 type: "POST",             // Type of request to be send, called as method

        //                 success: function (data) {

        //                     $('#user_data').html(data);

        //                 }

        //             });

        //         }


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
						// $('#uploaded_image').attr('src', data);
					}
				});
			};
		});
	});
	
});
</script>
