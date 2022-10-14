<?php

session_start();
require_once "../auth/dbconnection.php";

$output ='';

// $sql= "SELECT distinct * FROM testing_report WHERE EXISTS (  SELECT * FROM prescription WHERE testing_report.pres_id='".$_POST['id']."' AND prescription.user_id='".$_SESSION['user_id']."' )  ";
$sql= "SELECT * FROM testing_report AS t INNER JOIN  prescription AS pre ON pre.pres_id=t.pres_id AND t.pres_id='".$_POST['id']."' INNER JOIN testings as tes ON tes.test_id=t.test_id AND pre.user_id='".$_SESSION['user_id']."' INNER JOIN users as u ON u.user_id=t.user_id ";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){

  
$output .='

<table class="table table-striped custom-table mb-0">
    <thead>
        <tr>
                                       
            <th>Report ID</th>
            <th>Lab Asst.Name</th>
            <th>Test Name</th>
            <th>Created Date</th>
            <th>Due Date</th>
            <!-- <th class="text-right">Action</th> -->
        </tr>
    </thead>';
                               
        while($row=mysqli_fetch_array($result)){
                         
         $output .='
                                
            <tr>
                                
                <td><a href="invoice-view.php">'.$row["testing_report_id"].'</a></td>
                <td>'.$row["username"].'</td>
                <td><span class="custom-badge status-green">'.$row["testing_name"].'</span></td>
                <td>'.$row["date"].'</td>
                 <td>'.$row["date"].'</td>
                              
            </tr> ';
                                }  
                                                  
                                
}else{
    $output .=  '
<tr>
<td colspan="5" align="center"> Please select the patient Prescription ID :-( </td>
</tr>
';




}

echo $output;   




?>