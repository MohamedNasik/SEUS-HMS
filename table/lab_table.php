<?php 

include ('../auth/dbconnection.php');
$output='';
$query="SELECT * from testing_schedule Inner JOIN patients ON patients.p_id= testing_schedule.p_id AND testing_schedule.update_status='0' GROUP BY testing_schedule.pres_id ORDER BY testing_schedule.testing_schedule_id";


$results =mysqli_query($conn,$query);

$output .=  '
<table class="table mb-0">

    <tr>
    <th>Presc.ID</th>
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


    <td style="min-width: 100px;">

    
    <h2>'.$row['pres_id'].'</h2>
    </td>
    <td style="min-width: 100px;">
        <a class="avatar" href="#">B</a>
        <h2><a href="#">'.$p_name.' <span></span></a></h2>
    </td>  



    <td>
        <h5 class="time-title p-0">'.$row['submit_date'].'</h5>
      
    </td>';


    $output .=  '  <td >
    <a href="tests.php?schid='.$row['testing_schedule_id'].'&presid='.$row['pres_id'].'&name='.$p_name.'&id='.$row['p_id'].'&testings='.$row['testing_perform'].'" name="takeup1" class="btn btn-outline-primary take-btn"> <i class="fa fa-edit m-r-5"></i> Take Up</a>
    </td>';






}

}else{

    $output .=  '
<tr>
<td colspan="7"> <center> Currently there are no pending tests right now :-( </center> </td>
</tr>
';


}

$output .=  '</table>';

echo $output;

?> 