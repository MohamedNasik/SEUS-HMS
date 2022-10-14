<?php

session_start();
require_once "../auth/dbconnection.php";


require '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

//  pay payment
if (isset($_POST['doc_spec_id'])) {

    $GLOBALS['doc_spec_id'] = $_POST["doc_spec_id"];
    $GLOBALS['fees'] = $_POST["fees"];
    $GLOBALS['apt_id'] = $_POST["apt_id"];
    $GLOBALS['p_id'] = $_POST["p_id"];
    $GLOBALS['user_id'] = $_POST["user_id"];
    $GLOBALS['no'] = $_POST["no"];
    $GLOBALS['apt_date'] = $_POST["apt_date"];
    $GLOBALS['cur_date'] = date('Y-m-d H:i:s');
    $GLOBALS['status'] = "1";

//  search doctor name 
$stmt2 = $conn->prepare("SELECT * FROM opd_payments WHERE p_id =? AND user_id=? AND apt_date = ? AND No=?");
$stmt2->bind_param("ssss", $_POST['p_id'],$_POST['user_id'], $GLOBALS['apt_date'],$GLOBALS['no']);
$stmt2->execute();
$result = $stmt2->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {

$opd_payment_id= $row['opd_payment_id'];

}


$stmt1 = mysqli_prepare($conn,"UPDATE opd_payments SET charge =? , status=?  WHERE opd_payment_id=? ");
        
$fees=$_POST["fees"];
$status="1";

 $stmt1->bind_param("sss",$fees,$status,$opd_payment_id);


 $status = $stmt1->execute();

 echo 'Payment Proceeds';


 if ($status === false) {
    trigger_error($stmt1->error, E_USER_ERROR);
  }

mysqli_stmt_execute($stmt1); 
mysqli_stmt_close($stmt1);

}else{





    function add($a){
        global $conn;

        try {

            $stmt = $conn->prepare("INSERT INTO opd_payments (opd_payment_id,No,apt_id,user_id,p_id,doc_spec_id,charge,apt_date,date,status) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?,?)");
 
            $stmt->bind_param("ssssssssss",$GLOBALS['a'],$GLOBALS['no'] ,$GLOBALS['apt_id'] ,$GLOBALS['user_id'],$GLOBALS['p_id'],$GLOBALS['doc_spec_id'],$GLOBALS['fees'],$GLOBALS['apt_date'],$GLOBALS['cur_date'], $GLOBALS['status']);
            
           $status = $stmt->execute();        
             
             if ($status === true) {
                 echo 'Payment Proceeds';
             } else {
                echo "ERROR: Could not prepare query:" . mysqli_error($conn);
            }

         } catch (Exception $exc) {   
             //handle any errors in your code, including connection issues
             echo "ERROR: Could not prepare query:" . mysqli_error($conn);
             //this will be your "flag" to handle on the client side
             //and if you want, can also log the error with 
             //$exc->getMessage() or $exc->getTraceAsString()
         }
    
    
      }

      $query = "SELECT * FROM opd_payments ORDER BY opd_payment_id DESC LIMIT 1";
      if($result = mysqli_query($conn,$query));
       if(mysqli_num_rows($result)>0){
       while($row = mysqli_fetch_array($result)){
     $lastid=$row['opd_payment_id'];
      }
      $search = 'OPD-' ;
    
    
       $trimmed = str_replace($search,'',$lastid) ;   
    
      $srting_trimmed = (string)$trimmed;
       $id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010
    
       $var='OPD-';
    
         $new_id=$var.''.$id;
         $GLOBALS['a'] =  $new_id;
    add(12);
    
      
      }else{
        
        $var='OPD-';
        $num= '0001';
    
      $new_id=$var.''.$num;
      $GLOBALS['a'] =  $new_id;
    
     add(12);
    
    
      }
    
    }



}

//  recash 
if (isset($_POST['payment_id_2'])) {

    $status="2";
    $patient="0";
    $admin="0";
    $payment_id_2=$_POST['payment_id_2']; 
    $apt_id=$_POST['apt_id']; 
    $no=$_POST['no']; 


        try {
            $stmt = $conn->prepare("UPDATE opd_payments SET status = ? WHERE opd_payment_id= ?");
            $stmt->bind_param("ss",$status, $payment_id_2);
            $status = $stmt->execute();
            
            if ($status === true ) {
                echo 'Payment refund';
            } else {
                throw new Exception('cant change');
            }
        } catch (Exception $exc) {   
            //handle any errors in your code, including connection issues
            echo "ERROR: Could not prepare query:" . mysqli_error($conn);
            //this will be your "flag" to handle on the client side
            //and if you want, can also log the error with 
            //$exc->getMessage() or $exc->getTraceAsString()
          
        }

}

//  cancel payment
if (isset($_POST['no_payment_id'])) {


  $GLOBALS['doc_spec_id'] = $_POST["docspecid"];
  $GLOBALS['apt_id'] = $_POST["apt_id"];
  $GLOBALS['p_id'] = $_POST["p_id"];
  $GLOBALS['user_id'] = $_POST["user_id"];
  $GLOBALS['no'] = $_POST["no"];
  $GLOBALS['apt_date'] = $_POST["apt_date"];
  $GLOBALS['cur_date'] = date('Y-m-d H:i:s');
  $GLOBALS['status'] = "1";
  $GLOBALS['fees'] = $_POST["fees"];
  $GLOBALS['no_payment_id'] = $_POST["no_payment_id"];

//  search doctor name 
$stmt2 = $conn->prepare("SELECT * FROM opd_payments WHERE p_id =? AND user_id=? AND apt_date = ? AND No=?");
$stmt2->bind_param("ssss", $_POST['p_id'],$_POST['user_id'], $GLOBALS['apt_date'],$GLOBALS['no']);
$stmt2->execute();
$result = $stmt2->get_result();
if(mysqli_num_rows($result)>0){
while($row = $result->fetch_assoc()) {

$opd_payment_id= $row['opd_payment_id'];
$statuss= $row['status'];

if($statuss == '1'){

  $fees="0";
  $status="4";

  $stmt5 = mysqli_prepare($conn,"UPDATE opd_payments SET charge =? , status=?  WHERE opd_payment_id=? ");
      
  // $fees=$_POST["fees"];
  // $status="1";
  
  $stmt5->bind_param("sss",$fees,$status,$opd_payment_id);
  
  
  $status5 = $stmt5->execute();
  
  echo 'Payment Proceeds';
  
  
  if ($status5 === false) {
    trigger_error($stmt1->error, E_USER_ERROR);
  }
  
  





 } elseif($statuss == '4'){

  $stmt6 = mysqli_prepare($conn,"UPDATE opd_payments SET charge =? , status=?  WHERE opd_payment_id=? ");
      
  // $fees=$_POST["fees"];
  // $status="1";
  
  $stmt6->bind_param("sss",$GLOBALS['fees'],$GLOBALS['status'],$opd_payment_id);
  
  
  $status6 = $stmt6->execute();
  
  echo 'Payment Proceeds';
  
  
  if ($stmt6 === false) {
    trigger_error($stmt1->error, E_USER_ERROR);
  }
  





}



}




}else{





  function add($a){
    global $conn;

$fees="0";
$status="4";

$stmt5 = $conn->prepare("SELECT * FROM check_report WHERE p_id=? AND user_id=? AND check_date= ? ");
$stmt5->bind_param("sss",$GLOBALS['p_id'],$GLOBALS['user_id'],$_POST["apt_date"] );
$stmt5->execute();
$result5 = $stmt5->get_result();
if(mysqli_num_rows($result5) > 0){

    try {

        $stmt = $conn->prepare("INSERT INTO opd_payments (opd_payment_id,No,apt_id,user_id,p_id,doc_spec_id,charge,apt_date,date,status) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?,?)");

        $stmt->bind_param("ssssssssss",$GLOBALS['a'],$GLOBALS['no'] ,$GLOBALS['apt_id'] ,$GLOBALS['user_id'],$GLOBALS['p_id'],$GLOBALS['doc_spec_id'],$fees,$GLOBALS['apt_date'],$GLOBALS['cur_date'], $status);
            
        $status = $stmt->execute();        
         
         if ($status === true) {
             echo 'Payment Proceeds';
         } else {
             throw new Exception('cant change');
         }
    } catch (Exception $exc) {   
        //handle any errors in your code, including connection issues
        echo "ERROR: Could not prepare query:" . mysqli_error($conn);
        //this will be your "flag" to handle on the client side
        //and if you want, can also log the error with 
        //$exc->getMessage() or $exc->getTraceAsString()
      
    }

}else {
    echo 'Select the Prescription ID';
}

}

$query = "SELECT * FROM opd_payments ORDER BY opd_payment_id DESC LIMIT 1";
if($result = mysqli_query($conn,$query));
if(mysqli_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
$lastid=$row['opd_payment_id'];
}
$search = 'OPD-' ;


$trimmed = str_replace($search,'',$lastid) ;   

$srting_trimmed = (string)$trimmed;
$id= str_pad(intval($srting_trimmed) + 1, strlen($srting_trimmed), '0', STR_PAD_LEFT); // 000010

$var='OPD-';

$new_id=$var.''.$id;
$GLOBALS['a'] =  $new_id;
add(12);


}else{

$var='OPD-';
$num= '0001';

$new_id=$var.''.$num;
$GLOBALS['a'] =  $new_id;

add(12);


}

  
  }




}





if (isset($_GET['print'])) {


// mhdfbkdbfmhdbmfb

require_once "../fpdf/fpdf.php";


  $stmt11 = $conn->prepare("SELECT * FROM opd_payments as o INNER JOIN appointment as a on a.No=o.No AND o.No=? INNER JOIN doctor_specialist as d ON a.user_id=d.user_id");
  $stmt11->bind_param("s",$_GET['no']);
  $stmt11->execute();
  $result = $stmt11->get_result();
 
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',12);


  if(mysqli_num_rows($result)>0){

    while($row = mysqli_fetch_array($result)){
        
      $chart_datass = "". $row['patient_name']." ";
      $label1 = "". $row['patient_name']." ";
      $label2 = "". $row['charge']." ";

      $status =  $row['status'];


 $image1 = "logo-dark.png";

  // $pdf->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
  $pdf->Cell(200,20,'Payment Slip',10,50,'C');

  $pdf-> Image('../assets/img/'.$image1,10,10,25,25);




$pdf->Cell(10,30,'Billing',10,1);

$pdf->Cell(60,12,'Payment ID',1);
$pdf->Cell(60,12,'Apt ID',1);
$pdf->Cell(60,12,'Apt date',1,true);

$pdf->Cell(60,12,$row['opd_payment_id'],1);
$pdf->Cell(60,12,$row['apt_id'],1);
$pdf->Cell(60,12,$row['apt_date'],1,true);



$pdf->Cell(50,12,'Patient name',1);
$pdf->Cell(130,12,$row['patient_name'],1,true);


$pdf->Cell(50,12,'Doctor name',1);
$pdf->Cell(130,12,$row['doctor_name'].' ('.$row['specilization'].')',1,true);


$pdf->Cell(50,12,'Charge',1);
$pdf->Cell(65,12,$row['charge'],1);

if( $status == '1'){
  
  $pdf->Cell(65,12,'Paid',1,true);
}
if( $status == '2'){ 
  $pdf->Cell(65,12,'Refunded',1,true);
 }
if( $status == '4'){
  $pdf->Cell(65,12,'Cancelled',1,true);
  }





  }
  
      }else{

        $pdf->Cell(47,12,"No slips found");

      }

      $pdf->Output();




  }


  













?>