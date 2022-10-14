<?php

session_start();
require_once "../auth/dbconnection.php";

$output ='';

$stmt = $conn->prepare("SELECT * FROM doctor_recommend WHERE doctor_recommend_id=? ");
$stmt->bind_param("s", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {

        $submit_date=   date('dS F Y', strtotime($row['submit_date']));

$output .='

<div class="row">
<div class="col-lg-12 m-b-20">
    <ul class="list-unstyled">
        <li>
            <h5 class="mb-0"><strong>Dr. '.$row['recommended_by'].'</strong></h5></li>
        <li><span>'.$row['specilization'].'</span></li>
        <li>'. $submit_date.'</li>
    </ul>
</div>
</div>

<div class="row">
<div class="col-sm-8">
    <div>
        <h4 class="m-b-10"><strong>Description</strong></h4>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><strong>'.$row['description'].'</strong></td>
                </tr>
             
            </tbody>
        </table>
    </div>
 </div>
</div>';
                 
                                }  
                                                  
                                
                            }else{

                                echo 'No more reports available belongs to this Prescription';
                            }



echo $output;   
                          


?>