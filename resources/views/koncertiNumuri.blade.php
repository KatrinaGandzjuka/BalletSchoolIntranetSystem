
<!--
Šis HTML dokuments nodrošina numuru pārvaldības lapu konkrētam koncertam baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un tabulu, kurā tiek rādīti koncerta numuri, kā arī pieejamās darbības, piemēram, numuru pievienošana un dzēšana.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koncertu numuri</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
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
    <div class="container mt-5">
        <h2>Numuri koncertam: {{ $koncerts->Nosaukums }}</h2>
        <a href="{{ '/pievNumuriKoncertam'.$koncerts->KoncertsID }}" class="btn btn-primary">Pievienot numuru</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Numura Nosaukums</th>
                    <th>Kārtas Numurs</th>
                    <th>Garums</th>
                    <th>Mūzika</th>
                    <th>Horeogrāfija</th>
                    <th>Izpildītāju Skaits</th>
                    <th>Kostīms</th>
                    <th>Audzēkņi</th>
                    <th>Pedagogi</th>
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($NumuriData as $numurs)
                    <tr>
                        <td>{{ $numurs->NumuraNosaukums }}</td>
                        <td>{{ $numurs->KartasNumurs }}</td>
                        <td>{{ $numurs->Garums }}</td>
                        <td>{{ $numurs->Muzika }}</td>
                        <td>{{ $numurs->Horeografija }}</td>
                        <td>{{ $numurs->IzpilditajuSkaits }}</td>
                        <td>{{$numurs->Nosaukums}}</td>
                        <td>
                            <a href="{{ '/audzekniNumurs'.$numurs->NumursID }}" class="btn btn-primary">Izpildītāji</a>
                        </td>
                        <td>
                            <a href="{{ '/pedagogiNumurs'.$numurs->NumursID }}" class="btn btn-primary">Horeogrāfi</a>
                        <td>
                            <a class="btn btn-danger" href="/dataDeleteKoncertiNumuri/{{ $numurs->KoncertsNumursID }}">Dzēst</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('exportKoncertsPDF', ['KoncertsID' => $koncerts->KoncertsID]) }}" class="btn btn-primary">Eksportēt numuru sarakstu</a>
        <a href="{{ route('export_koncerts_kostimi_pdf', ['koncertsID' => $koncerts->KoncertsID]) }}" class="btn btn-primary">Eksportēt kostīmu sarakstu</a>
    </div>
</body>
</html>
