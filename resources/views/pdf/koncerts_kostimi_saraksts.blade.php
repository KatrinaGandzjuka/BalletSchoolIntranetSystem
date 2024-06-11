<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauta informācija par konkrētu koncertu,
tai skaitā koncerta nosaukums, datums, vieta, ilgums, izpildītāju skaits un katra numura kostīmu saraksts ar attēliem.
Dokumentā ir iekļauts arī logotips koncerta informācijas galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koncerta kostīmu saraksts PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 300px;
            height: 80px;
            margin-right: 20px;
        }
        .header div {
            flex-grow: 1;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
        <div>
            <h1>{{ $koncerts->Nosaukums }}</h1>
            <p>Datums: {{ $koncerts->Datums }}</p>
            <p>Vieta: {{ $koncerts->Vieta }}</p>
            <p>Ilgums: {{ $koncerts->Ilgums }}</p>
            <p>Izpildītāju skaits: {{ $numuri->sum('numurs.IzpilditajuSkaits') }}</p>
        </div>
    </div>
    <table>
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
                    <td><img src="data:image/{{strtolower(pathinfo($numurs->numurs->kostims->Attels, PATHINFO_EXTENSION))}};base64,{{$numurs->numurs->kostims->Attels}}" /></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
