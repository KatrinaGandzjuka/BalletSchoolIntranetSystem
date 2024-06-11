<!--
Šis HTML dokuments nodrošina funkcionalitāti koncerta dzēšanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un apstiprinājuma formu koncerta dzēšanai, kurā lietotājs var pārskatīt koncerta informāciju un apstiprināt vai atcelt dzēšanas darbību.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dzēst Koncertu</title>
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
        <div class="card">
            <div class="card-header">Izdzēst šo koncertu?</div>
            <div class="card-body">
                <h5 class="card-title">{{ $koncerts->Nosaukums }}</h5>
                <p class="card-text">Datums: {{ $koncerts->Datums }}</p>
                <p class="card-text">Vieta: {{ $koncerts->Vieta }}</p>
                <p class="card-text">Ilgums: {{ $koncerts->Ilgums }}</p>
                <a href="/koncerti" class="btn btn-secondary">Nē</a>
                <form action="/deleteKoncertsData/{{ $koncerts->KoncertsID }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Jā, dzēst</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
