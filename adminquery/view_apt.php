<?php   
session_start();
require_once "../auth/dbconnection.php";

$output ='';

$sql= "SELECT COUNT(a.apt_id) AS apt_id, sum(if(doctor_status='3',1,0) && if(admin_status='0',1,0) && if(patient_status='0',1,0)) AS `cancel`,sum(if(doctor_status='3',1,0)&& if(admin_status='3',1,0)&& if(patient_status='3',1,0) ) AS `notattended`, 
sum(if(doctor_status='3',1,0)&& if(admin_status='1',1,0) ) AS `in progress`,sum(if(doctor_status='1',1,0)) AS `confirm`, a.apt_date
FROM appointment AS a WHERE doctor_status IN ('3','3', '3', '1') AND a.apt_date='".$_POST["date"]."' ";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){

        $confirm= $row['confirm'];
        $inprogress= $row['in progress'];
        $apt_id= $row['apt_id'];
        $not_attended= $row['notattended'];
   
        $cancel= $row['cancel'];
   

$output .='

<h4 class="payslip-title">View of Appointments</h4>
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                    <ul class="list-unstyled mb-0">
                                        <li>SEUS Hospital</li>
                                        <li>No.22, Main Road</li>
                                        <li>Bandarawela</li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 m-b-20">
                                    <div class="invoice-details">
                                        <h3 class="text-uppercase">Apts.# '. $apt_id.' </h3>
                                        <ul class="list-unstyled">
                                            <li>Date: '.$row["apt_date"].'</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <h4 class="m-b-12"><strong>Appointment Status</strong></h4>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><strong>All Apppointments</strong> <span class="float-right"> '. $apt_id.'</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Ongoing Appoinments</strong> <span class="float-right">'. $inprogress.'</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Completed Appointments</strong> <span class="float-right"> '. $confirm.'</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Cancel Appointments</strong> <span class="float-right">'. $cancel.'</span></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Not Attended</strong> <span class="float-right"><strong>'. $not_attended.'</strong></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>';

                            }  
    

                        }else{
                            $output .=  '
                        <tr>
                        <td colspan="5" align="center"> No more prescriptions available :-( </td>
                        </tr>
                        ';
                        
                        
                        
                        
                        }



                                $sqli= "SELECT  count(apt_id) as totals, doctor_name FROM appointment AS a INNER JOIN doctor_specialist as ds ON ds.user_id=a.user_id AND a.apt_date='".$_POST["date"]."' AND admin_status='1' GROUP BY a.user_id ";
                                
                                $results=mysqli_query($conn,$sqli);
                                if(mysqli_num_rows($results)>0){
                             

                                   
                                
                                $output .='                



                            <div class="col-sm-6">
                                <div>
                                    <h4 class="m-b-12"><strong>Appointments (Doctors)</strong></h4>
                                    <table class="table table-bordered">
                                        <tbody>';
                                        while($row=mysqli_fetch_array($results)){
                                
                                            $totals= $row['totals'];
                                            $doctor_name= $row['doctor_name'];

                                            $output .=
                                            '<tr>
                                                <td><strong>'. $doctor_name.'</strong> <span class="float-right"> '. $totals.'</span></td>
                                            </tr>';
                                       
                                        }  
    

                                    }else{
                                        $output .=  '
                                        <div>
                                        <tr>
                                    <td><strong> No more Doctors found  </strong>  </td>
                                    </tr>
                                    </div> ';
                                    
                                    
                                    
                                    
                                    }

                                    $output .=  '  </tbody>
                                    </table>
                                </div>
                            </div>

                            
                            </div>';

                    
                    
                    
                    
                    
                    echo $output;   
                    