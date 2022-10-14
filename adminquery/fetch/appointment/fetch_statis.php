
<?php   
session_start();
require_once "../../../auth/dbconnection.php";

if(isset($_POST['startdate'] )){


$output ='';

$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

$query = "SELECT decease_name ,date, count(*) Consultations from prescription WHERE date BETWEEN  '$startdate' AND  '$enddate' AND  decease_name !='Reconsultation Need'   group by decease_name , date";

$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0){

   

$output .='

<table class="datatable table table-stripped ">
<thead>
    <tr>
        <th>Month</th>
        <th>Decease</th>
        <th>Number</th>

    </tr>
</thead>
<tbody>';
$data = array();
while($row=mysqli_fetch_array($result)){

  $chart_datass = $row['decease_name'] ;
  $label1 = $row['Consultations'];
  $label2 = $row['date'];

  $label2 = date('F, Y ', strtotime($label2));


  



  $output .='


    <tr>
        <td>  '.$label2 .'    </td>
        <td>  '.$chart_datass .'    </td>
        <td>  '.$label1 .'    </td>
  
    </tr>';
  } 





  $output .='

</tbody>
</table>

<center>
<a  href="adminquery/fetch/appointment/fetch_statis.php?print=2&start='.$startdate .'&end='.$enddate .'" ><i class="fa fa-print"></i> View Results</a> </center>



';



// line graph js





                             
    

                        }else{
                            $output .=  '
                        <tr>
                        <td colspan="5" align="center"> No more data found :-( </td>
                        </tr>
                        ';
                        
                        
                        
                        
                        }


                    
 echo $output;   
                      }
          

//  header('Content-Type: application/json');

//  $startdates = $_POST['startdate'];
//  $enddates = $_POST['enddate'];


//  $query = "SELECT decease_name ,date, count(*) Consultations from prescription WHERE date BETWEEN  '$startdates' AND  '$enddates' AND  decease_name !='Reconsultation Need'   group by decease_name , date";

//  $result=mysqli_query($conn,$query);
//  if(mysqli_num_rows($result)>0){

// 	$data = array();

// 		foreach($result as $row)
// 		{
// 			$data[] = array(
// 				'decease_name'		=>	$row["decease_name"],
// 				'Consultations'			=>	$row["Consultations"],

//         $date = date('F, Y ', strtotime($row["date"])),


// 				'date'			=>$date,
// 			);
// 		}

//  }

//  echo  json_encode($data);


if(isset($_GET['print'])){


if($_GET['print'] == '1' ){


  $stmt3 = $conn->prepare("SELECT decease_name, DATE_FORMAT(date, '%M, %Y') as dates, count(*) Consultations from prescription WHERE decease_name !='Reconsultation Need'  group by decease_name , DATE_FORMAT(date, '%M')");

  $stmt3->execute();
  $result3 = $stmt3->get_result();
  $chart_datass = '';
  $label1 = '';
  $label2 = '';
  
  
  require_once "../../../fpdf/fpdf.php";


  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',12);

  $image1 = "logo-dark.png";


  // $pdf->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
  $pdf-> Image('../../../assets/img/'.$image1,10,15,35,35);


   $pdf->Cell(150,50,'Predicted Deceases Found (All)',50,1,'C');
   $pdf->Cell(30,10,'SEUS Hospital',10,1,'C');


  $pdf->Cell(47,12,'Month (Year)',1);
  $pdf->Cell(47,12,'Deceases Found',1);
  $pdf->Cell(47,12,'Number of Patients',1,true);



  while($row = mysqli_fetch_array($result3)){
        
    $chart_datass = "".$row['decease_name']." ";
      $label1 = "".$row['Consultations']." ";
      $label2 = "".$row['dates']." ";

    $pdf->Cell(47,12,$label2,1);
    $pdf->Cell(47,12,$chart_datass,1);
    $pdf->Cell(47,12,$label1 ,1,true);




  


  }


  $pdf->Output();

}

if($_GET['print'] == '2' ){

  $start=$_GET['start'];
  $end=$_GET['end'];

  
  $query = "SELECT decease_name ,date, count(*) Consultations from prescription WHERE date BETWEEN  '$start' AND  '$end' AND  decease_name !='Reconsultation Need'   group by decease_name , date";
  
  $result=mysqli_query($conn,$query);
  
  
  require_once "../../../fpdf/fpdf.php";



  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',12);

  $image1 = "logo-dark.png";


  // $pdf->Cell( 40, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );
  $pdf-> Image('../../../assets/img/'.$image1,10,15,35,35);


   $pdf->Cell(190,50,'Predicted Deceases Found ('.$start.' to '.$end.')',50,1,'C');
   $pdf->Cell(30,10,'SEUS Hospital',10,1,'C');


  $pdf->Cell(47,12,'Month (Year)',1);
  $pdf->Cell(47,12,'Deceases Found',1);
  $pdf->Cell(47,12,'Number of Patients',1,true);





  while($row=mysqli_fetch_array($result)){

    $chart_datass = $row['decease_name'] ;
    $label1 = $row['Consultations'];
    $label2 = $row['date'];
  
    $label2 = date('F, Y ', strtotime($label2));

    $pdf->Cell(47,12,$label2,1);
    $pdf->Cell(47,12,$chart_datass,1);
    $pdf->Cell(47,12,$label1 ,1,true);




  


  }


  $pdf->Output();

}




}




 ?>




                    