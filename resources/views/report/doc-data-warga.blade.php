<!DOCTYPE html>
<html>
<head>
    <title>Data Penduduk</title>
    <style>
        body {
            font-family: 'Courier', monospace;
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Penduduk</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>JK</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Profesi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penduduks as $index => $penduduk)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $penduduk->nik }}</td>
                <td>{{ $penduduk->nama }}</td>
                <td>{{ $penduduk->tempat_lahir }}</td>
                <td>{{ $penduduk->tanggal_lahir }}</td>
                <td>{{ $penduduk->jenis_kelamin }}</td>
                <td>{{ $penduduk->agama }}</td>
                <td>{{ $penduduk->pendidikan }}</td>
                <td>{{ $penduduk->profesi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>