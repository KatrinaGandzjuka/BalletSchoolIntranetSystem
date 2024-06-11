<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauta informācija par konkrēta koncerta numuriem.
Dokumentā ir iekļauts koncerta nosaukums, datums, vieta, ilgums un numuru skaits, kā arī detalizēts katra numura apraksts.
Dokumentā ir iekļauts arī logotips koncerta informācijas galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koncerta numuru saraksts PDF</title>
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
            width: 300px;
            height: 80px;
            margin-right: 20px;
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
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
        <div>
            <h1 style="text-align: center;">{{ $koncerts->Nosaukums }}</h1>
            <p style="text-align: center;">Datums: {{ $koncerts->Datums }}</p>
            <p style="text-align: center;">Vieta: {{ $koncerts->Vieta }}</p>
            <p style="text-align: center;">Ilgums: {{ $koncerts->Ilgums }}</p>
            <p style="text-align: center;">Numuru skaits: {{ $numuri->count() }}</p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kārtas numurs</th>
                <th>Nosaukums</th>
                <th>Izpildītāji</th>
                <th>Garums</th>
                <th>Horeogrāfija</th>
                <th>Pedagogi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($numuri as $numurs)
                <tr>
                    <td>{{ $numurs->KartasNumurs }}</td>
                    <td>{{ $numurs->numurs->NumuraNosaukums }}</td>
                    <td>
                        @foreach($numurs->audzekni as $audzeknis)
                            {{ $audzeknis->Vards }} {{ $audzeknis->Uzvards }} ({{ $audzeknis->GrupasNosaukums }})<br>
                        @endforeach
                    </td>
                    <td>{{ $numurs->numurs->Garums }}</td>
                    <td>{{ $numurs->numurs->Horeografija }}</td>
                    <td>
                        @foreach($numurs->pedagogi as $pedagogs)
                            {{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }}<br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
