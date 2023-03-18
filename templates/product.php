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

<div class="container">
    <div class="row mb-1">
        <div class="col-lg-4">
            <div class="row">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.lifewire.com/thmb/hFi8NtoAap7q62oWhaEDnbwnx3Y=/1000x1000/filters:no_upscale():max_bytes(150000):strip_icc()/Gygabyte_GEFORCE_RTX_HeroHoriz-db8d12900c4449e9b8aab6999b42372c.jpg">
            </div>
            <div class="row">
                <div class="multiple-items">
                    <img alt="placeholder"
                         class="img-fluid"
                         src="https://interlink-static1.tsbohemia.cz/gigabyte-geforce-rtx-3090-eagle-oc-24g_ig366077.jpg">
                    <img alt="placeholder"
                         class="img-fluid"
                         src="https://im9.cz/iR/importprodukt-orig/3b1/3b1386b24652ccd48762e4adf9d6cfb4--mmf250x250.jpg">
                    <img alt="placeholder" class="img-fluid"
                         src="https://m.media-amazon.com/images/I/41VX05Qy69L._AC_SS250_.jpg">
                    <img alt="placeholder"
                         class="img-fluid"
                         src="https://www.lifewire.com/thmb/mN0eLvY1QswgcrakEY1N_CBmwWI=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Gygabyte_GEFORCE_RTX_03-efdbffee4fd8432e9bec6bbbb704b7b0.jpg">
                    <img alt="placeholder"
                         class="img-fluid"
                         src="https://www.lifewire.com/thmb/bMdBzp-Kus7KF3L051dSrV5EdbQ=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Gygabyte_GEFORCE_RTX_04-c215a663f64e420293eec8c248103a70.jpg">
                    <img alt="placeholder"
                         class="img-fluid"
                         src="https://www.lifewire.com/thmb/2GF1PqpqRXgPInQ9FFbQQT9WyDA=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Gygabyte_GEFORCE_RTX_05-9982bf92d93746189e3b4fe68526bea0.jpg">
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
