<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

if(isset($_POST["sch_id"]))
{


 $query = " UPDATE schedule 
 SET title=:title, start_time=:start_time, end_time=:end_time 
 WHERE sch_id=:sch_id ";

 $statement = $connect->prepare($query);

echo $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_time' => $_POST['start'],
   ':end_time' => $_POST['end'],
   ':sch_id'   => $_POST['sch_id']
  )
 );
}

?>

