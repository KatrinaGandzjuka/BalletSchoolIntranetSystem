<!--
Šis HTML dokuments nodrošina numuru saraksta pārvaldības funkcionalitāti baletskolas sistēmā.
Dokuments ietver navigācijas joslas ar saitēm uz dažādām lapām un tabulu, kurā ir redzami lietotāji, to lomas, grupas un iespēja dzēst audzēkņus no numuriem.
Navigācijas joslas un darbības ir atkarīgas no lietotāja lomas, lai nodrošinātu atbilstošu piekļuvi un funkcionalitāti.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numuru saraksts</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/addNumurs">Numuri</a>
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
                    <a class="nav-link" href="/addGrupas">grupas</a>
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
                    <a class="nav-link" href="/addNumurs">Pievienot numuru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:#3a88fe;" href="/viewNumurs">Numuru saraksts</a>
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
                <a class="navbar-brand" style="color:#3a88fe;" href="{{ '/audzekniNumurs'.$NumursData->NumursID }}">{{$NumursData->NumuraNosaukums}}</a>
                <li class="nav-item">
                    <a class="nav-link" href="{{ '/pievAudzAudzekniNumurs'.$NumursData->NumursID }}">Pievienot audzēkni</a>
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
                    <th>Grupa</th>
                    <th>Dzēšana</th>
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
                        <td><a href="{{ url('/audzeknis'.$ld->personasKods) }}">{{$ld->Vards}} {{$ld->Uzvards}}</a></td>
                        <td>{{$ld->grupa}}</td>
                        <td>
                            @if($ld->LomaID == 1)
                                <a class="btn btn-danger" href="/dataDeleteAudzekniNumurs{{$NumursData->NumursID}}/{{$ld->personasKods}}">Dzēst no numura</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
