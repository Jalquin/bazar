<?php
$getkategorie = mysqli_query($conn,"SELECT * FROM kategorie");

?>

<div class="container">
    <h1>Kategorie</h1>
    <div class="row row-cols-auto justify-content-center text-center mb-2">
        <?php foreach($getkategorie as $kategorie):
            $takategorie = KategorieFactory::createKategorie($kategorie["id"],$conn); ?>

            <div class="col container-img-text">
                <a href="index.php?pages=listings&id=<?=$kategorie["id"];?>">
                    <img alt="<?= $takategorie->getNazev();?>"
                         class="img-fluid img-text-over m-3"
                         src="<?= "images/".$takategorie->getImage();?>">
                    <div class="text-over-img">
                        <h2><?= $takategorie->getNazev();?></h2>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>