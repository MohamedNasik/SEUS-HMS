<?php 

include ('../auth/dbconnection.php');
$output='';

                          
$query="SELECT * FROM testing_schedule AS ts INNER JOIN  patients AS p ON p.p_id = ts.p_id 
AND (ts.payment_status ='0' || ts.payment_status ='1' || ts.patient_status ='1' ) 
GROUP BY  ts.pres_id
ORDER BY ts.testing_schedule_id DESC;";

$results =mysqli_query($conn,$query);

$output .=  '
<table class="table mb-0">

    <tr>
        
        <th>Patient Name</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

';

if(mysqli_num_rows($results) > 0){
while($row =mysqli_fetch_array($results) )
{
    $p_name =$row['p_fname'].' '.$row['p_lname'];

    $output .=  '


    <tr>

   

    <td style="min-width: 200px;">
        <a class="avatar" href="#">SEUS</a>
        <h2><a href="#">'.$p_name.' <span></span></a></h2>
    </td>  



    <td>
        <h5 class="time-title p-0">'.$row['submit_date'].'</h5>
        <p></p>
    </td>

    <td>
        <a href="patient_view_tests.php?presid='.$row['pres_id'].'&names='.$p_name.'&date='.$row['submit_date'].'&pid='.$row['p_id'].'" name="takeup"  id="rep5" data-target="#take" class="btn btn-outline-primary take-btn"> <i class="fa fa-pencil"></i> Take It</a>
      

        </td>
</tr>
    
';
}

}else{

    $output .=  '
<tr>
<td colspan="5"> <center> Currently there are no payment  </center> </td>
</tr>
';


}

$output .=  '</table>';

echo $output;

?> 

