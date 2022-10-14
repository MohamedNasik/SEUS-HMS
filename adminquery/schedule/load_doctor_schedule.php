
<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

$data = array();

$query = "SELECT * FROM doctor_schedule AS ds INNER JOIN doctor_specialist as d ON ds.user_id=d.user_id  ORDER BY d.user_id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
  $specilization=$row["specilization"];
  $doctor_name=$row["doctor_name"];


  $result = 'Dr. '. $doctor_name   .'  ('.$specilization.')';

 $data[] = array(

          'doctor_schedule_id'   => $row["doctor_schedule_id"],

          'title'   => $result,

        'start'  => $row['start_time'],

        'end'  => $row['end_time']
       
        
 );
}

echo json_encode($data);

?>

