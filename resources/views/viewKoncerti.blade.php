 <!--
    Šis HTML dokuments ir paredzēts baletskolas kostīmu uzskaites sistēmas grupu saraksta apskatei un pārvaldībai.
    Dokumentā ir ietverta navigācijas josla, kas ļauj piekļūt dažādām sistēmas sadaļām, kā arī tabula ar grupu sarakstu.
    Katras grupas informācija ietver nosaukumu, grafiku, filiāli, audzēkņu skaitu, dalībnieku sarakstu, rediģēšanas un dzēšanas iespējas.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koncertu saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addKoncerts">Koncerti</a>
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
    <nav class="navbar navbar-expand-lg navbar-light navbar-lighter">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/addKoncerts">Pievienot koncertu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#3a88fe;" href="/koncerti">Koncertu saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Datums</th>
                    <th>Vieta</th>
                    <th>Saite</th>
                    <th>Ilgums</th>
                    <th>Saraksts</th>
                    <th>Rediģēšana</th>
                    <th>Dzēšana</th>
                </tr>
            </thead>
            <tbody>
                @foreach($KoncertiData as $koncerts)
                    <tr>
                        <td>{{ $koncerts->Nosaukums }}</td>
                        <td>{{ $koncerts->Datums }}</td>
                        <td>{{ $koncerts->Vieta }}</td>
                        <td><a href="{{ $koncerts->Saite }}">{{ $koncerts->Saite }}</a></td>
                        <td>{{ $koncerts->Ilgums }}</td>
                        <td>
                            <a class="btn btn-secondary" href="/koncertiNumuri{{ $koncerts->KoncertsID }}">Numuri</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="/editKoncerts/{{ $koncerts->KoncertsID }}">Rediģēt</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/deleteKoncerts/{{ $koncerts->KoncertsID }}">Dzēst</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
