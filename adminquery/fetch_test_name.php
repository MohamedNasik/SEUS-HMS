
<?php
include('../auth/dbconnection.php');
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


if(isset($_POST['test_id'])){
$output='';
$sql="SELECT * from testings where test_id='".$_POST['test_id']."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
$name= $row["testing_name"];

  $output.='     '.$name.'   ';

}
echo $output;
}



if(isset($_POST['testid'])){
  $output='';
  $sql="SELECT * from testings where test_id='".$_POST['testid']."'";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result)){
  $testing_charge= $row["testing_charge"];
  
    $output.='     '.$testing_charge.'   ';
  
  }
  echo $output;
  }


?>
