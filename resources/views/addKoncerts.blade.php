<!--
Šis HTML dokuments nodrošina formu koncerta pievienošanai baletskolas sistēmā. 
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var ievadīt koncerta nosaukumu, datumu, vietu, saiti un ilgumu. 
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienot Koncertu</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/koncerti">Koncerti</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/addTerpi">Tērpi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Lietotāji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addGrupas">Grupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addNumurs">Numuri</a>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light navbar-lighter">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" style="color:#3a88fe;" href="/addKoncerts">Pievienot koncertu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/koncerti">Koncertu saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Forma koncerta pievienošanai-->
    <div class="container mt-5">
        <form action="/dataInsertKoncerts" method="POST">
            @csrf
            <div class="form-group">
                <label for="Nosaukums">Nosaukums:</label>
                <input type="text" class="form-control" id="Nosaukums" name="Nosaukums" placeholder="piem. Ziedu dārzi" required>
            </div>
            <div class="form-group">
                <label for="Datums">Datums:</label>
                <input type="date" class="form-control" id="Datums" name="Datums" required>
            </div>
            <div class="form-group">
                <label for="Vieta">Vieta:</label>
                <input type="text" class="form-control" id="Vieta" name="Vieta" placeholder="VEF kultūras pils" required>
            </div>
            <div class="form-group">
                <label for="Saite">Saite:</label>
                <input type="url" class="form-control" id="Saite" name="Saite" placeholder="piem. https://www.bilesuserviss.lv/lat/ziedudarzi" required>
            </div>
            <div class="form-group">
                <label for="Ilgums">Ilgums:</label>
                <input type="text" class="form-control" id="Ilgums" name="Ilgums" placeholder="piem. 2 stundas" required>
            </div>
            <button type="submit" class="btn btn-primary">Pievienot</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
