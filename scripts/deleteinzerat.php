<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];
$inzeratid = $_GET["id"];
$zboziid = "";

//echo $uzivatelid.$inzeratid;


//$kategorie = $_POST["kategorie"];

//select celej inzerat a ziskej id zbozi

//tohle ošetřit prepaded statementem
$selectinzerat = mysqli_query($conn,"SELECT * FROM `inzerat` WHERE id = $inzeratid LIMIT 1");
foreach ($selectinzerat as $inzerat){
    $zboziid = $inzerat["Zbozi_id"];
}

$deleteinzerat = mysqli_query($conn,"DELETE FROM inzerat WHERE id = $inzeratid");
$deletezbozi = mysqli_query($conn,"DELETE FROM zbozi WHERE id = $zboziid");

//header("Location: ../index.php?pages=myListing&id=$uzivatelid");

?>