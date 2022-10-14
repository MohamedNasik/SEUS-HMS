<?php

session_start();
require_once "../../auth/dbconnection.php";

$output ='';


$p_id=$_POST["p_id"];
$dates=$_POST["dates"];
$doctor_status= "1";


$stmt = $conn->prepare("SELECT * FROM appointment as ap INNER JOIN prescription as p ON ap.apt_id=p.apt_id AND p.user_id=ap.user_id AND p.date=ap.apt_date AND p.p_id=? AND ap.apt_date=? AND p.user_id=? AND ap.doctor_status= ? ");
$stmt->bind_param("ssss",$p_id,$_POST["dates"], $_SESSION["user_id"], $doctor_status);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) { 

$output .='

<table class="table table-striped custom-table mb-0">
     <thead>
         <tr>       
            <th>Prescription ID</th>
            <th>Appointment ID</th>
           
            <th>Prescription Date </th>
        </tr>
    </thead>';
                               
        while($row = $result->fetch_assoc()) {
  
        $output .='
                                
         <tr>
                                
            <td><a href="select_prescription.php?pres_id='.$row["pres_id"].'&apt_id='.$row["apt_id"].'&apt_date='.$row["apt_date"].' " onclick="(this.id)" data-toggle="modal" id="rep1" apt_id= '.$row['apt_id'].' p_id= '.$row['p_id'].'  apt_date= '.$row['apt_date'].' user_id= '.$row['user_id'].'  No= '.$row['No'].' pres_id='.$row["pres_id"].'  data-target="#open">'.$row["pres_id"].'</a></td>
            <td id="pres">'.$row["apt_id"].'</td>';

        $output .='
           
            <td>'.$row["apt_date"].'</td>
        </tr>   ';
                               
    }  
                                                  
                                
        }else{
          echo 'Not Found';
             }

echo $output;   
                          


?>