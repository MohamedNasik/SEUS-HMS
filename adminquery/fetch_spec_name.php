
<?php
include('../auth/dbconnection.php');
$output='';
$sql="SELECT * from schedule WHERE specilization='".$_POST['doc_spec_id']."'";
$result=mysqli_query($conn,$sql);
$output='<option value="Select Doctor">Select Doctor</option>';
while($row=mysqli_fetch_array($result)){

  $output.='<option value="'.$row["username"].'">'.$row["username"].'</option>';
}
echo $output;

?>


