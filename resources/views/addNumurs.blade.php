<!--
Šis HTML dokuments nodrošina formu numura pievienošanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var ievadīt numura nosaukumu, garumu, mūziku, horeogrāfiju, izpildītāju skaitu un izvēlēties kostīmu.
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numuru pievienošana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addNumurs">Numuri</a>
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
                    <a class="nav-link" style="color:#3a88fe;" href="/addNumurs">Pievienot numuru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/viewNumurs">Numuru saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Forma-->
    <div class="container">
        <form action="/dataInsertNumurs" method="post" enctype="multipart/form-data"> @csrf
            <div class="form-group">
                <label for="NumuraNosaukums" class="control-label">Numura nosaukums:</label>
                <input type="text" class="form-control" name="NumuraNosaukums" placeholder="piem. Ziedu valsis" required autofocus>
            </div>
            <div class="form-group">
                <label for="Garums">Garums:</label>
                <input type="text" class="form-control" name="Garums" placeholder="piem. 2:30" required>
            </div>
            <div class="form-group">
                <label for="Muzika">Mūzika:</label>
                <input type="text" class="form-control" name="Muzika" placeholder="piem. Ziedu simfonija" required>
            </div>
            <div class="form-group">
                <label for="Horeografija">Horeogrāfija:</label>
                <input type="text" class="form-control" name="Horeografija" placeholder="piem. klasiskā deja" required>
            </div>
            <div class="form-group">
                <label for="IzpilditajuSkaits">Izpildītāju skaits:</label>
                <input type="number" class="form-control" name="IzpilditajuSkaits" placeholder="Ievadiet izpildītāju skaitu" required>
            </div>
            <div class="form-group">
                <label for="KostimiIDnumurs">Kostīms:</label>
                <select class="form-control" name="KostimiIDnumurs" required>
                    @foreach($KostimiData as $kostims)
                        <option value="{{ $kostims->KostimiID }}">{{ $kostims->Nosaukums }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Pievienot numuru</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
