<!--
Šis HTML dokuments nodrošina detalizētu informāciju par audzēkni baletskolas sistēmā.
Dokuments ietver navigācijas joslu ar saitēm uz dažādām lapām un vairākas tabulas, kas attēlo audzēkņa personas datus, grupas, pedagogus, vecākus, kostīmus un koncertus, kuros audzēknis piedalās.
Navigācijas joslas un darbības ir atkarīgas no lietotāja lomas, lai nodrošinātu atbilstošu piekļuvi un funkcionalitāti.
-->
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="navbar-brand" href="/login">Audzeknis</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('main.css') }}">
</head>
<body>
    <!--Navigācija-->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="/login">Audzēknis</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Audzēkņa informācija -->
    <div class="container">
        <h2>Audzēkņa informācija</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Vārds un Uzvārds</th>
                    <th>Personas Kods</th>
                    <th>Tālruņa numurs</th>
                    <th>E-pasts</th>
                    <th>Dzimšanas datums</th>
                    <th>Vecums</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $ld->Vards }} {{ $ld->Uzvards }}</td>
                    <td>{{ $ld->personasKods }}</td>
                    <td>{{ $ld->Talrunis }}</td>
                    <td>{{ $ld->Epasts }}</td>
                    <td>{{ $ld->DzimDiena }}</td>
                    <td>{{ \Carbon\Carbon::parse($ld->DzimDiena)->age }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Grupas informācija -->
    <div class="container">
        <table class="table">
            <thead>
                <th colspan="4" style="font-size: larger">Grupas:</th>
                <tr>
                    <th>Nosaukums</th>
                    <th>Grafiks</th>
                    <th>Filiale</th>
                    <th>Adrese</th>
                </tr>
            </thead>
            <tbody>
                @foreach($GrupasData as $gd)
                    <tr>
                        <td>{{$gd->GrupasNosaukums}}</td>
                        <td>{{$gd->Grafiks}}</td>
                        <td>{{$gd->Filiale}}</td>
                        <td>{{$gd->Valsts}}, {{$gd->Pilseta}}, {{$gd->Rajons}}, {{$gd->Iela}}, {{$gd->Eka}}, {{$gd->Indekss}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pedagogi informācija -->
    <div class="container">
        <table class="table">
            <thead>
                <th colspan="4" style="font-size: larger">Pedagogi:</th>
                <tr>
                    <th>Vārds un uzvārds</th>
                    <th>Tālrunis</th>
                    <th>Epasts</th>
                    <th>Dzimšanas diena</th>
                </tr>
            </thead>
            <tbody>
                @foreach($PedagogsData as $pd)
                    <tr>
                        <td>{{$pd->Vards}} {{$pd->Uzvards}}</td>
                        <td>{{$pd->Talrunis}}</td>
                        <td>{{$pd->Epasts}}</td>
                        <td>{{$pd->DzimDiena}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Vecāki informācija -->
    <div class="container">
        <table class="table">
            <thead>
                <th colspan="3" style="font-size: larger">Vecāki:</th>
                <tr>
                    <th>Vārds un uzvārds</th>
                    <th>Tālrunis</th>
                    <th>Epasts</th>
                </tr>
            </thead>
            <tbody>
                @foreach($VecaksData as $vd)
                    <tr>
                        <td>{{$vd->Vards}} {{$vd->Uzvards}}</td>
                        <td>{{$vd->Talrunis}}</td>
                        <td>{{$vd->Epasts}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Kostīmi informācija -->
    <div class="container">
        <table class="table">
            <thead>
                <th colspan="5" style="font-size: larger">Kostīmi:</th>
                <tr>
                    <th>Nosaukums</th>
                    <th>Izmērs</th>
                    <th>Krāsa</th>
                    <th>Attēls</th>
                    <th>Izsniegšanas Datums</th>
                </tr>
            </thead>
            <tbody>
                @foreach($TerpiData as $td)
                    <tr>
                        <td>{{$td->Nosaukums}}</td>
                        <td>{{$td->Izmers}}</td>
                        <td>{{$td->Krasa}}</td>
                        <td>
                            <img src="data:image/{{strtolower(pathinfo($td->Attels, PATHINFO_EXTENSION))}};base64,{{$td->Attels}}" />
                        </td>
                        <td>{{$td->PiesDatums}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Koncerti informācija -->
    <div class="container">
        <h2>Koncerti, kuros piedalos</h2>
        @foreach($KoncertiData as $koncerts)
            <h4>{{ $koncerts->Nosaukums }}</h4>
            <p>{{ $koncerts->Datums }}, {{ $koncerts->Vieta }}, {{ $koncerts->Ilgums }}</p>
            <a href="{{ url('/exportAudzeknisTerpiPDF/' . $ld->personasKods . '/' . $koncerts->KoncertsID) }}" class="btn btn-primary mb-3">Eksportēt tērpu sarakstu</a>
            <h5>Mani koncerta numuri:</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Kārtas numurs</th>
                        <th>Nosaukums</th>
                        <th>Garums</th>
                        <th>Mūzika</th>
                        <th>Horeogrāfija</th>
                        <th>Kostīms</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($NumuriData as $numurs)
                        @if($numurs->KoncertsIDKoncNumurs == $koncerts->KoncertsID)
                            <tr>
                                <td>{{ $numurs->KartasNumurs }}</td>
                                <td>{{ $numurs->NumuraNosaukums }}</td>
                                <td>{{ $numurs->Garums }}</td>
                                <td>{{ $numurs->Muzika }}</td>
                                <td>{{ $numurs->Horeografija }}</td>
                                <td>{{ $numurs->KostimaNosaukums }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

    <div class="container">
        <table class="table"> @if (isset($ld) && $ld !== null && (session('LomaID') == 0 || session('LomaID') == 1))
            <thead>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpu"></script>
</body>
</html>
