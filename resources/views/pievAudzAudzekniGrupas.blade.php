<!--
Šis HTML dokuments nodrošina funkcionalitāti audzēkņu pievienošanai grupām baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un sarakstu ar audzēkņiem, kurus var pievienot noteiktai grupai.
Lietotāji var apskatīt audzēkņu sarakstu un pievienot audzēkņus izvēlētajai grupai.
-->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pievienot audzēkni grupai</title>
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
            <a class="nav-link" href="/addGrupas">pievienot grupu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="/viewGrupas">grupu saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light navbar-brighter">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <a class="navbar-brand" href="/audzekniGrupas{{$GrupasNosaukums}}">{{$GrupasNosaukums}}</a>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="{{ '/pievAudzAudzekniGrupas'.$GrupasNosaukums}}">pievienot audzēkni</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ '/pievPedPedagogiGrupas'.$GrupasNosaukums}}">pievienot pedagogu</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Vārds un uzvārds</th>
            <th>Vecums</th>
            <th>Pievienošana</th>
          </tr>
        </thead>
        <tbody> @foreach($LietotajsData as $ld) <tr>
          <td>{{$ld->Vards}} {{$ld->Uzvards}}</td>
          <td>{{ \Carbon\Carbon::parse($ld->DzimDiena)->age }}</td>
            <td>
              <a class="btn btn-primary" href="/dataInsertAudzekniGrupas{{$GrupasNosaukums}}/{{$ld->personasKods}}">Pievienot grupai</a>
            </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">