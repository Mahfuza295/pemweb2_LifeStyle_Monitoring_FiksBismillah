<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Aktivitas Harian</title>

    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>

<h2>Riwayat Aktivitas Harian</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Makan</th>
            <th>Olahraga</th>
            <th>Tidur</th>
            <th>Air Minum</th>
            <th>Skor</th>
        </tr>
    </thead>

    <tbody>
        @foreach($riwayat as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->makan }}</td>
            <td>{{ $item->olahraga }}</td>
            <td>{{ $item->tidur }}</td>
            <td>{{ $item->air_minum }}</td>
            <td>{{ $item->skor ?? 0 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>