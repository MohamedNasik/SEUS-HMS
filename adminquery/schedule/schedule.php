<?php

include ('../../auth/config.php');


$query = "INSERT INTO schedule  (title,start_time,end_time)
VALUES (:title,:start_time,:end_time)";

$statement= $pdo->prepare($query);
$statement-> execute(


    array(

        ':title' => $_POST['title'],
        ':start_time' => $_POST['start'],
        ':end_time' => $_POST['end']



    )
);






?>


