<?php
$idkategorie = $_GET["id"] ?? 1;

$getallkategorie = mysqli_query($conn,"SELECT * FROM kategorie");
$getinzeratykategorie = "SELECT * FROM Kategorie JOIN Zbozi_ma_kategorii ON kategorie.id = Zbozi_ma_kategorii.kategorie_id 
    JOIN Zbozi ON Zbozi_ma_kategorii.zbozi_id = Zbozi.id 
    JOIN Inzerat ON Zbozi.id = Inzerat.id 
    JOIN uzivatel_vytvoril_inzerat ON uzivatel_vytvoril_inzerat.Inzerat_id = inzerat.id 
    JOIN uzivatel ON uzivatel.id = uzivatel_vytvoril_inzerat.Uzivatel_id WHERE Zbozi_ma_kategorii.Kategorie_id = ? AND inzerat.inzerat_status_id = 1";
$stmt = $conn->prepare($getinzeratykategorie);
$stmt->bind_param("i", $idkategorie);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Inzeráty</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <h1>Inzeráty</h1>
    <div class="row mb-2">
        <div class="col">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills nav-justified">
                        <?php foreach($getallkategorie as $allkategorie): ?>
                            <li class="nav-item">
                                <a aria-current="true" class="nav-link <?php if($allkategorie["id"] === $idkategorie){ echo "active";}?>" href="index.php?pages=listings&id=<?= $allkategorie["id"];?>"><?= $allkategorie["nazev"];?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="mt-2 nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="bi bi-arrow-down-up"></i> Cena</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a aria-expanded="false" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                               role="button">Lokalita</a>
                            <div class="dropdown-menu p-2 location-search">
                                <form class="d-flex">
                                    <input aria-label="Location search" class="form-control me-2" id="addressSearch"
                                           placeholder="Vyhledej lokalitu..." type="search">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <?php

                        for ($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--) {
                            $result->data_seek($row_no);
                            $row = $result->fetch_assoc();

                            $zboziid = $row["Zbozi_id"];
                            $selectallpictures = mysqli_query($conn,"SELECT * FROM zbozi_ma_obrazky JOIN
    obrazky ON obrazky.id = zbozi_ma_obrazky.Obrazky_id WHERE zbozi_ma_obrazky.Zbozi_id = $zboziid LIMIT 1");
                            $zboziobrazek = "images/default.jpg";
                            foreach ($selectallpictures as $zbozipicture){
                                $zboziobrazek = "images/inzeraty/".$zbozipicture["src"];
                            }

                            ?>
                            <div class="col">

                                <div class="card h-100">
                                    <img alt="<?= $row["nazev"];?>" class="card-img-top"
                                         src="<?=$zboziobrazek;?>">
                                    <div class="card-body">
                                        <h3 class="card-title"><?=$row["nazev"];?></h3>
                                        <p class="card-text"><?=$row["kratkypopis"];?></p>
                                        <div class="row align-items-center">
                                            <div class="col"><i class="bi bi-geo-alt"></i><?=$row["lokace"];?></div>
                                            <div class="col"><a href="index.php?pages=profile&id=<?=$row["Uzivatel_id"];?>"><i class="bi bi-person-fill"></i><?=$row["jmeno"]." ".$row["prijmeni"];?></a>
                                            </div>
                                        </div>
                                        <h4><?=$row["cena"];?></h4>
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <a class="btn btn-success" href="#"><i class="bi bi-envelope-at-fill"></i>
                                                    Koupit</a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-primary my-2" href="index.php?pages=product&id=<?=$row["Zbozi_id"];?>"><i
                                                            class="bi bi-body-text"></i> Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Přidáno před 1 dnem</small>
                                    </div>
                                </div>

                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>