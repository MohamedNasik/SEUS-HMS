<?php

//delete.php

if(isset($_POST["sch_id"]))
{
    $connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

    $query = "DELETE from schedule WHERE sch_id=:sch_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':sch_id' => $_POST['sch_id']
  )
 );
}

?>