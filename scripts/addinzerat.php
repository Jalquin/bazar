<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];

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

//echo $nazev.$fotografie.$kratkypopis.$jmeno.$prijmeni.$email.$cena.$tel.$lokace.$dlouhypopis.$status;

//nejdříve potřebuju vytvořit zboží
$vytvorzbozi = "INSERT INTO Zbozi (nazev) VALUES (?)";
$stmt = $conn->prepare($vytvorzbozi);
$stmt->bind_param("s", $nazev);
$stmt->execute();
$zboziid=$stmt->insert_id;

echo $zboziid;

//přidej inzerát
$pridejinzerat = "INSERT INTO inzerat (kratkypopis,dlouhypopis,cena,tel,lokace,inzerat_status_id,zbozi_id) VALUES (?,?,?,?,?,$status,$zboziid)";
$stmt = $conn->prepare($pridejinzerat);
$stmt->bind_param("ssiis", $kratkypopis, $dlouhypopis, $cena, $tel, $lokace);
$stmt->execute();
$id=$stmt->insert_id;

//přidej vazbu mezi uživatelem a inzerátem
$dnesnidatum = date("Y-m-d");

$pridejvazbu = "INSERT INTO uzivatel_vytvoril_inzerat (Uzivatel_id, inzerat_id, datum_zalozeni) VALUES (?,?,'$dnesnidatum')";
$stmt = $conn->prepare($pridejvazbu);
$stmt->bind_param("ss", $uzivatelid, $id);
$stmt->execute();

header("Location: ../index.php?pages=myListings&id=$uzivatelid");

?>