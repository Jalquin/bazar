
<link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css"/>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="listings.php">Inzeráty</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Inzerát 2</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>MacBook Pro 13</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-lg-4">
            <img alt="placeholder" class="img-fluid" src="https://doc.smarty.cz/pic/AYI0000301-1000-1000.jpg">
        </div>
        <div class="col-6 col-lg-8">
            <div class="multiple-items">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.jaknovy.cz/12756-home_default/macbook-pro-133-retina-i5-23ghz8gb128gb-ssd-2017-grayrepas-trida-a-zaruka-12m.jpg">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.jaknovy.cz/11372-home_default/macbook-pro-133-retina-i5-23ghz8gb250gb-ssd-2017-grayrepas-trida-a-zaruka-12m.jpg">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.jaknovy.cz/12759-home_default/macbook-pro-133-retina-i5-23ghz8gb128gb-ssd-2017-grayrepas-trida-a-zaruka-12m.jpg">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.jaknovy.cz/12758-home_default/macbook-pro-133-retina-i5-23ghz8gb128gb-ssd-2017-grayrepas-trida-a-zaruka-12m.jpg">
                <img alt="placeholder" class="img-fluid"
                     src="https://www.4gsm.com/data/gfx/pictures/medium/8/7/73078_1.jpg">
                <img alt="placeholder"
                     class="img-fluid"
                     src="https://www.jaknovy.cz/11372-home_default/macbook-pro-133-retina-i5-23ghz8gb250gb-ssd-2017-grayrepas-trida-a-zaruka-12m.jpg">
                <img alt="placeholder" class="img-fluid"
                     src="https://www.4gsm.com/data/gfx/pictures/medium/8/7/102478_1.jpg">
            </div>
        </div>
    </div>
    <div class="row pt-2 mb-2 bg-light bg-gradient rounded">
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col">
                    <p>MacBook Pro 13″ přináší kombinaci toho nejlepšího ze světa přenosných počítačů Apple – prvotřídní
                        zpracování, fantastický Retina displej, dlouhou výdrž baterie a díky unikátním čipům Apple M1
                        také špičkový výkon.</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="profile.php"><p><i class="bi bi-person-fill"></i> Jan Novák</p></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="tel:+420777777777"><p><i class="bi bi-telephone"></i> +420 777 777 777</p></a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p><i class="bi bi-geo-alt"></i> Praha 1</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>33 990,- Kč</h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 text-end">
            <div class="row mb-2">
                <div class="col">
                    <a class="btn btn-primary" href="mailto:mail@mail.com"><i class="bi bi-envelope-at-fill"></i>
                        Kontaktovat E-mailem</a>
                </div>
            </div>
            <div class="row">
                <div class="col border">
                    <div class="mb-3 text-start">
                        <label class="form-label" for="message">Poslat zprávu</label>
                        <textarea class="form-control" id="message" rows="3"></textarea>
                    </div>
                    <div class="mb-3 text-end">
                        <a class="btn btn-secondary"><i class="bi bi-send"></i> Odeslat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Detailní popis</h3>
            <p>Čip Apple M2 nově definuje 13palcový MacBook Pro M2. Má 8jádrové CPU, které s lehkostí zvládá i složité
                pracovní postupy při úpravách fotek, programování nebo střihu videa. Fantastické 10jádrové GPU, které
                utáhne graficky náročné úlohy a hrám dává naprostou plynulost. Vyspělý 16jádrový Neural Engine pro
                aplikace, které pracují se strojovým učením. Superrychlou jednotnou paměť, aby všechno běželo hladce.
                Tohle je nový MacBook Pro 13" M2.</p>
        </div>
    </div>
</div>

<!-- extra scripty pro datatables -->
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
            autoplaySpeed: 2500,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    });
</script>