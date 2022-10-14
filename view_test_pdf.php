
<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    }

    include ('auth/dbconnection.php');



   $stmt = $conn->prepare("SELECT * FROM test_invoices as ti INNER JOIN testings AS t ON ti.test_id=t.test_id INNER JOIN prescription as p ON p.pres_id=ti.pres_id INNER JOIN users as u ON u.user_id=ti.user_id AND ti.test_payment_id=? ");
   $stmt->bind_param("s", $_GET['test_payment_id']);
   $stmt->execute();
   $result = $stmt->get_result();
   if($result->num_rows === 0)  ;
   while($row = $result->fetch_assoc()) {

    $username= $row['fname'].' '.$row['lname'];
    $testing_name= $row['testing_name'];
    $pres_id= $row['pres_id'];
    $invoice_id=$row['test_payment_id']; 
    $payment_date=   date('dS F Y', strtotime($row['payment_date']));
    $date=   date('dS F Y', strtotime($row['date']));

   }

   require_once __DIR__ . '/vendor/autoload.php';
   $mpdf = new \Mpdf\Mpdf();
   $data= '';
       
   $data=         '<div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row custom-invoice">
                                    <div class="col-6 col-sm-6 m-b-20">
                                        <img src="assets/img/logo-dark.png" class="inv-logo" alt="">
                                        <ul class="list-unstyled">
                                           <strong> <li>SEUS Hospital</li>  </strong>
                                            <li>No, 22 Kahagolla</li>
                                            <li>Diyatalawa</li>
                                            <li>Srilanka</li>
                                        </ul>
                                    </div></div></div></div></div></div>';

                                    

$result = mysqli_query($conn, "SELECT SUM(charge) AS value_sum FROM test_invoices WHERE test_payment_id= '".$_GET['test_payment_id']."' "); 
$row = mysqli_fetch_assoc($result); 
$sum = $row['value_sum'];  


								
   

$mpdf->WriteHTML($data);
$mpdf->Output('mypdf.php');






?>