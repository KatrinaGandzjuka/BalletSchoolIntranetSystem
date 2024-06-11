<!--
Šis HTML dokuments nodrošina grupu saraksta skatu baletskolas sistēmā.
Dokuments ietver navigācijas joslas ar saitēm uz dažādām lapām un tabulu, kurā ir redzami grupu dalībnieki ar to lomām, vārdiem, uzvārdiem, tālruņa numuriem un e-pastiem.
Administratori var rediģēt grupu dalībniekus, pievienot audzēkņus vai pedagogus grupai, kā arī eksportēt grupas sarakstu PDF formātā.
Navigācijas joslas un darbības ir atkarīgas no lietotāja lomas, lai nodrošinātu atbilstošu piekļuvi un funkcionalitāti.
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
    @if(session('LomaID') == 0)
    <!-- Navigācija -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addGrupas">Grupas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/addTerpi">Tērpi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Lietotāji</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addNumurs">Numuri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addKoncerts">Koncerti</a>
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
                    <a class="nav-link" href="/addGrupas">Pievienot grupu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#3a88fe;" href="/viewGrupas">Grupu saraksts</a>
                </li>
            </ul>
        </div>
    </nav>
    @endif

    @if(session('LomaID') == 0)
    <nav class="navbar navbar-expand-lg navbar-light navbar-brighter">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <a class="navbar-brand" style="color:#3a88fe;" href="{{ '/audzekniGrupas'.$GrupasNosaukums }}">{{$GrupasNosaukums}}</a>
                <li class="nav-item">
                    <a class="nav-link" href="{{ '/pievAudzAudzekniGrupas'.$GrupasNosaukums}}">Pievienot audzēkni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ '/pievPedPedagogiGrupas'.$GrupasNosaukums}}">Pievienot pedagogu</a>
                </li>
            </ul>
        </div>
    </nav>
    @endif

    <div class="container">
        <a href="{{ url('/exportGrupasPDF/' . $GrupasNosaukums) }}" class="btn btn-primary mb-3">Eksportēt sarakstu</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Loma</th>
                    <th>Vārds un uzvārds</th>
                    <th>Tālriņa numurs</th>
                    <th>E-pasts</th>
                    @if(session('LomaID') == 0)
                    <th>Dzēšana</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($LietotajsData as $ld)
                <tr>
                    <td>
                        @foreach($LomasData as $lomd)
                            @if($lomd->LomaID == $ld->LomaID)
                                {{$lomd->LomasNosaukums}}
                            @endif
                        @endforeach
                    </td>
                    <td> @if($ld->LomaID == 1) <a href="{{'/audzeknis'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @elseif($ld->LomaID == 2) <a href="{{'/vecaks'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @elseif($ld->LomaID == 3) <a href="{{'/pedagogs'.$ld->personasKods}}">{{$ld->Vards}} {{$ld->Uzvards}}</a> @endif </td>
                    <td>{{$ld->Talrunis}}</td>
                    <td>{{$ld->Epasts}}</td>
                    @if(session('LomaID') == 0)
                    <td>
                        @if($ld->LomaID == 1)
                            <a class="btn btn-danger" href="/dataDeleteAudzekniGrupas{{$GrupasNosaukums}}/{{$ld->personasKods}}">Dzēst no grupas</a>
                        @elseif($ld->LomaID == 3)
                            <a class="btn btn-danger" href="/dataDeletePedagogiGrupas{{$GrupasNosaukums}}/{{$ld->personasKods}}">Dzēst no grupas</a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
