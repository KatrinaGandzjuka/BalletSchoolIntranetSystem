<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauta informācija par pedagoga numuriem konkrētā koncertā.
Dokumentā ir iekļauts pedagoga vārds, uzvārds, koncerta nosaukums, datums, vieta un ilgums, kā arī detalizēts katra numura apraksts.
Dokumentā ir iekļauts arī logotips koncerta informācijas galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <title>Pedagoga koncerta numuri</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 300px;
            margin-right: 20px;
        }
        .header div {
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
            <div>
                <h2>{{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }} - {{ $koncerts->Nosaukums }}</h2>
                <p>Datums: {{ $koncerts->Datums }}</p>
                <p>Vieta: {{ $koncerts->Vieta }}</p>
                <p>Ilgums: {{ $koncerts->Ilgums }}</p>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Kārtas numurs</th>
                    <th>Nosaukums</th>
                    <th>Izpildītājs</th>
                    <th>Garums</th>
                    <th>Mūzika</th>
                    <th>Horeogrāfija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($numuri as $numurs)
                <tr>
                    <td>{{ $numurs->KartasNumurs }}</td>
                    <td>{{ $numurs->numurs->NumuraNosaukums }}</td>
                    <td>
                        @foreach($numurs->numurs->audzekni as $audzeknis)
                        {{ $audzeknis->Vards }} {{ $audzeknis->Uzvards }}<br>
                        @endforeach
                    </td>
                    <td>{{ $numurs->numurs->Garums }}</td>
                    <td>{{ $numurs->numurs->Muzika }}</td>
                    <td>{{ $numurs->numurs->Horeografija }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
