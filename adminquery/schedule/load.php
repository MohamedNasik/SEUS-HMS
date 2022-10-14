
<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

$data = array();

$query = "SELECT * FROM schedule ORDER BY sch_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
          'sch_id'   => $row["sch_id"],

        'title'  => $row['title'],

        'start'  => $row['start_time'],
        'end'  => $row['end_time']
        
 );
}

echo json_encode($data);

?>

