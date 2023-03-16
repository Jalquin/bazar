<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];
$inzeratid = $_POST["inzeratid"];
$zboziid = $_POST["zboziid"];

$nazev 	= $_POST["nazev"];
$fotografie 	= $_POST["fotografie"];
$kratkypopis = $_POST["kratkypopis"];
$jmeno 	= $_POST["jmeno"];
$prijmeni 	= $_POST["prijmeni"];
$email 	= $_POST["email"];
$cena = $_POST["cena"];
$tel = $_POST["tel"];
$lokace = $_POST["lokace"];
$dlouhypopis = $_POST["dlouhypopis"];
$status = $_POST["status"];

//$kategorie = $_POST["kategorie"];

//určitě ošetřit délku názvu, min a max

//echo $inzeratid.$zboziid.$nazev.$fotografie.$kratkypopis.$jmeno.$prijmeni.$email.$cena.$tel.$lokace.$dlouhypopis.$status;



$updatezbozi = "UPDATE `zbozi` SET `nazev` = '$nazev' WHERE `zbozi`.`id` = ?";
$stmt = $conn->prepare($updatezbozi);
$stmt->bind_param("i", $zboziid);
$stmt->execute();

$updateinzerat = "UPDATE `inzerat` SET `kratkypopis` = '$kratkypopis',
                     `dlouhypopis` = '$dlouhypopis', `cena` = '$cena',
                     `tel` = '$tel', `lokace` = '$lokace',
                     `inzerat_status_id` = '$status' WHERE `inzerat`.`id` = ? AND `inzerat`.`Zbozi_id` = ?";
$stmt = $conn->prepare($updateinzerat);
$stmt->bind_param("ii", $inzeratid, $zboziid);
$stmt->execute();


header("Location: ../index.php?pages=editListing&id=$inzeratid");

?>