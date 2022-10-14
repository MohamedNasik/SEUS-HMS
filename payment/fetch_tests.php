<?php

session_start();
require_once "../auth/dbconnection.php";



$output ='';

$stmt = $conn->prepare("SELECT * FROM testing_schedule AS ts  INNER JOIN testings as t ON t.test_id=ts.test_id AND ts.pres_id=?");
$stmt->bind_param("s", $_POST['id']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) { 

$output .='

<table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                       
                                        <th>Test ID</th>
                                        <th>Test Name</th>
                                        <th>Lab Status</th>
                                        <th>Test Payment </th>
                                        <th>Submitted Date </th>                             
                                 

                                    </tr>
                                </thead>';
                               
                                while($row = $result->fetch_assoc()) {
          
                                    $output .='
                                
                                    <tr>
                                
                                    <td><a href="#">'.$row["test_id"].'</a></td>
                                    <td id="pres"><a href="#">'.$row["testing_name"].'</a></td>';

                                    if($row["lab_status"]=='0'){
                                    $output .='<td><span class="custom-badge status-red">Still Not Taken</span></td>';
                                    }elseif($row["lab_status"]=='1'){
                                        $output .='<td><span class="custom-badge status-green">Completed</span></td>';
                                    }elseif($row["lab_status"]=='3'){
                                        $output .='<td><span class="custom-badge status-blue">In progress</span></td>';
                                    }

                        
                                    $output .='<td>';
                                    if($row["payment_status"]=='2'){   
                                        $output .='<span class="custom-badge status-green"> Paid </span>';
                                    }else{
                                        $output .='<span class="custom-badge status-red"> Not Paid </span>';

                                    }
                                    $output .='</td>';

                                    $output .='
                                    <td>'.$row["submit_date"].'</td>
                              
                                  
                                                              
                                </tr>   ';                

                                }  
         
                            }else{

                                echo 'No more reports available belongs to this Prescription';
                            }

echo $output;   
                          


?>