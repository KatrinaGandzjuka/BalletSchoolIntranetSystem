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
    <title>Grupu saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!-- Navigācija -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/addGrupas">Grupas</a>
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
            <a class="nav-link" href="/addNumurs">numuri</a>
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
            <a class="nav-link" href="/addGrupas">pievienot grupu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="/viewGrupas">grupu saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Nosaukums</th>
            <th>Grafiks</th>
            <th>Filiale</th>
            <th>Audzēkņu skaits</th>
            <th>Dalībnieki</th>
            <th>Rediģēšana</th>
            <th>Dzēšana</th>
          </tr>
        </thead>
        <tbody> @foreach($GrupasData as $gd) <tr>
            <td>{{$gd->GrupasNosaukums}}</td>
            <td>{{$gd->Grafiks}}</td>
            <td>{{$gd->Filiale}}</td>
            <td>{{$gd->audzeknuSkaits}}</td>
            <td>
              <a href="{{ '/audzekniGrupas'.$gd->GrupasNosaukums }}" class="btn btn-primary">Saraksts</a>
            </td>
            <td>
              <a href="{{ '/redigetGrupas'.$gd->GrupasNosaukums }}" class="btn btn-primary">Rediģēt</a>
            </td>
            <td>
              <a href="{{ url('/dzestGrupas'.$gd->GrupasNosaukums) }}" class="btn btn-danger">Dzēst</a>
            </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>