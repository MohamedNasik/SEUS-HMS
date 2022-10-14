<?php 

include ('../auth/dbconnection.php');
$output='';
$query="SELECT * FROM appointment WHERE apt_date=curdate() AND admin_status='1' AND doctor_status='3' ";

$results =mysqli_query($conn,$query);

$output .=  '
<table class="table mb-0">

    <tr>
    <th>Appointment ID</th>
       <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

';

if(mysqli_num_rows($results) > 0){
while($row =mysqli_fetch_array($results) )
{

    $output .=  '


    <tr>

    <td style="min-width: 200px;">

    
    <h2><a href="profile.php">'.$row['apt_id'].'</a></h2>
    </td>

    <td style="min-width: 200px;">
        <a class="avatar" href="profile.php">B</a>
        <h2><a href="profile.php">'.$row['patient_name'].' <span>New York, USA</span></a></h2>
    </td>  

    <td>
        <h5 class="time-title p-0">Appointment With</h5>
        <p>Dr. '.$row['doctor_name'].'</p>
    </td>

    <td>
        <h5 class="time-title p-0">'.$row['apt_date'].'</h5>
        <p>7.00 PM</p>
    </td>

    <td class="text-right">
        <a href="" name="takeup" data-toggle="modal" id="rep2" data_id='.$row['apt_id'].' data-target="#delete_appointment" class="btn btn-outline-primary take-btn"> <i class="fa fa-trash-o m-r-5"></i> Cancel</a>
      

        </td>
</tr>
    
';
}

}else{

    $output .=  '
<tr>
<td colspan="5"> <center> Currently there are no appointments </center> </td>
</tr>
';


}

$output .=  '</table>';

echo $output;

?> 