<?php 

session_start();


include ('../auth/dbconnection.php');
$output='';
$pres=$_POST['pres'];

$sql = "SELECT * FROM testing_schedule as t INNER JOIN prescription AS p ON t.pres_id=p.pres_id INNER JOIN users as u ON u.user_id=p.user_id AND (t.patient_status='1' || t.patient_status='3')   AND p.pres_id='". $pres."' ";

$result =mysqli_query($conn,$sql);
 
$output .=  '

<table class="datatable table table-stripped ">
<thead>
<tr>

<th>Test Name</th>
<th>Testing Status</th>

</tr>
</thead>


';

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result))
    {
    

    $output .=  '
    <tbody>


	<tr>
             <td><a href="#">  '.  $row['testing_perform'].'   </a></td>
             <td>';   if( $row['lab_status']=='0' ) {   
$output .=  '      <span class="custom-badge status-red">Not Completed</span>';
                     } elseif( $row['lab_status']=='1' ) {   
 $output .=  '   <span class="custom-badge status-green">Completed</span>';
                     } elseif( $row['lab_status']=='2' ) {   
 $output .=  '   <span class="custom-badge status-blue">In progress</span>';
                     }
      $output .=  '    </td>

     

          
    </tr>';


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