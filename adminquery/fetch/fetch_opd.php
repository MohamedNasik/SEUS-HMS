<?php

session_start();

// Include db file
require_once "../../auth/dbconnection.php";
$output='';

$stmt = $conn->prepare("SELECT * FROM opd_payments as opd INNER JOIN appointment as ap ON opd.apt_id=ap.apt_id INNER JOIN doctorspecilization as ds ON opd.doc_spec_id = ds.doc_spec_id
INNER JOIN patients as p ON p.p_id=ap.p_id INNER JOIN users as u ON u.user_id=ap.user_id AND opd.p_id=?");
$stmt->bind_param("i",$_POST["patient_id"]);
$stmt->execute();
$result = $stmt->get_result();
$output.="
<table class='table table-striped custom-table mb-0' id='myTable'>
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Doctor</th>
                                        <th>Specialist</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>";
                                    
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()) {
        $date=   date('dS F Y', strtotime($row['date']));

        $output.='
        <tr>
        <td><a href="view_opd_payment.php?opd_id= '.$row["opd_payment_id"].' &pid='. $row["p_id"].'>&username='. $row["fname"]  .' '. $row["lname"]  .' &fees='. $row["fees"] .'&aptid='.$row["apt_id"] .'"> '.$row["opd_payment_id"].'   </a></td>
        <td>  '.$row['fname'].' '.$row['lname'] .'   </td>
        <td> '. $row['specilization'].'   </td>
        <td>  '. $date.'   </td>
        <td> '. $row['fees'].'   </td>
        <td >
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="view_opd_payment.php?opd_id= '.$row["opd_payment_id"].' &pid='. $row["p_id"].'>&username='. $row["fname"]  .' '. $row["lname"]  .'   &fees='. $row["fees"] .'&aptid='.$row["apt_id"] .'"><i class="fa fa-eye m-r-5"></i> View</a>
                   
                </div>
            </div>
        </td>
    </tr>';
    }

}else {
    $output.='
    <tr>
    <td colspan="6" class="text-center">  No Data Found   </td>';
}
$output.='</table>';
echo $output;

?>