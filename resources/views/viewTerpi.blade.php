<!--
    Šis HTML dokuments ir paredzēts baletskolas kostīmu uzskaites sistēmas tērpu pārskatam un pārvaldībai.
    Dokumentā ir ietverta navigācijas josla, kas ļauj piekļūt dažādām sistēmas sadaļām, meklēšanas forma tērpu ātrai atrašanai,
    kā arī tabula ar tērpu sarakstu. Katrs tērps tiek attēlots ar nosaukumu, izmēru, krāsu, attēlu, kā arī ar iespējām izdalīt, savākt,
    rediģēt un dzēst tērpus.
    -->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tērpu pārskats</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/viewTerpi">Tērpi</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">lietotāji</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/addGrupas">grupas</a>
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
            <a class="nav-link" href="/addTerpi">pievienot tērpu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="/viewTerpi">tērpu saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <form action="{{ url('/searchTerpi') }}" method="GET">
        <div class="form-group row">
          <div class="col-md-8">
            <input class="form-control mr-sm-2" type="search" placeholder="Meklēt" aria-label="Search" name="query">
          </div>
          <button class="col-md-1 btn btn-primary float-right" type="submit">Meklēt</button>
        </div>
      </form>
    </div>
    <div class="container">
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
            <th>Rediģēšana</th>
            <th>Dzēšana</th>
          </tr>
        </thead>
        <tbody> @foreach($TerpiData as $td) <tr>
            <td>{{$td->Nosaukums}}</td>
            <td>{{$td->Izmers}}</td>
            <td>{{$td->Krasa}}</td>
            <td>
              <img src="data:image/{{strtolower(pathinfo($td->Attels, PATHINFO_EXTENSION))}};base64,{{$td->Attels}}" />
            </td>
            <td>
              <a href="{{ url('/iedalitTerpi'.$td->KostimiID) }}" class="btn btn-primary">Izdalīt</a>
            </td>
            <td>
              <a class="btn btn-primary" href="{{ url('/savaktTerpi'.$td->KostimiID) }}">Savākt</a>
            </td>
            <td>
              <a href="{{ url('/redigetTerpi'.$td->KostimiID) }}" class="btn btn-primary">Rediģēt</a>
            </td>
            <td>
              <a href="{{ url('/dzestTerpus'.$td->KostimiID) }}" class="btn btn-danger">Dzēst</a>
            </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">