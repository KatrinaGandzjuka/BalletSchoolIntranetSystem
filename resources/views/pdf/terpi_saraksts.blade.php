<!--
Šis HTML dokuments ģenerē PDF failu ar tērpu sarakstu, kas ietver nosaukumu, krāsu, izmēru un attēlu katram tērpam. Dokumentā ir iekļauts arī kopējais pieejamo tērpu skaits un logotips galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tērpu saraksts PDF</title>
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
    </div>
    <h1>Tērpu saraksts</h1>
    <p>Pieejamo tērpu skaits: {{ $terpiCount }}</p>
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Krāsa</th>
                <th>Izmērs</th>
                <th>Attēls</th>
            </tr>
        </thead>
        <tbody>
            @foreach($terpi as $terps)
            <tr>
                <td>{{ $terps->Nosaukums }}</td>
                <td>{{ $terps->Krasa }}</td>
                <td>{{ $terps->Izmers }}</td>
                <td><img src="data:image/{{ strtolower(pathinfo($terps->Attels, PATHINFO_EXTENSION)) }};base64,{{ $terps->Attels }}" /></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
