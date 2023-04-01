<?php
require("../connect.php");
@session_start();

$uzivatelid = $_SESSION["id"];
$inzeratid = $_POST["inzeratid"];
$zboziid = $_POST["zboziid"];

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
$kategorie = $_POST["kategorie"] ?? 1;

//určitě ošetřit délku názvu, min a max

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

//aktualizuj zbozi_ma_kategorii
echo $kategorie;
$updatezbozimakategorii = "UPDATE `zbozi_ma_kategorii` SET `Kategorie_id` = ? WHERE `zbozi_ma_kategorii`.`Zbozi_id` = $zboziid";
$stmt = $conn->prepare($updatezbozimakategorii);
$stmt->bind_param("i", $kategorie);
$stmt->execute();

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


//header("Location: ../index.php?pages=editListing&id=$inzeratid");

?>