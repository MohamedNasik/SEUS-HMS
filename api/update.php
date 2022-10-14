

<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

if(isset($_POST["id"]))
{


 $query = " UPDATE patient_schedule 
 SET start_event=:start_time, end_event=:end_time 
 WHERE id=:id ";

 $statement = $connect->prepare($query);

echo $statement->execute(
  array(
   ':id'  => $_POST['id'],
   ':start_time' => $_POST['start'],
   ':end_time' => $_POST['end']
  )
 );
}

?>

