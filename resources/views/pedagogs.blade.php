<!--
Šis HTML dokuments nodrošina pedagoga informācijas pārvaldību baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un sekcijas, kurās tiek attēlota pedagoga informācija, grupas, noliktavas tērpi un koncerti.
Lietotāji var rediģēt pedagoga datus, pievienot vai dzēst grupas un tērpus, kā arī eksportēt dažādus sarakstus.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedagogs</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
@if(session('success'))
    @if(session('success') == true)
        <script>alert("Lietotāja dati tika pievienoti ;)");</script>
    @else
        <script>alert("Lietotāja dati netika pievienoti :(");</script>
    @endif
@endif

<!-- Navigācija -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="/login">Pedagogs</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<!-- Pedagoga informācija -->
<div class="container">
  <h2>Pedagoga informācija</h2>
  <table class="table">
      <thead>
          <tr>
              <th>Vārds un Uzvārds</th>
              <th>Tālruņa numurs</th>
              <th>E-pasts</th>
              <th>Kopējais nodarbību skaits nedēļā</th>
              <th>Kopējais grupu skaits</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{ $LietotajsData->Vards }} {{ $LietotajsData->Uzvards }}</td>
              <td>{{ $LietotajsData->Talrunis }}</td>
              <td>{{ $LietotajsData->Epasts }}</td>
              <td>{{ $nodarbibuSkaits }}</td>
              <td>{{ $grupuSkaits }}</td>
          </tr>
      </tbody>
  </table>
</div>

<!-- Grupas informācija -->
<div class="container">
    <h2>Grupas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Grafiks</th>
                <th>Nodarbību skaits nedēļā</th>
                <th>Filiale</th>
                <th>Adrese</th>
                <th>Dalībnieki</th>
            </tr>
        </thead>
        <tbody>
            @foreach($GrupasData as $gd)
                <tr>
                    <td>{{ $gd->GrupasNosaukums }}</td>
                    <td>{{ $gd->Grafiks }}</td>
                    <td>{{ $gd->NodSk }}</td>
                    <td>{{ $gd->Filiale }}</td>
                    <td>{{ $gd->Valsts }}, {{ $gd->Pilseta }}, {{ $gd->Rajons }}, {{ $gd->Iela }}, {{ $gd->Eka }}, {{ $gd->Indekss }}</td>
                    <td>
                      <a href="{{ '/audzekniGrupas'.$gd->GrupasNosaukums }}" class="btn btn-primary">Saraksts</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pieejamie tērpi -->
<div class="container">
    <h2>Noliktavas tērpi</h2>
    <a href="{{ route('exportTerpiPDF') }}" class="btn btn-primary">Eksportēt sarakstu</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Izmērs</th>
                <th>Krāsa</th>
                <th>Attēls</th>
                <th>Izdalīšana</th>
                <th>Savākšana</th>
            </tr>
        </thead>
        <tbody>
            @foreach($TerpiData as $terps)
                <tr>
                    <td>{{ $terps->Nosaukums }}</td>
                    <td>{{ $terps->Izmers }}</td>
                    <td>{{ $terps->Krasa }}</td>
                    <td>
                        <img src="data:image/{{ strtolower(pathinfo($terps->Attels, PATHINFO_EXTENSION)) }};base64,{{ $terps->Attels }}" style="width: 50px; height: auto;" />
                    </td>
                    <td><a href="{{ url('/iedalitTerpi'.$terps->KostimiID) }}" class="btn btn-primary">Izdalīt</a></td>
                    <td><a class="btn btn-primary" href="{{ url('/savaktTerpi'.$terps->KostimiID) }}">Savākt</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Koncerti informācija -->
<div class="container">
    <h2>Koncerti</h2>
    @foreach($KoncertiData as $koncerts)
        <h4>{{ $koncerts->Nosaukums }}</h4>
        <p>{{ $koncerts->Datums }}, {{ $koncerts->Vieta }}, {{ $koncerts->Ilgums }}</p>
        <a href="{{ url('/exportPedagogsNumuriPDF/' . session('personasKods') . '/' . $koncerts->KoncertsID) }}" class="btn btn-primary mb-3">Eksportēt numuru sarakstu</a>
        <a href="{{ url('/exportPedagogsTerpiPDF/' . session('personasKods') . '/' . $koncerts->KoncertsID) }}" class="btn btn-primary mb-3">Eksportēt tērpu sarakstu</a>
        <h5>Mani koncerta numuri:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Kārtas numurs</th>
                    <th>Nosaukums</th>
                    <th>Izpildītāji</th>
                    <th>Garums</th>
                    <th>Mūzika</th>
                    <th>Horeogrāfija</th>
                    <th>Pedagogi</th>
                    <th>Kostīmi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($KoncertiNumuri as $numurs)
                    @if($numurs->KoncertsIDKoncNumurs == $koncerts->KoncertsID)
                        <tr>
                            <td>{{ $numurs->KartasNumurs }}</td>
                            <td>{{ $numurs->numurs->NumuraNosaukums }}</td>
                            <td>
                                @foreach($numurs->numurs->audzekni as $audzeknis)
                                    {{ $audzeknis->Vards }} {{ $audzeknis->Uzvards }}<br>
                                @endforeach
                            </td>
                            <td>{{ $numurs->numurs->Garums }}</td>
                            <td>{{ $numurs->numurs->Muzika }}</td>
                            <td>{{ $numurs->numurs->Horeografija }}</td>
                            <td>
                                @foreach($numurs->numurs->pedagogi as $pedagogs)
                                    {{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }}<br>
                                @endforeach
                            </td>
                            <td>{{ $numurs->numurs->kostims->Nosaukums }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>

<div class="container">
  <h2>Lietotāja datu atjaunošana</h2>
  @if (isset($LietotajsData) && $LietotajsData !== null)
      <form action="{{ url('dataUpdateLietotaji/'.$LietotajsData->personasKods) }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="Vards">Vārds:</label>
              <input type="text" class="form-control" name="Vards" value="{{ $LietotajsData->Vards }}">
          </div>
          <div class="form-group">
              <label for="Uzvards">Uzvārds:</label>
              <input type="text" class="form-control" name="Uzvards" value="{{ $LietotajsData->Uzvards }}">
          </div>
          <div class="form-group">
              <label for="Epasts">E-pasts:</label>
              <input type="email" class="form-control" name="Epasts" value="{{ $LietotajsData->Epasts }}">
          </div>
          <div class="form-group">
              <label for="Parole">Parole:</label>
              <input type="password" class="form-control" name="Parole" value="{{ $LietotajsData->Parole }}">
          </div>
          <div class="form-group">
              <label for="Talrunis">Tālrunis:</label>
              <input type="tel" class="form-control" name="Talrunis" value="{{ $LietotajsData->Talrunis }}">
          </div>
          <button type="submit" class="btn btn-primary">Saglabāt</button>
      </form>
  @endif
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
