<?php
$id = $_SESSION["id"];
$uzivatel = UzivatelFactory::createUzivatel($id,$conn);

?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Přidat Inzerát</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <h1>Přidat inzerát</h1>
    <form class="row" action="scripts/addinzerat.php" method="POST" enctype="multipart/form-data">

        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" name="nazev" id="name" placeholder="Myš Razer" type="text">
                <label for="name"><i class="bi bi-type"></i> Název</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photos">Fotografie</label>
                <input  class="form-control" type="file" name="images[]" multiple>
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" name="kratkypopis" id="shortDesc" placeholder="Krátký popis..."
                              style="height: 75px"></textarea>
                <label for="shortDesc"><i class="bi bi-justify-left"></i> Krátký popis</label>
            </div>
            <div class="form-floating mb-3">
                <input type="hidden" name="jmeno" type="text" value="<?=$uzivatel->getJmeno();?>">
                <input type="hidden" name="prijmeni" type="text" value="<?=$uzivatel->getPrijmeni();?>">
                <input class="form-control-plaintext"  id="floatingPlaintextInput" placeholder="<?= $uzivatel->getJmeno()." ".$uzivatel->getPrijmeni(); ?>" readonly
                       type="email" value="<?= $uzivatel->getJmeno()." ".$uzivatel->getPrijmeni(); ?>">
                <label for="floatingPlaintextInput"><i class="bi bi-person-fill"></i> Jméno</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control-plaintext" name="email" id="email" placeholder="novak@mail.cz" readonly type="email"
                       value="<?=$uzivatel->getEmail();?>">
                <label for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="cena" id="price" placeholder="600" type="number">
                <label for="price"><i class="bi bi-tag"></i> Cena</label>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" name="tel" id="phone" placeholder="+420 777 777 777" type="text">
                <label for="phone"><i class="bi bi-telephone"></i> Telefon</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="lokace" id="address" placeholder="Praha 1" type="text">
                <label for="address"><i class="bi bi-geo-alt"></i> Lokace</label>
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" name="dlouhypopis" id="longDesc" placeholder="Detailní popis"
                              style="height: 150px"></textarea>
                <label for="longDesc"><i class="bi bi-body-text"></i> Detailní popis</label>
            </div>
            <div class="form-floating mb-3">
                <select name="status" aria-label="Výběr statusu inzerátu" class="form-select" id="status">
                    <option value="1" selected>Aktivní</option>
                    <option value="2">Prodáno</option>
                    <option value="3">Rezervované</option>
                    <option value="4">Skryté</option>
                </select>
                <label for="status"><i class="bi bi-flag"></i> Status</label>
            </div>
            <div class="form-floating mb-3">
                <select aria-label="Výběr kategorií inzerátu" name="kategorie" class="form-select" id="category" multiple
                        style="height: 150px">
                    <option value="1">Počítače</option>
                    <option value="2">Notebooky</option>
                    <option value="3">Procesory</option>
                    <option value="4">Grafické karty</option>
                    <option value="5">Příslušenství</option>
                </select>
                <label for="status"><i class="bi bi-bookmark-plus"></i> Kategorie</label>
            </div>
            <div class="mb-3 form-check">
                <input class="form-check-input" id="exampleCheck1" type="checkbox">
                <label class="form-check-label" for="exampleCheck1">Souhlasím s
                    <ins><a href="terms.php" target="_blank">obchodními podmínkami.</a></ins>
                </label>
            </div>
        </div>

        <div class="mb-3 text-end">
            <input type="submit" name="submit" class="btn btn-primary" value="Publikovat">
        </div>
    </form>
</div>