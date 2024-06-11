<!--
Šis HTML dokuments ģenerē PDF failu, kurā ir iekļauts audzēkņa un koncerta informācija,
kā arī saraksts ar numuriem un to attiecīgajiem kostīmiem.
Dokumentā ir iekļauts logotips, koncerta datums, vieta un ilgums, kā arī tabula ar numuru detaļām.
-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kostīmu Saraksts</title>
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
        table { 
            width: 100%; 
            border-collapse: collapse; 
        }
        th, td { 
            border: 1px solid black; 
            padding: 8px; 
            text-align: left; 
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="C:\laragon\www\BaletskolasIntranets\resources\images\logo.png" alt="Logo">
    </div>
    <h1 style="text-align: center;">{{ $audzeknis->Vards }} {{ $audzeknis->Uzvards }} - {{ $koncerts->Nosaukums }}</h1>
    <p style="text-align: center;">{{ $koncerts->Datums }}, {{ $koncerts->Vieta }}, {{ $koncerts->Ilgums }}</p>
    
    <h2>Numuri</h2>
    <table>
        <thead>
            <tr>
                <th>Kārtas numurs</th>
                <th>Nosaukums</th>
                <th>Garums</th>
                <th>Mūzika</th>
                <th>Horeogrāfija</th>
                <th>Kostīms</th>
                <th>Kostīma Attēls</th>
            </tr>
        </thead>
        <tbody>
            @foreach($numuri as $numurs)
                <tr>
                    <td>{{ $numurs->KartasNumurs }}</td>
                    <td>{{ $numurs->numurs->NumuraNosaukums }}</td>
                    <td>{{ $numurs->numurs->Garums }}</td>
                    <td>{{ $numurs->numurs->Muzika }}</td>
                    <td>{{ $numurs->numurs->Horeografija }}</td>
                    <td>{{ $numurs->numurs->kostims->Nosaukums }}</td>
                    <td>
                        @if($numurs->numurs->kostims->Attels)
                            <img src="data:image/{{ strtolower(pathinfo($numurs->numurs->kostims->Attels, PATHINFO_EXTENSION)) }};base64,{{ $numurs->numurs->kostims->Attels }}" style="width: 50px; height: auto;" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
