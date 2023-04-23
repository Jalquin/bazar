<?php
$getkategorie = mysqli_query($conn,"SELECT * FROM Kategorie LIMIT 3");
$getinzeraty = mysqli_query($conn,"SELECT * FROM Inzerat JOIN Zbozi ON Inzerat.Id = Zbozi.Id WHERE Inzerat.Inzerat_status_id = 1 LIMIT 6");
?>

<main class="container">
    <h1 class="text-center">Bazarooooš</h1>
    <div class="row my-2">
        <div class="col">
            <div class="carousel slide" data-bs-ride="true" id="carouselExampleIndicators">
                <div class="carousel-indicators">
                    <button aria-current="true" aria-label="Slide 1" class="active"
                            data-bs-slide-to="0" data-bs-target="#carouselExampleIndicators" type="button"></button>
                    <button aria-label="Slide 2" data-bs-slide-to="1" data-bs-target="#carouselExampleIndicators"
                            type="button"></button>
                    <button aria-label="Slide 3" data-bs-slide-to="2" data-bs-target="#carouselExampleIndicators"
                            type="button"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img alt="Banner Redragon"
                             class="d-block w-100"
                             src="https://dobleclicknet.com/wp-content/uploads/2019/07/banner_redragon.jpg">
                    </div>
                    <div class="carousel-item">
                        <img alt="Macbook"
                             class="d-block w-100"
                             src="https://img.freepik.com/vector-premium/nueva-macbook-air-maqueta-pro-interfaz-usuario-ui-ux-blanca-zaporizhzhia-ucrania-18-octubre-2021_399089-3240.jpg?w=2000">
                    </div>
                    <div class="carousel-item">
                        <img alt="Klávesnice"
                             class="d-block w-100"
                             src="https://www.fudzilla.com/images/stories/2017/August/cm-ms120-2.jpg">
                    </div>
                </div>
                <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleIndicators"
                        type="button">
                    <span aria-hidden="true" class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleIndicators"
                        type="button">
                    <span aria-hidden="true" class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row justify-content-center text-center mb-2">
        <?php /*foreach($getkategorie as $kategorie):
            $takategorie = KategorieFactory::createKategorie($kategorie["id"],$conn);
        $idkategorie = $takategorie->getId();
        $srckategorie = "images/".$takategorie->getImage();
        $nazevkategorie = $takategorie->getNazev();
        ?>
            <div class="col-6 col-lg-4 container-img-text">
                <a href="index.php?pages=listings&id=<?= $idkategorie;?>">
                    <img alt="<?=  $nazevkategorie;?>" class="img-fluid img-text-over"
                         src="<?=  $srckategorie;?>">
                    <div class="text-over-img">
                        <h2><?= $nazevkategorie;?></h2>
                    </div>
                </a>
            </div>
        <?php endforeach;*/ ?>
    </div>

    <div class="row mb-2">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Nejžhavější nabídky</h2>
                </div>
                <div class="card-body">

                    <div class="row row-cols-1 row-cols-md-3 g-4">

                        <?php foreach ($getinzeraty as $inzerat):
                        $inzerat = InzeratFactory::createInzerat($inzerat["id"], $conn);

                        foreach ($inzerat->getZbozi() as $zbozi):
                        $zboziid = $zbozi->getId();
                            $selectallpictures = mysqli_query($conn,"SELECT * FROM Zbozi_ma_obrazky JOIN
    Obrazky ON Obrazky.id = Zbozi_ma_obrazky.Obrazky_id WHERE Zbozi_ma_obrazky.Zbozi_id = $zboziid LIMIT 1");
                            $zboziobrazek = "images/default.jpg";
                            foreach ($selectallpictures as $zbozipicture){
                                $zboziobrazek = "images/inzeraty/".$zbozipicture["src"];
                            }
                        ?>

                            <div class="col">
                                <a class="text-decoration-none text-body" href="index.php?pages=product&id=<?=$inzerat->getId();?>">
                                    <div class="card h-100">
                                        <img alt="" class="card-img-top"
                                             src="<?=$zboziobrazek;?>">
                                        <div class="card-body">
                                            <h3 class="card-title"><?=$zbozi->getNazev();?></h3>
                                            <p class="card-text"><?=$inzerat->getKratkyPopis();?></p>
                                            <h4><?=$inzerat->getCena();?>,- Kč</h4>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted"><?= $inzerat->getDatumVytvoreni();?></small>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php endforeach;endforeach; ?>

                    </div>

                    <a class="mt-3 btn btn-secondary btn-lg" href="index.php?pages=listings"><i class="bi bi-list-ul"></i> Zobrazit
                        více inzerátů</a>

                </div>
            </div>
        </div>
    </div>

</main>