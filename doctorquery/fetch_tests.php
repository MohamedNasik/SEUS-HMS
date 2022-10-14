<?php

session_start();
require_once "../auth/dbconnection.php";



$output ='';

$stmt = $conn->prepare("SELECT * FROM testing_report AS tr  INNER JOIN testing_schedule as ts ON tr.test_id=ts.test_id AND tr.pres_id=ts.pres_id INNER JOIN testings as t ON t.test_id=tr.test_id AND ts.pres_id=?");
$stmt->bind_param("s", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();
 if(mysqli_num_rows($result)>0){

$output .='

<table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                       
                                        <th>Report ID</th>
                                        <th>Test Name</th>
                                        <th>Complete Status</th>
                                        <th>Submitted Date </th>                             
                                 

                                    </tr>
                                </thead>';
                               
                                while($row = $result->fetch_assoc()) {
  

                                

                                  
                                    $output .='
                                
                                    <tr>
                                
                                    <td><a href="#">'.$row["testing_report_id"].'</a></td>
                                    <td id="pres"><a href="#">'.$row["testing_name"].'</a></td>';

                                    if($row["lab_status"]=='0'){
                                    $output .='<td><span class="custom-badge status-red">Still Not Taken</span></td>';
                                    }elseif($row["lab_status"]=='1'){
                                        $output .='<td><span class="custom-badge status-green">Completed</span></td>';
                                    }elseif($row["lab_status"]=='3'){
                                        $output .='<td><span class="custom-badge status-blue">In progress</span></td>';
                                    }

                                    $output .='
                                    <td>'.$row["submit_date"].'</td>
                              
                                  
                                                              
                                </tr>  
                                
                                
                               ';
                               
                                }
                                
                            }else{
                                echo "No available reports";
                            }
                                                  
                                



echo $output;   




?>