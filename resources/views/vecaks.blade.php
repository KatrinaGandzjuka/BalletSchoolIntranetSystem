 <!--
    Šis HTML dokuments nodrošina vecāka profila apskates un rediģēšanas iespēju baletskolas kostīmu uzskaites sistēmā.
    Tas ietver navigācijas joslu, vecāka informācijas un bērnu sarakstu tabulas, kā arī formu vecāka datu rediģēšanai.
    Forma izmanto CSRF aizsardzību, lai nodrošinātu drošību pret krāpnieciskām darbībām.
    -->
<!DOCTYPE html>
<html lang="lv">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="navbar-brand" href="/login">Vecāks</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
  </head>
  <body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="/login">Vecāks </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
    <div class="container">
      <h2>Vecāka informācija</h2>
  <table class="table">
      <thead>
          <tr>
              <th>Vārds un Uzvārds</th>
              <th>Tālruņa numurs</th>
              <th>E-pasts</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>{{ $ld->Vards }} {{ $ld->Uzvards }}</td>
              <td>{{ $ld->Talrunis }}</td>
              <td>{{ $ld->Epasts }}</td>
          </tr>
      </tbody>
  </table>

      <table class="table">
        <thead>
          <th colspan="5" style="font-size: larger">Bērni:</th>
          <tr>
            <th>Vārds un uzvārds</th>
            <th>Personas Kods</th>
            <th>Tālrunis</th>
            <th>E-pasts</th>
            <th>Dzimšanas diena</th>
          </tr>
        </thead>
        <tbody> @foreach($BernsData as $bd) <tr>
            <td>
              <a href="{{'/audzeknis'.$bd->personasKods}}">{{$bd->Vards}} {{$bd->Uzvards}}</a>
            </td>
            <td>{{$bd->personasKods}}</td>
            <td>{{$bd->Talrunis}}</td>
            <td>{{$bd->Epasts}}</td>
            <td>{{$bd->DzimDiena}}</td>
          </tr> @endforeach </tbody>
      </table>
    </div>
    <div class="container">
      <table class="table"> @if (isset($ld) && $ld !== null && (session('LomaID') == 0 || session('LomaID') == 2)) <thead>
          <th style="font-size: larger">Dati:</th>
        </thead>
        <tbody>
          <!--forma-->
          <th>
            <form action="dataUpdateLietotaji{{ $ld->personasKods }}" method="post" enctype="multipart/form-data"> @csrf
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
              </div>
              <button type="submit" class="btn btn-primary">Saglabāt</button>
            </form> @endif
          </th>
        </tbody>
      </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu">