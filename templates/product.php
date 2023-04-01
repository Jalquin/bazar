<?php

$idprodukut = $_GET["id"];
$inzerat = InzeratFactory::createInzerat($idprodukut,$conn);

$nazev = $fotografie = $cena = $tel = $lokace = $dlouhypopis = $kratkypopis = $status = $kategorie = $zboziid = "";
$cena = $inzerat->getCena();
$tel = $inzerat->getTel();
$lokace = $inzerat->getLokace();
$dlouhypopis = $inzerat->getDlouhyPopis();
$kratkypopis = $inzerat->getKratkyPopis();
$status = $inzerat->getStatus();

foreach ($inzerat->getZbozi() as $zbozi){
    $nazev = $zbozi->getNazev();
    $zboziid = $zbozi->getId();

    foreach ($zbozi->getKategorie() as $kategorie){
        $kategorie = $kategorie->getNazev();
    }
}

//kdo je inzerant?
$kdojeinzerant = "SELECT * FROM uzivatel_vytvoril_inzerat WHERE Inzerat_id = ?";
$stmt = $conn->prepare($kdojeinzerant);
$stmt->bind_param("i", $idprodukut);
$stmt->execute();
$result = $stmt->get_result();
$inzerant = $result->fetch_assoc();

$inzerantid = $inzerant["Uzivatel_id"];
$inzerant = UzivatelFactory::createUzivatel($inzerantid,$conn);
$jmenoinzeranta = $inzerant->getJmeno()." ".$inzerant->getPrijmeni();
$email = $inzerant->getEmail();


?>
<link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="listings.php">Inzeráty</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Inzerát 1</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php
$selectfirstpicture = mysqli_query($conn,"SELECT * FROM zbozi_ma_obrazky JOIN
            obrazky ON obrazky.id = zbozi_ma_obrazky.Obrazky_id WHERE zbozi_ma_obrazky.Zbozi_id = $zboziid LIMIT 1");
$zboziprvniobrazek = "images/default.jpg";
foreach ($selectfirstpicture as $zbozifirstpicture){
    $zboziprvniobrazek = "images/inzeraty/".$zbozifirstpicture["src"];
}

?>

<div class="container">
    <div class="row mb-1">
        <div class="col-lg-4">
            <div class="row">
                <img alt="placeholder"
                     class="img-fluid"
                     src="<?=$zboziprvniobrazek;?>">
            </div>
            <div class="row">
                <div class="multiple-items">
                <?php
                $selectallpictures = mysqli_query($conn,"SELECT * FROM zbozi_ma_obrazky JOIN
            obrazky ON obrazky.id = zbozi_ma_obrazky.Obrazky_id WHERE zbozi_ma_obrazky.Zbozi_id = $zboziid");
                $zboziobrazek = "images/default.jpg";

                $skipinteger = 0;
                foreach($selectallpictures as $zbozipicture){
                    $skipinteger++;
                    if($skipinteger === 1){} else{
                        $zboziobrazek = "images/inzeraty/" . $zbozipicture["src"];
                    ?>
                    <img alt="placeholder"
                         class="img-fluid"
                         src="<?=$zboziobrazek;?>">
                <?php } } ?>
                </div>
            </div>
        </div>
        <div class="col-lg-8 bg-light bg-gradient rounded">
            <div class="row">
                <div class="col">
                    <h1 class="card-title"><?= $nazev;?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><?= $kratkypopis; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            <a href="profile.php"><p><i class="bi bi-person-fill"></i> <?= $jmenoinzeranta;?></p></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="tel:+420777777777"><p><i class="bi bi-telephone"></i> <?= $tel; ?></p></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><i class="bi bi-geo-alt"></i> <?= $lokace;?> </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-end">
                    <div class="row">
                        <div class="col">
                            <h2><?= $cena.",- Kč";?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary" href="mailto:<?= $email;?>"><i
                                    class="bi bi-envelope-at-fill"></i> Kontaktovat E-mailem</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col border">
                    <div class="mb-1">
                        <label class="form-label" for="message">Poslat zprávu</label>
                        <textarea class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <div class="text-end mb-1">
                        <a class="btn btn-secondary"><i class="bi bi-send"></i> Odeslat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h3>Detailní popis</h3>
            <p><?=$dlouhypopis;?></p>
        </div>
    </div>
</div>

<!-- extra scripty pro slick -->
<script src="//code.jquery.com/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.multiple-items').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500
        });
    });
</script>
