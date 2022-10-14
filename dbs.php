<?php

$mysqli = new mysqli("localhost", "root", "");

/* check connection */

if (mysqli_connect_errno()) {

printf("Connect failed: %s\n", mysqli_connect_error());

exit();

}

/* print server version */

printf("Server version: %s\n", $mysqli->server_info);

/* close connection */

$mysqli->close();

?>