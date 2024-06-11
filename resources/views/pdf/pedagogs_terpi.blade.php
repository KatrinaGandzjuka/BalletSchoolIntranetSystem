<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauta informācija par pedagoga tērpiem konkrētā koncertā.
Dokumentā ir iekļauts pedagoga vārds, uzvārds, koncerta nosaukums, datums, vieta un ilgums, kā arī detalizēts katra numura apraksts ar kostīma nosaukumu un attēlu.
Dokumentā ir iekļauts arī logotips koncerta informācijas galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Pedagoga tērpu saraksts</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .header img {
            max-width: 600px;
            margin-right: 20px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .footer {
            text-align: center;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .header img {
            max-width: 600px;
            margin-right: 20px;
        }
        .footer {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .img-container {
            width: 50px;
            height: auto;
        }
        .img-container img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
    </div>
    <div class="container">
        <div class="header">
            <h2>{{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }} - {{ $koncerts->Nosaukums }}</h2>
            <p>Datums: {{ $koncerts->Datums }}</p>
            <p>Vieta: {{ $koncerts->Vieta }}</p>
            <p>Ilgums: {{ $koncerts->Ilgums }}</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Numura nosaukums</th>
                    <th>Izpildītāju skaits</th>
                    <th>Kostīma nosaukums</th>
                    <th>Kostīma attēls</th>
                </tr>
            </thead>
            <tbody>
                @foreach($numuri as $numurs)
                <tr>
                    <td>{{ $numurs->numurs->NumuraNosaukums }}</td>
                    <td>{{ $numurs->numurs->IzpilditajuSkaits }}</td>
                    <td>{{ $numurs->numurs->kostims->Nosaukums }}</td>
                    <td>
                        @if($numurs->numurs->kostims && $numurs->numurs->kostims->Attels)
                        <div class="img-container">
                            <img src="data:image/{{ strtolower(pathinfo($numurs->numurs->kostims->Attels, PATHINFO_EXTENSION)) }};base64,{{ $numurs->numurs->kostims->Attels }}">
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
