<?php
$mysqli = new mysqli('localhost', 'root', '', 'joyofphp'); // host, username, password, database

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>




