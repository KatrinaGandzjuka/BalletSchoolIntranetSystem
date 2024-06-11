 <!--
    Šis HTML dokuments ir paredzēts baletskolas kostīmu uzskaites sistēmas lietotāju saraksta apskatei un pārvaldībai.
    Dokumentā ir ietverta navigācijas josla, kas ļauj piekļūt dažādām sistēmas sadaļām, kā arī tabula ar lietotāju sarakstu.
    Katrs lietotājs tiek attēlots ar lomu, vārdu un uzvārdu, personas kodu, tālruni, e-pastu, dzimšanas dienu, kā arī ar iespējām rediģēt un dzēst lietotāju.
-->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotāju saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/">Lietotāji</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/addTerpi">tērpi</a>
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
            <a class="nav-link" href="/">pievienot lietotāju</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:#3a88fe;" href="/viewLietotaji">lietotāju saraksts</a>
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
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/viewLietotaji?loma=1') }}">audzēkņi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewLietotaji?loma=2') }}">vecāki</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/viewLietotaji?loma=3') }}">pedagogi</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Loma</th>
            <th>Vārds un uzvārds</th>
            <th>Personas Kods</th>
            <th>Tālrunis</th>
            <th>E-pasts</th>
            <th>Dzimšanas diena</th>
            <th>Rediģēšana</th>
            <th>Dzēšana</th>
          </tr>
        </thead>
        <tbody> @foreach($LietotajsData as $ld) <tr>
            <td> @foreach($LomasData as $lomd) @if($lomd->LomaID == $ld->LomaID) {{$lomd->LomasNosaukums}} @endif @endforeach </td>
            <td> @if($ld->LomaID == 1) <a href="{{'/audzeknis'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @elseif($ld->LomaID == 2) <a href="{{'/vecaks'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @elseif($ld->LomaID == 3) <a href="{{'/pedagogs'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @endif </td>
            <td>{{$ld->personasKods}}</td>
            <td>{{$ld->Talrunis}}</td>
            <td>{{$ld->Epasts}}</td>
            <td>{{$ld->DzimDiena}}</td>
            <td>
              <a href="{{'/redigetLietotajus'.$ld->personasKods}}" class="btn btn-primary">Rediģēt</a>
            </td>
            <td>
              <a href="{{ url('/dzestLietotajus'.$ld->personasKods) }}" class="btn btn-danger">Dzēst</a>
            </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">