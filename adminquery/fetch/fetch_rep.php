
<?php


session_start();


    require_once '../../auth/dbconnection.php';


    $sql='SELECT u.user_id,u.prefix,u.fname,u.lname,u.address,u.image,u.email FROM users as u  WHERE u.role_id= 4 ';
    $stmt=$conn->prepare( $sql );
    //$stmt->bind_param( 's','2' );


    $res=$stmt->execute();
    if( $res ){
        $stmt->store_result();
        $stmt->bind_result($user_id,$prefix,$fname,$lname,$address,$image,$email);

        while( $stmt->fetch() ){
       
            $filepath="../../profile/blog/";
           
            ?>

                <div class="col-md-4 col-sm-4  col-lg-3">
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="profile.php?userid=<?php echo $user_id  ?>">
                            <?php
                            
                            printf(
                                '<img class="inline-block" src="data:image/png;base64, %s" alt="user" />',
                                     base64_encode(file_get_contents($filepath.$image ) )
                            );

                            ?></a>
                        </div>

                        <?php

            if( $_SESSION['role_id']=='1'){   ?>

                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- <a class="dropdown-item" href="edit-doctor.php"><i class="fa fa-pencil m-r-5"></i> Edit</a> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" id="rep2" data_id=<?php echo $user_id  ?> data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div>
                        </div>

                 <?php      }     ?>

             
                 <h4 class="doctor-name text-ellipsis"><a href="#">    <?php  echo $prefix?>  <?php    echo $fname.' '.$lname  ?></a></h4>
                            <div class="doc-prof"> <i class="fa fa-user"> </i>   <?php    echo  "Receptionist" ?></div>
                           
                            <div class="user-country">
                                <i class="fa fa-envelope"></i>  <?php    echo  $email  ?>
                            </div>
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i> <?php echo  $address  ?>
                            </div>
                        </div>
                    </div>

                

            <?php               }
                     $stmt->free_result();
                     $stmt->close();
                     $conn->close();
        }

            ?>
