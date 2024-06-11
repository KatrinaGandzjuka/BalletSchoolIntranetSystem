
<!--
Šis HTML dokuments nodrošina formu lietotāja datu rediģēšanai baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un formu, kurā var rediģēt lietotāja informāciju, piemēram, vārdu, uzvārdu, e-pastu, paroli un tālruņa numuru.
Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
Ja lietotājam ir piešķirta vecāka loma, tiek parādīts arī lauks bērna personas koda ievadei.
-->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotāja rediģēšana</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body> @if(session('success')) @if(session('success') == true) <script>
      alert("Lietotaja dati tika pievienoti ;)");
    </script> @else <script>
      alert("Lietotaja dati netika pievienoti :(");
    </script> @endif @endif
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
            <a class="nav-link" style="color:#3a88fe;" href="/">pievienot lietotāju</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/viewLietotaji">lietotāju saraksts</a>
          </li>
        </ul>
      </div>
    </nav>
    <!--forma-->
    <div class="container"> @if(isset($ld) && $ld !== null) <form action="dataUpdateLietotaji{{ $ld->personasKods }}" method="post" enctype="multipart/form-data"> @csrf
        <!--note to self: Cross-Site Request Forgery ir drošības metode, kas tiek izmantota, lai aizsargātu lietotājus no kaitīgas rīcības, kas saistīta ar krāpšanos ar pieprasījumiem no citas vietnes.-->
        <div class="form-group">
          <label for="Vards">Vārds:</label>
          <input type="text" class="form-control" name="Vards" value="{{ $ld->Vards }}">
        </div>
        <div class="form-group">
          <label for="Uzvards">Uzvārds:</label>
          <input type="text" class="form-control" name="Uzvards" value="{{ $ld->Uzvards }}">
        </div>
        <div class="form-group">
          <label for="Epasts">E-pasts:</label>
          <input type="email" class="form-control" name="Epasts" value="{{ $ld->Epasts }}">
        </div>
        <div class="form-group">
          <label for="Parole">Parole:</label>
          <input type="password" class="form-control" name="Parole" value="{{ $ld->Parole }}">
        </div>
        <div class="form-group">
          <label for="Talrunis">Tālrunis:</label>
          <input type="tel" class="form-control" name="Talrunis" value="{{ $ld->Talrunis }}">
        </div> @if($ld->LomaID == 2) <div class="form-group">
          <label for="bernaPersonasKods">Bērna personas kods:</label>
          <input type="text" class="form-control" name="bernaPersonasKods" value="{{ $ld->bernaPersonasKods }}">
        </div> @endif @endif <button type="submit" class="btn btn-primary">Saglabāt</button>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">