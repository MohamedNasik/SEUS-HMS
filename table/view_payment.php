          <table id="myTable" class="table table-border table-hover custom-table mb-0">
             <thead>
 
                <tr>
                    <th align="center">Payment ID</th>
                    <th align="center">Apt_ID</th>
                    <th align="center">Doctor Name</th>
                    <th align="center">Patient ID</th>
                    <th align="center">Specilization</th>
                    <th align="center">Date</th>
                    <th align="center">Charge</th>
                    <th align="center">Status</th>                                     
                </tr>
             </thead>
            <tbody>

<?php
include '../auth/dbconnection.php';


$stmt = $conn->prepare("SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.apt_id=ap.apt_id INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN users as u ON u.user_id=ap.user_id");
$stmt->execute();
$result = $stmt->get_result();
    if(mysqli_num_rows($result)>0){

while($row = $result->fetch_assoc()) {

 $date=   date('dS F Y', strtotime($row['date']));


echo '
<tr>
<td> '.$row["opd_payment_id"].'</td>
<td> '.$row["apt_id"].'</td>
<td> '.$row["username"].'</td>
<td> '.$row["p_id"].'</td>
<td> '.$row["specilization"].'</td>
<td> '. $date.'</td>
<td> '.$row["fees"].'</td>';


if($row['status']=="0") {  
    echo ' <td> <span class="custom-badge status-red">Cancelled</span> </d>';
 } else if($row['status']=="1") {    
    echo ' <td> <span class="custom-badge status-green">Paid</span> </td>';
    } else {   
        echo ' <td>  <span class="custom-badge status-blue">Pending</span> </td>';

      } 


   

echo '<td align="center"> 

<div class="dropdown dropdown-action">
<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
<div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="view_payment.php?opd_id='.$row["opd_payment_id"].' &username='.$row["username"].'&spec='.$row["specilization"].'&fees='.$row["fees"].'&apt_id='.$row["apt_id"].'&pid='.$row["p_id"].'&date='.$date.'" ><i
            class="fa fa-money  m-r-5"></i> Pay</a>
    <a href="show_schedule.php?userid='.$row['user_id'].'" class="dropdown-item"><i class="fa fa-eye m-r-5"></i> View & Edit</a>
</div>
</div>


</td>';
 

'</tr>';

}


}else{

    echo ' <tr>  <td colspan="5"> <center> No records found  </center> </td>  </tr> ';
}
$stmt->close();

?>
                         </tbody>

                                 </table>