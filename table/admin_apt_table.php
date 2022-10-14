<?php 

session_start();


include ('../auth/dbconnection.php');
$output='';

$sql = "SELECT * FROM appointment as a,users as u  WHERE a.user_id= u.user_id ORDER BY apt_id DESC";
$result =mysqli_query($conn,$sql);
 
$output .=  '

<table class="datatable table table-stripped">
<thead>                      
<tr>
<th>Appointment ID</th>
    <th>Doctor Name</th>
    <th>Specialization</th>			
    <th>Patient Name</th>
    <th>Fees</th>
    <th>Appointment Date</th>
   
    <th>Status</th>
    <th class="text-right">Action</th>
</tr>

</thead>


';

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result))
    {
    

    $output .=  '
    <tbody>
    <tr>

    <td>  '.$row['apt_id'].' </td>
    <td>  '.$row['doctor_name'].'</td>
    <td>  '.$row['specilization'].'</td>
    <td>  '.$row['patient_name'].'</td>	
    <td>  '.$row['fees'].'</td>
    <td>  '.$row['apt_date'].' </td>
    
    <td>';
    

     if($row['admin_status']=="0") {  
        $output .=' <span class="custom-badge status-red">Cancel</span> ';
     } else if($row['admin_status']=="1") {    
        $output .='  <span class="custom-badge status-green">Active</span> ';
        } else {   
            $output .='   <span class="custom-badge status-blue">Pending</span>';

          } 
          $output .='  </td>

    <td class="text-right">
        <div class="dropdown dropdown-action">
            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="" data-toggle="modal" id="rep1" data_id= '.$row['apt_id'].'   data-target="#active_appointment"><i class="fa fa-trash-o m-r-5"></i> Active</a>
            <a class="dropdown-item" href="" data-toggle="modal" id="rep2" data_id= '.$row['apt_id'].'  data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i> Delete</a>

                </div>
        </div>
    </td>
</tr>
    
';
}

}else{

    $output .=  '
<tr>
<td colspan="4" align="center"> Currently You have not any appointments :-( </td>
</tr>
</tbody>
';


}

$output .=  '</table>';

echo $output;

?> 