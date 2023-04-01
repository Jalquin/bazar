<?php
require("../connect.php");
session_start();

$userid = $_SESSION["id"];
$imageid = $_GET["id"];
$zboziid = $_GET["zboziid"];

//tady musi byt osetreni jestli je to opravdu vlastnik toho inzeratu

//zjisti nazev obrazku
$picturename = "";
$nazevobrazku = "SELECT * FROM obrazky WHERE id = $imageid LIMIT 1";
$resultnazevobrazku = $conn->query($nazevobrazku);
foreach ($resultnazevobrazku as $obrazek){
    $picturename = $obrazek["src"];
}

echo $picturename;

//smaz vazbu obrazku
$sql = "DELETE FROM `zbozi_ma_obrazky` WHERE `zbozi_ma_obrazky`.`Zbozi_id` = $zboziid AND `zbozi_ma_obrazky`.`Obrazky_id` = $imageid";
$result = $conn->query($sql);

//smaz obrazek
$sql = "DELETE FROM obrazky WHERE `obrazky`.`id` = $imageid";
$result = $conn->query($sql);

$path = "../images/inzeraty/".$picturename;

unlink($path);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
//header("Location: ../index.php?pages=myListings&id=$userid");
//header("Location: ../index.php?pages=editListing&id=$inzeratid");

?>