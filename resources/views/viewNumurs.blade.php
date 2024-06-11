<!--
    Šis HTML dokuments ir paredzēts baletskolas kostīmu uzskaites sistēmas numuru saraksta apskatei un pārvaldībai.
    Dokumentā ir ietverta navigācijas josla, kas ļauj piekļūt dažādām sistēmas sadaļām, kā arī tabula ar numuru sarakstu.
    Katrs numurs tiek attēlots ar nosaukumu, garumu, mūziku, horeogrāfiju, izpildītāju skaitu, kostīmu, audzēkņiem, pedagogiem, kā arī ar iespējām rediģēt un dzēst numuru.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numuru saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!-- Navigācija -->
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
                <li class="nav-item">
                    <a class="nav-link" href="/addNumurs">Pievienot numuru</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" style="color:#3a88fe;" href="/viewNumurs">Numuru saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Garums</th>
                    <th>Mūzika</th>
                    <th>Horeogrāfija</th>
                    <th>Izpildītāju skaits</th>
                    <th>Kostīms</th>
                    <th>Audzēkņi</th>
                    <th>Pedagogi</th>
                    <th>Rediģēšana</th>
                    <th>Dzēšana</th>
                </tr>
            </thead>
            <tbody>
                @foreach($NumursData as $nd)
                    <tr>
                        <td>{{$nd->NumuraNosaukums}}</td>
                        <td>{{$nd->Garums}}</td>
                        <td>{{$nd->Muzika}}</td>
                        <td>{{$nd->Horeografija}}</td>
                        <td>{{$nd->IzpilditajuSkaits}}</td>
                        <td>{{$nd->Nosaukums}}</td>
                        <td>
                            <a href="{{ '/audzekniNumurs'.$nd->NumursID }}" class="btn btn-primary">Izpildītāji</a>
                        </td>
                        <td>
                            <a href="{{ '/pedagogiNumurs'.$nd->NumursID }}" class="btn btn-primary">Horeogrāfi</a>
                        </td>
                        <td>
                            <a href="{{ '/redigetNumurs'.$nd->NumursID }}" class="btn btn-primary">Rediģēt</a>
                        </td>
                        <td>
                            <a href="{{ url('/dzestNumurs'.$nd->NumursID) }}" class="btn btn-danger">Dzēst</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
