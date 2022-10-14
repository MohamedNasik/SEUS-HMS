<?php 

include ('../auth/dbconnection.php');
$output='';
$query="SELECT * FROM appointment as ap INNER JOIN opd_payments as opd ON ap.apt_date=opd.apt_date INNER JOIN users as u ON ap.user_id=u.user_id AND ap.apt_date=curdate() AND admin_status='1' AND doctor_status='3' AND (status='1' || status='4') AND ap.p_id=opd.p_id AND ap.No=opd.No";

$results =mysqli_query($conn,$query);

$output .=  '
<table class="table mb-0">

    <tr>
    <th>Appointment ID</th>
       <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Date</th>
    
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
        <a class="avatar" href="#">SEUS</a>
        <h2><a href="#">'.$row['patient_name'].' <span></span></a></h2>
    </td>  

    <td>
        <h5 class="time-title p-0">Appointment With</h5>
        <p>Dr. '.$row['fname'].' '.$row['lname'].'</p>
    </td>

    <td>
        <h5 class="time-title p-0">'.$row['apt_date'].'</h5>
        <p></p>
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