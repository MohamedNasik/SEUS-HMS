
<?php
include('../auth/dbconnection.php');
$output='';
$sql="SELECT * from patients where p_id='".$_POST['p_id']."'";
$result=mysqli_query($conn,$sql);
$output='<option value="Select Patient Name">Select Patient Name</option>';
while($row=mysqli_fetch_array($result)){

  $output.='<option value="'.$row["p_id"].'">'.$row["p_fname"].' '.$row["p_lname"].'</option>';
}
echo $output;
?>


dfdf