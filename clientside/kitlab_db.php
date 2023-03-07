<?php
$database = 'ete32e_2223zs_07';
$username = 'ete32e_2223zs_07';
$password = '140.10C+0A3!32';
$mysqli = new mysqli('localhost', $username, $password, $database);
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit();
} else {
    echo 'Connection to DB is OK.';
}
