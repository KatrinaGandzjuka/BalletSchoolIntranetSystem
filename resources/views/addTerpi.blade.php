<!--
Šis HTML dokuments nodrošina formu tērpa pievienošanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var ievadīt tērpa nosaukumu, krāsu, izmēru un attēlu.
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tērpu pievienošana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addTerpi">Tērpi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Lietotāji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addGrupas">Grupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addNumurs">Numuri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addKoncerts">Koncerti</a>
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
                    <a class="nav-link" style="color:#3a88fe;" href="/addTerpi">Pievienot tērpu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/viewTerpi">Tērpu saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Forma-->
    <div class="container">
        <form action="dataInsertTerpi" method="post" enctype="multipart/form-data"> @csrf
            <div class="form-group">
                <label for="Nosaukums">Nosaukums:</label>
                <input type="text" class="form-control" name="Nosaukums" placeholder="piem. svārki" required autofocus>
            </div>
            <div class="form-group">
                <label for="Krasa">Krāsa:</label>
                <input type="text" class="form-control" name="Krasa" placeholder="piem. rozā" required autofocus>
            </div>
            <div class="form-group">
                <label for="Izmers">Izmērs:</label>
                <input type="text" class="form-control" name="Izmers" placeholder="piem. 165 cm" required autofocus>
            </div>
            <div class="form-group">
                <label for="Attels">Attēls:</label>
                <input type="file" class="form-control" name="Attels" placeholder="Pievienojiet attēlu">
            </div>
            <button type="submit" class="btn btn-primary">Pievienot tērpu</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
