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
    <h1>Upravit inzerát MacBook Pro 13</h1>
    <form class="row">

        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" id="name" placeholder="Myš Razer" type="text" value="MacBook Pro 13">
                <label for="name"><i class="bi bi-type"></i> Název</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="photos">Fotografie</label>
                <input class="form-control" id="photos" multiple type="file">
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" id="shortDesc" placeholder="Krátký popis..."
                              style="height: 75px">MacBook Pro 13″ přináší kombinaci toho nejlepšího ze světa přenosných počítačů Apple – prvotřídní zpracování, fantastický Retina displej, dlouhou výdrž baterie a díky unikátním čipům Apple M1 také špičkový výkon.</textarea>
                <label for="shortDesc"><i class="bi bi-justify-left"></i> Krátký popis</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control-plaintext" id="floatingPlaintextInput" placeholder="Jan Novák" readonly
                       type="email" value="Jan Novák">
                <label for="floatingPlaintextInput"><i class="bi bi-person-fill"></i> Jméno</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control-plaintext" id="email" placeholder="novak@mail.cz" readonly type="email"
                       value="novak@mail.cz">
                <label for="email"><i class="bi bi-envelope-at"></i> E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="price" placeholder="600" type="number" value="600">
                <label for="price"><i class="bi bi-tag"></i> Cena</label>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-floating mb-3">
                <input class="form-control" id="phone" placeholder="+420 777 777 777" type="text"
                       value="+420 777 777 777">
                <label for="phone"><i class="bi bi-telephone"></i> Telefon</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="address" placeholder="Praha 1" type="text" value="Praha 1">
                <label for="address"><i class="bi bi-geo-alt"></i> Lokace</label>
            </div>
            <div class="form-floating mb-3">
                    <textarea class="form-control" id="longDesc" placeholder="Detailní popis"
                              style="height: 150px">Čip Apple M2 nově definuje 13palcový MacBook Pro M2. Má 8jádrové CPU, které s lehkostí zvládá i složité pracovní postupy při úpravách fotek, programování nebo střihu videa. Fantastické 10jádrové GPU, které utáhne graficky náročné úlohy a hrám dává naprostou plynulost. Vyspělý 16jádrový Neural Engine pro aplikace, které pracují se strojovým učením. Superrychlou jednotnou paměť, aby všechno běželo hladce. Tohle je nový MacBook Pro 13" M2.</textarea>
                <label for="longDesc"><i class="bi bi-body-text"></i> Detailní popis</label>
            </div>
            <div class="form-floating mb-3">
                <select aria-label="Floating label select example" class="form-select" id="status">
                    <option selected>Aktivní</option>
                    <option value="1">Prodáno</option>
                    <option value="2">Rezervované</option>
                    <option value="3">Skryté</option>
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
            <a class="btn btn-primary" href="myListings.php" type="submit"><i class="bi bi-arrow-clockwise"></i>
                Aktualizovat</a>
        </div>
    </form>
</div>