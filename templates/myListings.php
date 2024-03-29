<?php
$id = $_GET["id"];
$uzivatel = UzivatelFactory::createUzivatel($id,$conn);
$inzeraty = $uzivatel->getInzeraty();
?>
<!-- extra CSS pro datatables - nutné někam implementovat do headu -->
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet"
          type="text/css">

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
                    <li aria-current="page" class="breadcrumb-item active">Moje Inzeráty</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <h1>Moje Inzeráty</h1>
    <a class="btn btn-success my-2" href="index.php?pages=addListing"><i class="bi bi-bookmark-plus"></i>
        Přidat inzerát</a>
    <table class="table table-striped" id="example" style="width:100%">
        <thead>
        <tr>
            <th></th>
            <th>Název</th>
            <th>Datum</th>
            <th>Stav</th>
            <th>Akce</th>
        </tr>
        </thead>
        <tbody>

            <?php
            //za každý inzerát
            foreach ($inzeraty as $inzerat){
                //za každé zboží v inzerátu
                foreach ($inzerat->getZbozi() as $zbozivinzeratu){
            ?>
            <tr>
            <td></td>
            <td><?= $zbozivinzeratu->getNazev();?></td>
            <td><?= $inzerat->getDatumVytvoreni();?></td>
            <td><?= $inzerat->getStatus();?></td>
            <td>
                <div aria-label="Akce inzerátu <<name>>" class="btn-group mb-2 mb-lg-0" role="group">
                    <a class="btn btn-warning" href="index.php?pages=editListing&id=<?= $inzerat->getId(); ?>" ><i class="bi bi-pencil-square"></i> Upravit
                        inzerát
                    </a>

                    <div class="btn-group" role="group">
                        <button aria-expanded="false" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                type="button">
                            <i class="bi bi-flag"></i> Změnit stav
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Aktivní</a></li>
                            <li><a class="dropdown-item" href="#">Prodáno</a></li>
                            <li><a class="dropdown-item" href="#">Rezervované</a></li>
                            <li><a class="dropdown-item" href="#">Skryté</a></li>
                        </ul>
                    </div>
                </div>
                <a href="scripts/deleteinzerat.php?id=<?= $inzerat->getId(); ?>"  class="btn btn-danger" data-bs-target="#exampleModal" data-bs-toggle="modal"
                        data-bs-whatever="Inzerát 1"
                        type="button"><i class="bi bi-trash3"></i> Odstranit inzerát
                </a>
            </td>
            </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Ne</button>
                <a class="btn btn-danger" href="scripts/deleteinzerat.php?id=<?= $inzerat->getId(); ?>" type="button">Ano</a>
            </div>
        </div>
    </div>
</div>

<!-- extra scripty pro datatables -->
<script
        crossorigin="anonymous"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"
        type="text/javascript"></script>
<script charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"
        type="text/javascript"></script>
<script charset="utf8" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"
        type="text/javascript"></script>

<script>
    const exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const recipient = button.getAttribute('data-bs-whatever')
        const modalTitle = exampleModal.querySelector('.modal-title')
        modalTitle.textContent = `Opravdu chcete odstranit ${recipient}?`
    })

    $(document).ready(function () {
        $('#example').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/cs.json'
            },
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [{
                className: 'control',
                orderable: false,
                targets: 0
            }],
            order: [1, 'asc']
        });
    });
</script>