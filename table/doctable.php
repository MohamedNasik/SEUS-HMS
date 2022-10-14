<?php 

session_start();


include ('../auth/dbconnection.php');
$output='';
$query="SELECT * FROM appointment as ap INNER JOIN opd_payments as opd ON ap.No=opd.No INNER JOIN users as u ON ap.user_id=u.user_id AND ap.apt_date=curdate() AND admin_status='1' AND doctor_status='3' AND (status='1' OR status='4')  AND u.user_id='".$_SESSION['user_id']."' ";
$results =mysqli_query($conn,$query);

$output .=  '
<table class="table mb-0">

    <tr>
        <th>Appointment ID</th>
        <th>Patient Name</th>
        <th>Apt.Type</th>
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

    
    <h2><a href="profile.php">'.$row['apt_id'].' </a></h2>
    </td>

    <td style="min-width: 200px;">
       <small> <a class="avatar" href="#">SEUS</a> </small>
        <h2><a href="#">'.$row['patient_name'].'</a></h2>
    </td>  

    <td>
       
        <p> '.$row['type'].'</p>
    </td>

    <td>
        <h5 >'.$row['apt_date'].'</h5>
    </td>';
    if ($row['type']=='Check Report'){  

        $output .=  '
    <td class="text">
        <a href="open_report.php?p_id='.$row['p_id'].'&userid='.$row['user_id'].'&aptid='.$row['apt_id'].'&pname='.$row['patient_name'].'&date='.$row['apt_date'].'&no='.$row['No'].' " name="takeup" id="'.$row['apt_id'].'" class="btn btn-outline-primary take-btn">Take up</a>
    </td>';

    }if ($row['type']=='Consultation'){  

       
$arr = array('p_id' => $row['p_id'], 'userid' => $row['user_id'], 'aptid' => $row['apt_id'], 'pname' => $row['patient_name'], 'date' => $row['apt_date'],'no' => $row['No']);

$all= json_encode($arr);
$alls = base64_encode($all);

        $output .=  '
        <td class="text">
            <a href="prescription.php?datas='.$alls.'" name="takeup" id="'.$row['apt_id'].'" class="btn btn-outline-primary take-btn">Take up</a>
        </td>';
    }

    $output .=  '   
</tr>
    
';
}

}else{

    $output .=  '
<tr>
<td colspan="5" align="center"> Currently You have not any appointments :-( </td>
</tr>
';


}

$output .=  '</table>';

echo $output;

?> 