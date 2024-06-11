<!--
Šis HTML dokuments nodrošina tērpu savākšanas funkcionalitāti baletskolas sistēmā.
Dokuments ietver navigācijas joslas ar saitēm uz dažādām lapām un tabulu, kurā ir redzami lietotāji, to grupas un iespēja savākt tērpus.
Navigācijas joslas un darbības ir atkarīgas no lietotāja lomas, lai nodrošinātu atbilstošu piekļuvi un funkcionalitāti.
-->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tērpu savākšana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body> @if(session('success')) @if(session('success') == true) <script>
      alert(" ;)");
    </script> @else <script>
      alert(":(");
    </script> @endif @endif @if (session('LomaID') == 0)
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
    </nav> @endif <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>Vārds un uzvārds</th>
            <th>Grupa</th>
            <th>Savākšana</th>
          </tr>
        </thead>
        <tbody> @foreach($LietotajsData as $ld) <tr>
            <td>{{$ld->Vards}} {{$ld->Uzvards}}</td>
            <td>{{$ld->GrupasAudzeknaNosaukums}}
            </td>
            <td>
              <a class="btn btn-primary" href="/dataDeleteAudzekniKostimi{{$KostimiID}}/{{$ld->personasKods}} ">Savākt</a>
            </td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">