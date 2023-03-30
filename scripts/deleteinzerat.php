<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];
$inzeratid = $_GET["id"];
$zboziid = "";
$nazevzbozi = "";

//echo $uzivatelid.$inzeratid;


//$kategorie = $_POST["kategorie"];

//select celej inzerat a ziskej id zbozi

//tohle ošetřit prepaded statementem

$selectinzerat = mysqli_query($conn,"SELECT * FROM `inzerat` JOIN zbozi ON zbozi.id = inzerat.Zbozi_id WHERE inzerat.id = $inzeratid LIMIT 1");
foreach ($selectinzerat as $inzerat){
    $zboziid = $inzerat["Zbozi_id"];
    $nazevzbozi = $inzerat["nazev"];
}
$deletevazbu = mysqli_query($conn,"DELETE FROM uzivatel_vytvoril_inzerat WHERE `uzivatel_vytvoril_inzerat`.`Uzivatel_id` = $uzivatelid AND uzivatel_vytvoril_inzerat.Inzerat_id = $inzeratid");
$deleteinzerat = mysqli_query($conn,"DELETE FROM inzerat WHERE id = $inzeratid");
$deletezbozi = mysqli_query($conn,"DELETE FROM zbozi WHERE id = $zboziid");

$getnazevobrazku = mysqli_query($conn,"SELECT * FROM obrazky WHERE nazev = '$nazevzbozi' LIMIT 1");
foreach ($getnazevobrazku as $obrazek){
    $obrazeksrc = "../images/inzeraty/".$obrazek["src"];

    echo $obrazeksrc;
    unlink($obrazeksrc);

    $deleteobrazek = mysqli_query($conn,"DELETE FROM obrazky WHERE nazev = '$nazevzbozi'");
}

header("Location: ../index.php?pages=myListings&id=$uzivatelid");

?>