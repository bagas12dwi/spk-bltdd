<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Warga</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>

</head>

<body>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Tempat, Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataWarga as $warga)
                <tr>
                    <td>{{ $warga->nik }}</td>
                    <td>{{ $warga->nama }}</td>
                    <td>{{ $warga->alamat }}</td>
                    <td>{{ $warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d-m-Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
