<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <h1>Data Pendaftaran PPDB</h1>
    <p style="text-align: center; margin-bottom: 20px;">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Asal Sekolah</th>
                <th>Nama Orang Tua</th>
                <th>No HP Orang Tua</th>
                <th>Jurusan</th>
                <th>Status</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->tanggal_lahir->format('d-m-Y') }}</td>
                <td class="text-center">{{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->asal_sekolah }}</td>
                <td>{{ $item->nama_ortu }}</td>
                <td>{{ $item->no_hp_ortu }}</td>
                <td>{{ $item->jurusan_pilihan }}</td>
                <td class="text-center">
                    @if($item->status_pendaftaran == 'diterima')
                        <span class="badge badge-success">Diterima</span>
                    @elseif($item->status_pendaftaran == 'ditolak')
                        <span class="badge badge-danger">Ditolak</span>
                    @else
                        <span class="badge badge-warning">Pending</span>
                    @endif
                </td>
                <td>{{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d-m-Y H:i') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px; text-align: center;">
        Total Data: {{ $registrations->count() }}
    </p>
</body>
</html>
