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

$selectinzerat = mysqli_query($conn,"SELECT * FROM `Inzerat` JOIN Zbozi ON Zbozi.id = Inzerat.Zbozi_id WHERE Inzerat.id = $inzeratid LIMIT 1");
foreach ($selectinzerat as $inzerat){
    $zboziid = $inzerat["Zbozi_id"];
    $nazevzbozi = $inzerat["nazev"];
}
$deletevazbu = mysqli_query($conn,"DELETE FROM Uzivatel_vytvoril_inzerat WHERE `Uzivatel_vytvoril_inzerat`.`Uzivatel_id` = $uzivatelid AND Uzivatel_vytvoril_inzerat.Inzerat_id = $inzeratid");
$deleteinzerat = mysqli_query($conn,"DELETE FROM Inzerat WHERE id = $inzeratid");
$deletezbozi = mysqli_query($conn,"DELETE FROM Zbozi WHERE id = $zboziid");

$getnazevobrazku = mysqli_query($conn,"SELECT * FROM Obrazky WHERE nazev = '$nazevzbozi'");
foreach ($getnazevobrazku as $obrazek){
    $obrazeksrc = "../images/inzeraty/".$obrazek["src"];

    unlink($obrazeksrc);

    $deleteobrazek = mysqli_query($conn,"DELETE FROM Obrazky WHERE nazev = '$nazevzbozi'");
    $deletekonekci = mysqli_query($conn,"DELETE FROM Zbozi_ma_obrazky WHERE Zbozi_id = '$zboziid'");
}
//zbozi ma kategorii
$deletezbozimakategorii = mysqli_query($conn,"DELETE FROM Zbozi_ma_kategorii WHERE Zbozi_id = '$zboziid'");

header("Location: ../index.php?pages=myListings&id=$uzivatelid");

?>