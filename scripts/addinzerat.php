<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];

$nazev 	= $_POST["nazev"];
$kratkypopis = $_POST["kratkypopis"];
$jmeno 	= $_POST["jmeno"];
$prijmeni 	= $_POST["prijmeni"];
$email 	= $_POST["email"];
$cena = $_POST["cena"];
$tel = $_POST["tel"];
$lokace = $_POST["lokace"];
$dlouhypopis = $_POST["dlouhypopis"];
$status = $_POST["status"];

$error = "";

$kategorie = $_POST["kategorie"] ?? 1;

//určitě ošetřit délku názvu, min a max

//echo $nazev.$fotografie.$kratkypopis.$jmeno.$prijmeni.$email.$cena.$tel.$lokace.$dlouhypopis.$status;


//nejdříve potřebuju vytvořit zboží
$vytvorzbozi = "INSERT INTO Zbozi (nazev) VALUES (?)";
$stmt = $conn->prepare($vytvorzbozi);
$stmt->bind_param("s", $nazev);
$stmt->execute();
$zboziid=$stmt->insert_id;


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

//vytvoř zboží má kategorii
$zbozimakategorii = mysqli_query($conn,"INSERT INTO `zbozi_ma_kategorii` (`Zbozi_id`, `Kategorie_id`) VALUES ($zboziid, $kategorie)");


if (isset($_FILES['images'])) {
    // Nahrávání každého souboru
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        // Zkontroluje, zda byl nahrán soubor bez chyb
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            // Získejte název souboru a přesuňte ho do požadované složky
            $name = $_FILES['images']['name'][$key];
            $target_dir = "../images/inzeraty/";
            $target_file = $target_dir . basename($name);
            // Zkontrolujte, zda soubor již existuje
            if (file_exists($target_file)) {
                echo "Soubor $name již byl nahrán.<br>";
            } else {
                move_uploaded_file($tmp_name, $target_file);
                echo "Soubor $name byl úspěšně nahrán.<br>";

                // Vložení záznamu do databáze
                $vlozobrazekdodb = "INSERT INTO obrazky (nazev, src, alt) VALUES ('$nazev','$name','$nazev')";
                if ($conn->query($vlozobrazekdodb) === TRUE) {
                    echo "Záznam byl úspěšně vložen do databáze.<br>";
                } else {
                    echo "Chyba při vkládání záznamu do databáze: " . $conn->error . "<br>";
                }

                //vytvoř vazbu mezi zbozi a obrazek
                $last_id = $conn->insert_id;
                $vytvorvazbu = "INSERT INTO `zbozi_ma_obrazky` (`Zbozi_id`, `Obrazky_id`) VALUES ('$zboziid', '$last_id');";
                if ($conn->query($vytvorvazbu) === TRUE) {
                    echo "Vazba byla úspěšně vytvořena v databázi.<br>";
                } else {
                    echo "Chyba při tvoření vazby v databázi: " . $conn->error . "<br>";
                }

            }
        } else {
            // Pokud nastane chyba, vypište ji uživateli
            echo "Při nahrávání souboru došlo k chybě: " . $_FILES['images']['error'][$key] . "<br>";
        }
    }
}

//header("Location: ../index.php?pages=myListings&id=$uzivatelid");

?>