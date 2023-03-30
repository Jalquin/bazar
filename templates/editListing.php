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
    <form class="row" action="scripts/aktualizujinzerat.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="inzeratid" type="number" value="<?=$inzeratid;?>">
        <input type="hidden" name="zboziid" type="number" value="<?=$zboziid;?>">
        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" name="nazev" id="name" placeholder="Myš Razer" type="text" value="<?=$nazev;?>">
                <label for="name"><i class="bi bi-type"></i> Název</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photos">Fotografie</label>
                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
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
                <select aria-label="Výběr kategorií inzerátu" class="form-select" id="category" multiple
                        style="height: 150px">
                    <option value="0">Počítače</option>
                    <option selected value="1">Notebooky</option>
                    <option value="2">Procesory</option>
                    <option value="3">Grafické karty</option>
                    <option value="4">Příslušenství</option>
                </select>
                <label for="status"><i class="bi bi-bookmark-plus"></i> Kategorie</label>
            </div>
        </div>

        <div class="mb-3 text-end">
            <input class="btn btn-primary" type="submit" name="submit" class="btn btn-primary" value="Aktualizovat">
        </div>
    </form>
</div>