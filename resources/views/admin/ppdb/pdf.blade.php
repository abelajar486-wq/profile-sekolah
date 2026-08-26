<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran PPDB</title>
    <style>
        @page {
            margin: 12mm 10mm 15mm 10mm;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.4;
        }
        
        /* Kop Surat & Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }
        .school-title {
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .doc-title {
            font-size: 13px;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            margin-top: 2px;
        }
        .school-info {
            font-size: 10px;
            color: #64748b;
            margin-top: 3px;
        }
        .divider {
            border-top: 3px solid #1e40af;
            border-bottom: 1px solid #94a3b8;
            height: 2px;
            margin-bottom: 15px;
        }

        /* Stat Summary Cards Table */
        .stats-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-bottom: 15px;
        }
        .stat-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 12px;
            text-align: center;
        }
        .stat-card.total { border-left: 4px solid #3b82f6; }
        .stat-card.accepted { border-left: 4px solid #22c55e; }
        .stat-card.pending { border-left: 4px solid #f59e0b; }
        .stat-card.rejected { border-left: 4px solid #ef4444; }

        .stat-val {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
        }
        .stat-lbl {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Main Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        .data-table th {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 6px;
            border: 1px solid #1e293b;
            text-align: left;
        }
        .data-table th.center, .data-table td.center {
            text-align: center;
        }
        .data-table td {
            padding: 7px 6px;
            border: 1px solid #cbd5e1;
            font-size: 10px;
        }
        .data-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
        }
        .badge-diterima {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .badge-ditolak {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .badge-pending {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        /* Footer & Signature */
        .footer-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }
        .footer-table td {
            border: none;
            vertical-align: top;
        }
        .signature-box {
            width: 220px;
            text-align: center;
            float: right;
        }
        .signature-space {
            height: 55px;
        }

        .meta-info {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <!-- Header / Kop Surat -->
    <table class="header-table">
        <tr>
            <td>
                <div class="school-title">{{ $settings['school_name'] ?? 'PROFILE SEKOLAH' }}</div>
                <div class="doc-title">LAPORAN REKAPITULASI PENDAFTARAN PPDB</div>
                <div class="school-info">
                    Alamat: {{ $settings['address'] ?? 'Jl. Pendidikan No. 1' }} | Telp: {{ $settings['contact_number'] ?? '-' }}
                </div>
            </td>
            <td style="text-align: right; width: 220px;">
                <div style="font-size: 9px; color: #64748b;">Tanggal Cetak:</div>
                <div style="font-size: 11px; font-weight: bold; color: #334155;">{{ \Carbon\Carbon::now()->translatedFormat('d F Y - H:i') }} WIB</div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- Summary Stats -->
    <table class="stats-table">
        <tr>
            <td class="stat-card total" style="width: 25%;">
                <div class="stat-val">{{ $registrations->count() }}</div>
                <div class="stat-lbl">Total Pendaftar</div>
            </td>
            <td class="stat-card accepted" style="width: 25%;">
                <div class="stat-val">{{ $registrations->where('status_pendaftaran', 'diterima')->count() }}</div>
                <div class="stat-lbl">Diterima</div>
            </td>
            <td class="stat-card pending" style="width: 25%;">
                <div class="stat-val">{{ $registrations->where('status_pendaftaran', 'pending')->count() }}</div>
                <div class="stat-lbl">Pending</div>
            </td>
            <td class="stat-card rejected" style="width: 25%;">
                <div class="stat-val">{{ $registrations->where('status_pendaftaran', 'ditolak')->count() }}</div>
                <div class="stat-lbl">Ditolak</div>
            </td>
        </tr>
    </table>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25px;" class="center">No</th>
                <th style="width: 130px;">Nama Lengkap</th>
                <th style="width: 75px;">NISN</th>
                <th style="width: 75px;">Tgl Lahir</th>
                <th style="width: 25px;" class="center">JK</th>
                <th style="width: 110px;">Asal Sekolah</th>
                <th style="width: 90px;">Orang Tua</th>
                <th style="width: 85px;">No. HP</th>
                <th style="width: 90px;">Jurusan</th>
                <th style="width: 65px;" class="center">Status</th>
                <th style="width: 75px;">Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $item)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td style="font-weight: bold; color: #0f172a;">{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nisn }}</td>
                <td>{{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                <td class="center">{{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
                <td>{{ $item->asal_sekolah }}</td>
                <td>{{ $item->nama_ortu }}</td>
                <td>{{ $item->no_hp_ortu }}</td>
                <td>{{ $item->jurusan_pilihan }}</td>
                <td class="center">
                    @if($item->status_pendaftaran == 'diterima')
                        <span class="badge badge-diterima">Diterima</span>
                    @elseif($item->status_pendaftaran == 'ditolak')
                        <span class="badge badge-ditolak">Ditolak</span>
                    @else
                        <span class="badge badge-pending">Pending</span>
                    @endif
                </td>
                <td>{{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d/m/Y H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="center" style="padding: 15px; color: #94a3b8;">Tidak ada data pendaftaran yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Signature & Footer -->
    <table class="footer-table">
        <tr>
            <td style="width: 60%;">
                <div class="meta-info">
                    * Dokumen ini secara otomatis dihasilkan oleh Sistem PPDB {{ $settings['school_name'] ?? 'Sekolah' }}.<br>
                    * Laporan ini merupakan bukti cetak sah rekapitulasi data pendaftar.
                </div>
            </td>
            <td style="width: 40%;">
                <div class="signature-box">
                    <div>Panitia PPDB,</div>
                    <div class="signature-space"></div>
                    <div style="font-weight: bold; text-decoration: underline;">(____________________)</div>
                    <div style="font-size: 9px; color: #64748b;">NIP / ID Panitia</div>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
