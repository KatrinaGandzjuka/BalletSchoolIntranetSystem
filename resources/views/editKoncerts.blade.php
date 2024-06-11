
<!--
Šis HTML dokuments nodrošina formu koncerta datu rediģēšanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var rediģēt koncerta nosaukumu, datumu, vietu, saiti un ilgumu.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt Koncertu</title>
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
                    <a class="nav-link" href="/addTerpi">tērpi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">lietotāji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addGrupas">grupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addNumurs">numuri</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <form action="/dataUpdateKoncerts/{{ $koncerts->KoncertsID }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="Nosaukums">Nosaukums:</label>
                <input type="text" class="form-control" id="Nosaukums" name="Nosaukums" value="{{ $koncerts->Nosaukums }}" required>
            </div>
            <div class="form-group">
                <label for="Datums">Datums:</label>
                <input type="date" class="form-control" id="Datums" name="Datums" value="{{ $koncerts->Datums }}" required>
            </div>
            <div class="form-group">
                <label for="Vieta">Vieta:</label>
                <input type="text" class="form-control" id="Vieta" name="Vieta" value="{{ $koncerts->Vieta }}" required>
            </div>
            <div class="form-group">
                <label for="Saite">Saite:</label>
                <input type="url" class="form-control" id="Saite" name="Saite" value="{{ $koncerts->Saite }}" required>
            </div>
            <div class="form-group">
                <label for="Ilgums">Ilgums:</label>
                <input type="text" class="form-control" id="Ilgums" name="Ilgums" value="{{ $koncerts->Ilgums }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Saglabāt</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
