<?php

session_start();
require_once "../auth/dbconnection.php";



$output ='';

$sql= "SELECT * FROM appointment AS a INNER JOIN prescription as p ON a.apt_id=p.apt_id AND a.apt_date=p.date AND a.user_id=p.user_id   INNER JOIN users as u ON u.user_id=a.user_id AND a.admin_status='1' AND a.p_id='".$_POST["id"]."' AND a.user_id= '".$_POST["user_id"]."'    ";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){

$output .='

<table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                       
                                        <th>Appointment ID</th>
                                        <th>Prescription ID</th>
                                        <th>Doctor Name</th>
                                        <th>Specilization</th>
                                        <th>Appointment Date </th>                             
                                        <th>Action</th> 
                                        <th>Payment Status</th> 

                                    </tr>
                                </thead>';
                               
                                while($row=mysqli_fetch_array($result)){


                                  
                                    $output .='
                                
                                    <tr>
                                
                                    <td><a href="#">'.$row["apt_id"].'</a></td>
                                    <td id="pres"><a href="#">'.$row["pres_id"].'</a></td>

                                    <td>'.$row["fname"].' '.$row["lname"].'</td>
                                    <td><span class="custom-badge status-blue">'.$row["specilization"].'</span></td>

                                    <td>'.$row["apt_date"].'</td>
                              
                                    <td >                             
                                    <button id="check'.$row["pres_id"].'" class="btn btn-danger custom-badge status-grey check" value="Submit"  data-id='.$row['pres_id'].' onclick="(this.id)">   Submit  </button> 
                                    </td>    
                                       <td >                             
                                       <span id="status'.$row["pres_id"].'" name="status"></span>
                                    </td>                                 
                                </tr>   ';
                               
                                }  
                                                  
                                
   



}else{
    $output .=  '
<tr>
<td colspan="5" align="center"> No more prescriptions available :-( </td>
</tr>
';




}




echo $output;   




?>