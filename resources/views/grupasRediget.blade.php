<!--
Šis HTML dokuments nodrošina formu grupas datu rediģēšanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var rediģēt grupas grafiku un filiāli.
-->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupu rediģēšana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
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
            <a class="nav-link" style="color:#3a88fe;" href="/addGrupas">pievienot grupu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/viewGrupas">grupu saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--forma-->
    <div class="container"> @if(isset($gd) && $gd !== null) <form action="dataUpdateGrupas{{ $gd->GrupasNosaukums }}" method="post" enctype="multipart/form-data"> @csrf
        <!--note to self: Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes.-->
        <div class="form-group">
          <label for="Grafiks">Grafiks:</label>
          <input type="text" class="form-control" name="Grafiks" value="{{ $gd->Grafiks }}">
        </div>
        <div class="form-group">
          <label for="Filiale">Filiāle:</label>
          <select class="form-control" name="Filiale" value="{{ $gd->Filiale }}">
            <option value="Blaumaņa">Blaumaņa iela</option>
            <option value="Saharova">Saharova iela</option>
          </select>
        </div> @endif <button type="submit" class="btn btn-primary">Saglabāt</button>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">