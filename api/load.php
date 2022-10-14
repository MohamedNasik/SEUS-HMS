
<?php

        // Initialize the session
         session_start();


$connect = new PDO('mysql:host=localhost;dbname=hmsproject', 'root', '');

$data = array();
$userid=$_POST['user_id'];

$query = "SELECT * FROM patient_schedule as ps INNER JOIN appointment as  a ON ps.apt_id=a.apt_id AND ps.user_id=a.user_id AND a.p_id=ps.p_id AND DATE_FORMAT(ps.end_time,'%Y-%m-%d')=a.apt_date AND ps.user_id='".$userid."' AND a.admin_status='1' AND a.patient_status='1' ORDER BY ps.id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{

$sql = "SELECT * FROM patients WHERE p_id='".$row["p_id"]."' ";
$statement1 = $connect->prepare($sql);
$statement1->execute();
$result1 = $statement1->fetchAll();

foreach($result1 as $rows)
{

$title =  $rows["prefix"].' '. $rows["p_fname"] .' '.$rows["p_lname"] ;

   $data[] = array(
      'id'   => $row["id"],
      'title'  => $title,
      'start'  => $row['start_time'],
      'end'  => $row['end_time'],
      'backgroundColor'  => $row['color'],
      'textColor'  => $row['text_color']
   );
}
}
echo json_encode($data);

?>




