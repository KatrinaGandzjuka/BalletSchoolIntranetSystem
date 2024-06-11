<!--
Šis HTML dokuments nodrošina funkcionalitāti, lai pievienotu numurus koncertam baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un sarakstu ar pieejamiem numuriem, kurus var pievienot konkrētam koncertam.
Lietotāji var izvēlēties numurus un pievienot tos koncertam, norādot kārtas numuru.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienot Numuru Koncertam</title>
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
    <div class="container mt-5">
        <h2>Pievienot Numuru Koncertam</h2>
        <form action="/dataInsertKoncertiNumuri{{ $KoncertsID }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="KartasNumurs">Kārtas Numurs:</label>
                <input type="number" class="form-control" id="KartasNumurs" name="KartasNumurs" required>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Numura Nosaukums</th>
                        <th>Kārtas Numurs</th>
                        <th>Garums</th>
                        <th>Mūzika</th>
                        <th>Horeogrāfija</th>
                        <th>Izpildītāju Skaits</th>
                        <th>Pievienošana</th>
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
                            <td>
                                <button type="submit" class="btn btn-primary" formaction="/dataInsertKoncertiNumuri{{ $KoncertsID }}/{{ $numurs->NumursID }}">Pievienot</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</body>
</html>
