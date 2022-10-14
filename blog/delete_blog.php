<?php

require_once '../auth/dbconnection.php';

// delete blogs
$stmt = $conn->prepare("DELETE FROM blog WHERE blog_id = ?");
$stmt->bind_param("i",$_POST["data_id"]);
$stmt->execute();
$stmt->close();


?>