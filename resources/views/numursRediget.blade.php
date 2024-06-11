
<!--
Šis HTML dokuments nodrošina formu numura datu rediģēšanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var rediģēt numura informāciju, piemēram, nosaukumu, garumu, mūziku, horeogrāfiju un izpildītāju skaitu.
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numuru rediģēšana</title>
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
                    <a class="nav-link" href="/addTerpi">tērpi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">lietotāji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addGrupas">grupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addKoncerts">koncerti</a>
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
        @if(isset($nd) && $nd !== null)
            <form action="dataUpdateNumurs{{ $nd->NumursID }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes. -->
                <div class="form-group">
                    <label for="NumuraNosaukums">Numura nosaukums:</label>
                    <input type="text" class="form-control" name="NumuraNosaukums" value="{{ $nd->NumuraNosaukums }}">
                </div>
                <div class="form-group">
                    <label for="Garums">Garums:</label>
                    <input type="text" class="form-control" name="Garums" value="{{ $nd->Garums }}">
                </div>
                <div class="form-group">
                    <label for="Muzika">Mūzika:</label>
                    <input type="text" class="form-control" name="Muzika" value="{{ $nd->Muzika }}">
                </div>
                <div class="form-group">
                    <label for="Horeografija">Horeogrāfija:</label>
                    <input type="text" class="form-control" name="Horeografija" value="{{ $nd->Horeografija }}">
                </div>
                <div class="form-group">
                    <label for="IzpilditajuSkaits">Izpildītāju skaits:</label>
                    <input type="number" class="form-control" name="IzpilditajuSkaits" value="{{ $nd->IzpilditajuSkaits }}">
                </div>
                <div class="form-group">
                    <label for="KostimiIDnumurs">Kostīms:</label>
                    <select class="form-control" name="KostimiIDnumurs" required>
                        @foreach($KostimiData as $kostims)
                            <option value="{{ $kostims->KostimiID }}">{{ $kostims->Nosaukums }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Saglabāt</button>
            </form>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
