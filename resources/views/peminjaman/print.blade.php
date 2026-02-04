<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #000;
    }
    th, td {
        padding: 6px;
        text-align: left;
    }
    th {
        background: #f2f2f2;
    }
</style>

</head>

<body onload="window.print()">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $peminjaman)
                <tr class="bg-white dark:bg-gray-800">
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $peminjaman->user->name }}</td>
                    <td>
                        {{ $peminjaman->user->email }}</td>
                    <td>
                        {{ $peminjaman->alat->nama_alat }}</td>
                    <td>
                        {{ $peminjaman->alat->kategori->name }}</td>
                    <td>{{ $peminjaman->jumlah }}
                    </td>
                    <td>{{ $peminjaman->status }}
                    </td>
                    <td>
                        {{ $peminjaman->tgl_pinjam }}</td>
                    <td>
                        {{ $peminjaman->tgl_kembali }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
