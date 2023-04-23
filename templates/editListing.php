<?php
$id = $_GET["id"];
$uzivatel = UzivatelFactory::createUzivatel($_SESSION["id"],$conn);
$inzeraty = $uzivatel->getInzeraty();

$jmeno = $uzivatel->getJmeno();
$prijmeni = $uzivatel->getPrijmeni();
$email = $uzivatel->getEmail();


$nazev = $fotografie = $cena = $tel = $lokace = $dlouhypopis = $kratkypopis = $status = $kategorie = $zboziid = "";

foreach ($inzeraty as $inzerat) {
    $inzeratid= $inzerat->getId();
    if ($id === $inzerat->getId()) {
        $kratkypopis = $inzerat->getKratkyPopis();
        $dlouhypopis = $inzerat->getDlouhyPopis();
        $cena = $inzerat->getCena();
        $tel = $inzerat->getTel();
        $lokace = $inzerat->getLokace();
        $status = $inzerat->getStatus();
        foreach ($inzerat->getZbozi() as $zbozi){
            $nazev = $zbozi->getNazev();
            $zboziid =$zbozi->getId();
            //print_r($zbozi->getKategorie());
            foreach ($zbozi->getKategorie() as $kategorie){

            }
        }
    }
}

$error = "";

if (isset($_POST['submit'])) {
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

    $updatezbozi = "UPDATE `Zbozi` SET `nazev` = '$nazev' WHERE `Zbozi`.`id` = ?";
    $stmt = $conn->prepare($updatezbozi);
    $stmt->bind_param("i", $zboziid);
    $stmt->execute();

    $updateinzerat = "UPDATE `Inzerat` SET `kratkypopis` = '$kratkypopis',
                     `dlouhypopis` = '$dlouhypopis', `cena` = '$cena',
                     `tel` = '$tel', `lokace` = '$lokace',
                     `inzerat_status_id` = '$status' WHERE `Inzerat`.`id` = ? AND `Inzerat`.`Zbozi_id` = ?";
    $stmt = $conn->prepare($updateinzerat);
    $stmt->bind_param("ii", $inzeratid, $zboziid);
    $stmt->execute();

//aktualizuj zbozi_ma_kategorii
    $updatezbozimakategorii = "UPDATE `Zbozi_ma_kategorii` SET `Kategorie_id` = ? WHERE `Zbozi_ma_kategorii`.`Zbozi_id` = $zboziid";
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
                $target_dir = "images/inzeraty/";
                $target_file = $target_dir . basename($name);
                // Zkontrolujte, zda soubor již existuje
                if (file_exists($target_file)) {
                    $error = "Soubor $name již byl nahrán.<br>";
                    /*VELMI TESTOVACI USE CASE*/
                    //getidobrazku
                    $getidobrazku = "SELECT * FROM Obrazky WHERE src = '$name' LIMIT 1";
                    $result = $conn->query($getidobrazku);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $last_id = $row["id"];

                            //ošetři jestli vazba už neexistuje

                            $vytvorvazbu = "INSERT INTO `Zbozi_ma_obrazky` (`Zbozi_id`, `Obrazky_id`) VALUES ('$zboziid', '$last_id');";
                            if ($conn->query($vytvorvazbu) === TRUE) {
                                $error = "Vazba byla úspěšně vytvořena v databázi.<br>";
                            } else {
                                $error = "Chyba při tvoření vazby v databázi: " . $conn->error . "<br>";
                            }
                        }
                    }
                } else {
                    move_uploaded_file($tmp_name, $target_file);
                    $error = "Soubor $name byl úspěšně nahrán.<br>";

                    // Vložení záznamu do databáze
                    $vlozobrazekdodb = "INSERT INTO Obrazky (nazev, src, alt) VALUES ('$nazev','$name','$nazev')";
                    if ($conn->query($vlozobrazekdodb) === TRUE) {
                        $error = "Záznam byl úspěšně vložen do databáze.<br>";
                    } else {
                        $error = "Chyba při vkládání záznamu do databáze: " . $conn->error . "<br>";
                    }

                    //vytvoř vazbu mezi zbozi a obrazek
                    $last_id = $conn->insert_id;
                    $vytvorvazbu = "INSERT INTO `Zbozi_ma_obrazky` (`Zbozi_id`, `Obrazky_id`) VALUES ('$zboziid', '$last_id');";
                    if ($conn->query($vytvorvazbu) === TRUE) {
                        $error = "Vazba byla úspěšně vytvořena v databázi.<br>";
                    } else {
                        //$error = "Chyba při tvoření vazby v databázi: " . $conn->error . "<br>";
                        $error = "Vše proběhlo v pořádku.";
                    }

                }
            } else {
                // Pokud nastane chyba, vypište ji uživateli
                //$error = "Při nahrávání souboru došlo k chybě: " . $_FILES['images']['error'][$key] . "<br>";
                $error = "Žádný obrázek nebyl nahrán.";
            }
        }
    }
    echo $error;

}

?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Upravit Inzerát MacBook Pro 13</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <h1>Upravit inzerát <?= $nazev;?></h1>
    <form class="row" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="inzeratid" type="number" value="<?=$inzeratid;?>">
        <input type="hidden" name="zboziid" type="number" value="<?=$zboziid;?>">
        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" name="nazev" id="name" placeholder="Myš Razer" type="text" value="<?=$nazev;?>">
                <label for="name"><i class="bi bi-type"></i> Název</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photos">Fotografie</label>
                <input  class="form-control" type="file" name="images[]" multiple>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photos">Obrázky:</label>
                <!-- výpis obrázku -->
                <?php
                /*$getobrazky = "SELECT * FROM Zbozi_ma_obrazky JOIN Obrazky ON Obrazky.id = Zbozi_ma_obrazky.Obrazky_id WHERE Zbozi_id = '$zboziid'";
                $result = $conn->query($getobrazky);
                while($row = $result->fetch_assoc()) {
                    $image_id = $row['Obrazky_id'];
                    $name = $row['nazev'];
                    $path = "images/inzeraty/".$row['src'];

                    echo "<img src='$path' alt='$name' height='100'>";
                    ?>
                    <a href="scripts/deleteimage.php?id=<?=$image_id;?>&zboziid=<?=$zboziid;?>">X</a>
                <?php
                }*/
                ?>
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" name="kratkypopis" id="shortDesc" placeholder="Krátký popis..."
                              style="height: 75px"><?=$kratkypopis;?></textarea>
                <label for="shortDesc"><i class="bi bi-justify-left"></i> Krátký popis</label>
            </div>
            <div class="form-floating mb-3">
                <input type="hidden" name="jmeno" type="text" value="<?=$jmeno;?>">
                <input type="hidden" name="prijmeni" type="text" value="<?=$prijmeni;?>">
                <input class="form-control-plaintext" id="floatingPlaintextInput" placeholder="Jan Novák" readonly
                       type="email"  value="<?= $jmeno." ".$prijmeni; ?>">
                <label for="floatingPlaintextInput"><i class="bi bi-person-fill"></i> Jméno</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control-plaintext" name="email" id="email" placeholder="novak@mail.cz" readonly type="email"
                       value="<?=$email;?>">
                <label for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="cena" id="price" placeholder="600" type="number" value="<?=$cena;?>">
                <label for="price"><i class="bi bi-tag"></i> Cena</label>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" name="tel" id="phone" placeholder="+420 777 777 777" type="text"
                       value="<?=$tel;?>">
                <label for="phone"><i class="bi bi-telephone"></i> Telefon</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="lokace" id="address" placeholder="Praha 1" type="text" value="<?=$lokace;?>">
                <label for="address"><i class="bi bi-geo-alt"></i> Lokace</label>
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" name="dlouhypopis" id="longDesc" placeholder="Detailní popis"
                              style="height: 150px"><?=$dlouhypopis;?></textarea>
                <label for="longDesc"><i class="bi bi-body-text"></i> Detailní popis</label>
            </div>
            <div class="form-floating mb-3">
                <select aria-label="Floating label select example" name="status" class="form-select" id="status">
                    <option <?php if($status == 1){?> selected <?php } ?> value="1">Aktivní</option>
                    <option <?php if($status == 2){?> selected <?php } ?> value="2">Rezervované</option>
                    <option <?php if($status == 3){?> selected <?php } ?> value="3">Prodané</option>
                    <option <?php if($status == 4){?> selected <?php } ?> value="4">Skryté</option>
                </select>
                <label for="status"><i class="bi bi-flag"></i> Status</label>
            </div>
            <div class="form-floating mb-3">
                <select aria-label="Výběr kategorií inzerátu"  name="kategorie" class="form-select" id="kategorie" multiple
                        style="height: 150px">
                    <option value="1">Počítače</option>
                    <option value="2">Notebooky</option>
                    <option value="3">Procesory</option>
                    <option value="4">Grafické karty</option>
                    <option value="5">Příslušenství</option>
                </select>
                <label for="status"><i class="bi bi-bookmark-plus"></i> Kategorie</label>
            </div>
        </div>

        <div class="mb-3 text-end">
            <input class="btn btn-primary" type="submit" name="submit" class="btn btn-primary" value="Aktualizovat">
        </div>
    </form>
</div>