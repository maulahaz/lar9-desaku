<!DOCTYPE html>
<html>
<head>
    <title>Data Penduduk - {{ $penduduk->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Data Penduduk</h1>
    <table>
        <tr>
            <th>NIK</th>
            <td>{{ $penduduk->nik }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $penduduk->nama }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $penduduk->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $penduduk->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <th>Agama</th>
            <td>{{ $penduduk->agama }}</td>
        </tr>
        <tr>
            <th>Pendidikan</th>
            <td>{{ $penduduk->pendidikan }}</td>
        </tr>
        <tr>
            <th>Profesi</th>
            <td>{{ $penduduk->profesi }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $penduduk->alamat }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $penduduk->email }}</td>
        </tr>
    </table>
</body>
</html>