<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-2">
        <div class="col-lg-3 border-right mb-3">
            <div class="d-flex flex-column align-items-center text-center">
                <img alt="Profilový obrázek" class="rounded-circle"
                     src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                     width="150px">
                <span class="font-weight-bold">Jan Novák</span>
                <span class="text-black-50">novak@mail.cz</span>
            </div>
        </div>
        <div class="col-lg-9 border-right">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                <h1>Profil</h1>
                <div aria-label="Basic example" class="btn-group" role="group">
                    <a class="btn btn-outline-primary" href="myListings.php"><i class="bi bi-card-list"></i> Moje
                        inzeráty</a>
                    <a class="btn btn-outline-primary" href="myOrders.php"><i class="bi bi-cart4"></i> Koupené
                        zboží</a>
                </div>

                <a class="btn btn-success mt-2 mt-lg-0" href="addListing.php"><i class="bi bi-bookmark-plus"></i>
                    Přidat inzerát</a>
            </div>
            <div class="row mt-2">
                <div class="col-lg-6 mb-1">
                    <label for="name"><i class="bi bi-person"></i> Jméno</label>
                    <input class="form-control" id="name" placeholder="Jméno" type="text" value="Jan">
                </div>
                <div class="col-lg-6 mb-1">
                    <label for="surname"><i class="bi bi-person-fill"></i> Příjmení</label>
                    <input class="form-control" id="surname" placeholder="Příjmení" type="text" value="Novák">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <label class="labels" for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
                    <input class="form-control" id="email" placeholder="example@example.cz" type="text"
                           value="novak@mail.cz">
                </div>
            </div>
            <div class="text-end mt-2">
                <button class="btn btn-primary" type="button"><i class="bi bi-save"></i> Uložit profil</button>
            </div>
        </div>
    </div>
</div>