<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauta informācija par konkrētu grupu,
tai skaitā grupas nosaukums, grafiks, pasniedzēja vārds un uzvārds, kā arī audzēkņu saraksts
ar viņu vārdiem, uzvārdiem, tālruņa numuriem un vecāku informāciju.
Dokumentā ir iekļauts arī logotips grupas informācijas galvenē.
-->

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupas saraksts PDF</title>
    <style>
        body {
            font-family: DejaVu Sans;
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
        .content {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
        <div>
            <h1>{{ $grupa->GrupasNosaukums }}</h1>
            <p>Grafiks: {{ $grupa->Grafiks }}</p>
            <p>Pasniedzējs: {{ $pedagogs->Vards }} {{ $pedagogs->Uzvards }}</p>
            <p>Audzēkņu skaits: {{ $audzekni->count() }}</p>
        </div>
    </div>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Tālruņa numurs</th>
                    <th>Vecāks (Vārds, Uzvārds, Tālrunis)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($audzekni as $audzeknis)
                    <tr>
                        <td>{{ $audzeknis->Vards }}</td>
                        <td>{{ $audzeknis->Uzvards }}</td>
                        <td>{{ $audzeknis->Talrunis }}</td>
                        <td>
                            @foreach($audzeknis->vecaki as $vecaks)
                                {{ $vecaks->Vards }} {{ $vecaks->Uzvards }} ({{ $vecaks->Talrunis }})
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
