<nav aria-label="Navigation" class="navbar navbar-expand-lg bg-light pt-0">
    <div class="container border-bottom">
        <div class="container-fluid p-0 justify-content-between align-items-center d-flex">
            <a class="navbar-brand p-0 m-0" href="index.php?pages=main">
                <img alt="Logo Bazarooooš" class="logo" src="images/logo.png">
            </a>
            <button aria-controls="Navigation" class="navbar-toggler" data-bs-target="#Navigation"
                    data-bs-toggle="offcanvas"
                    id="menu"
                    type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" id="Navigation"
                 tabindex="-1">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Bazarooooš</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="offcanvas" type="button"><span
                            class="d-none d-lg-inline">Menu</span></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-around flex-grow-1">
                        <li class="nav-item">
                            <a aria-current="page" class="nav-link" href="index.php?pages=main"><i class="bi bi-house"></i>
                                Home</a>
                        </li>
                        <li class="btn-group d-table d-lg-flex nav-item dropdown">
                            <a class="nav-link d-inline" href="index.php?pages=listings"><i class="bi bi-pc-display"></i> Inzeráty</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?pages=categories"><i class="bi bi-bookmark"></i>
                                    Kategorie</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="index.php?pages=product1">Inzerát 1</a></li>
                                <li><a class="dropdown-item" href="index.php?pages=product2">Inzerát 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pages=faq"><i class="bi bi-patch-question"></i> FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0 pb-1 mt-1 mt-lg-0 d-flex justify-content-between justify-content-lg-end">

            <div class="btn-group me-3">
                <?php
                if(isset($_SESSION["jmeno"])){
                    ?>
                <a aria-label="Login" class="btn btn-outline-danger" href="index.php?pages=profile&id=<?=$_SESSION["id"];?>">
                    <i class="bi bi-person"></i><span class="d-none d-lg-inline"> Profil</span>
                </a>
                <?php
                } else{
                ?>
                    <a aria-label="Login" class="btn btn-outline-danger" href="index.php?pages=login">
                        <i class="bi bi-person"></i><span class="d-none d-lg-inline"> Přihlásit</span>
                    </a>
                <?php
                }
                ?>

                <button aria-expanded="false" class="btn btn-outline-danger dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" type="button">
                    <span class="visually-hidden">Otevřít profilové menu</span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="index.php?pages=myListings"><i class="bi bi-card-list"></i> Moje
                            inzeráty</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="index.php?pages=myOrders"><i class="bi bi-cart4"></i> Koupené zboží</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="index.php?pages=addListing"><i class="bi bi-bookmark-plus"></i> Přidat
                            inzerát</a>
                    </li>
                    <?php
                    if(isset($_SESSION["jmeno"])){
                        ?>
                        <li>
                            <a class="dropdown-item" href="scripts/logout.php"> Logout </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <form class="d-flex" role="search">
                <input aria-label="Search" class="form-control me-2" placeholder="Vyhledej inzeráty..." type="search">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i><span
                        class="d-none"> Vyhledat</span></button>
            </form>
        </div>
    </div>
</nav>

