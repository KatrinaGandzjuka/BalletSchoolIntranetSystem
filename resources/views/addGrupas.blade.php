<!--
Šis HTML dokuments nodrošina formu grupu pievienošanai baletskolas sistēmā. 
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var ievadīt grupas nosaukumu, grafiku un filiāli. 
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupu pievienošana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addGrupas">Grupas</a>
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
                    <a class="nav-link" style="color:#3a88fe;" href="/addGrupas">Pievienot grupu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/viewGrupas">Grupu saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Forma grupas pievienošanai-->
    <div class="container">
        <form action="/dataInsertGrupas" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="form-group">
                <label for="GrupasNosaukums" class="control-label">Grupas nosaukums:</label>
                <input type="text" class="form-control" name="GrupasNosaukums" placeholder="piem. P2" required autofocus>
            </div>
            <div class="form-group">
                <label for="Grafiks">Grafiks:</label>
                <input type="text" class="form-control" name="Grafiks" placeholder="piem. pirmdiena, trešdiena 17:00-18:00" required>
            </div>
            <div class="form-group">
                <label for="Filiale">Filiāle:</label>
                <select class="form-control" name="Filiale">
                    <option value="Blaumaņa">Blaumaņa iela</option>
                    <option value="Saharova">Saharova iela</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pievienot grupu</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">
</body>
</html>
