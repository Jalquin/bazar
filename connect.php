<?php
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bazos";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

