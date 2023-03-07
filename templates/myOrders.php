
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
                    <li aria-current="page" class="breadcrumb-item active">Koupené zboží</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <h1>Koupené zboží</h1>
    <table class="table table-striped" id="example" style="width:100%">
        <thead>
        <tr>
            <th></th>
            <th>Název</th>
            <th>Datum</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td>Myš Razer</td>
            <td>12.12.2022</td>
            <td>
                <button class="btn btn-secondary" type="button"><i class="bi bi-info-circle"></i> Detail inzerátu
                </button>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Myš Razer</td>
            <td>12.12.2022</td>
            <td>
                <button class="btn btn-secondary" type="button"><i class="bi bi-info-circle"></i> Detail inzerátu
                </button>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Myš Razer</td>
            <td>12.12.2022</td>
            <td>
                <button class="btn btn-secondary" type="button"><i class="bi bi-info-circle"></i> Detail inzerátu
                </button>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>Myš Razer</td>
            <td>12.12.2022</td>
            <td>
                <button class="btn btn-secondary" type="button"><i class="bi bi-info-circle"></i> Detail inzerátu
                </button>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <th>Název</th>
            <th>Datum</th>
            <th>Detail</th>
        </tr>
        </tfoot>
    </table>
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