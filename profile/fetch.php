<?php
         session_start();

    if( !empty( $_SESSION['user_id'] ) ){

        require_once '../auth/dbconnection.php';


        $sql='select `image` from `users` where `user_id`=?';
        $stmt=$conn->prepare( $sql );
        $stmt->bind_param( 's',$_SESSION['user_id'] );


        $res=$stmt->execute();
        if( $res ){
            $stmt->store_result();
            $stmt->bind_result($filename);

            while( $stmt->fetch() ){
                /* 
                    You store the filename ( possibly path too ) 
                    so you need to read the file to find it's
                    raw data which you will use a simage source
                */
                $filepath="blog/";
               
                printf(
                    '<img class="inline-block" src="data:image/png;base64, %s" alt="user" />',
                         base64_encode(file_get_contents($filepath.$filename ) )
                );      

                ?>
                                
                                    <div class="fileupload btn">
                                        <span class="btn-text">Change</span>
                                        <input class="upload" type="file" name="upload_image" id="upload_image">
                                    </div>

               <?php               }
                 $stmt->free_result();
                 $stmt->close();
                 $conn->close();
            }
       }
     ?>