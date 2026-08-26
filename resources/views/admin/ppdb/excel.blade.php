<table>
    <!-- Header Title Banner -->
    <thead>
        <tr>
            <th colspan="13" style="font-size: 16pt; font-weight: bold; color: #ffffff; background-color: #1E3A8A; text-align: center; height: 35px; vertical-align: middle;">
                {{ strtoupper($settings['school_name'] ?? 'PROFILE SEKOLAH') }}
            </th>
        </tr>
        <tr>
            <th colspan="13" style="font-size: 12pt; font-weight: bold; color: #ffffff; background-color: #2563EB; text-align: center; height: 25px; vertical-align: middle;">
                LAPORAN REKAPITULASI PENDAFTARAN PESERTA DIDIK BARU (PPDB)
            </th>
        </tr>
        <tr>
            <th colspan="13" style="font-size: 9pt; color: #475569; text-align: center; height: 20px;">
                Alamat: {{ $settings['address'] ?? '-' }} | Telp: {{ $settings['contact_number'] ?? '-' }} | Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y - H:i') }} WIB
            </th>
        </tr>
        <tr></tr>

        <!-- Summary Statistics Row -->
        <tr>
            <th colspan="3" style="background-color: #EFF6FF; border: 1px solid #BFDBFE; font-weight: bold; text-align: center; color: #1E40AF; height: 25px;">
                Total Pendaftar: {{ $registrations->count() }}
            </th>
            <th colspan="3" style="background-color: #F0FDF4; border: 1px solid #BBF7D0; font-weight: bold; text-align: center; color: #166534; height: 25px;">
                Diterima: {{ $registrations->where('status_pendaftaran', 'diterima')->count() }}
            </th>
            <th colspan="3" style="background-color: #FEFCE8; border: 1px solid #FEF08A; font-weight: bold; text-align: center; color: #854D0E; height: 25px;">
                Pending: {{ $registrations->where('status_pendaftaran', 'pending')->count() }}
            </th>
            <th colspan="4" style="background-color: #FEF2F2; border: 1px solid #FECACA; font-weight: bold; text-align: center; color: #991B1B; height: 25px;">
                Ditolak: {{ $registrations->where('status_pendaftaran', 'ditolak')->count() }}
            </th>
        </tr>
        <tr></tr>

        <!-- Table Columns Header -->
        <tr>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center; height: 25px;">No</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Nama Lengkap</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">NISN</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Tempat Lahir</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">Tanggal Lahir</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">JK</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Alamat</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Asal Sekolah</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Nama Orang Tua</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">No HP Orang Tua</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: left;">Jurusan Pilihan</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">Status</th>
            <th style="border: 1px solid #000000; background-color: #0F172A; color: #FFFFFF; font-weight: bold; text-align: center;">Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $index => $item)
        @php
            $bg = $index % 2 == 0 ? '#FFFFFF' : '#F8FAFC';
            $statusBg = '#FEF3C7';
            $statusColor = '#92400E';
            if ($item->status_pendaftaran == 'diterima') {
                $statusBg = '#DCFCE7';
                $statusColor = '#166534';
            } elseif ($item->status_pendaftaran == 'ditolak') {
                $statusBg = '#FEE2E2';
                $statusColor = '#991B1B';
            }
        @endphp
        <tr style="background-color: {{ $bg }};">
            <td style="border: 1px solid #CBD5E1; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #CBD5E1; font-weight: bold; color: #0F172A;">{{ $item->nama_lengkap }}</td>
            <td style="border: 1px solid #CBD5E1; text-align: center; mso-number-format:'\@';">'{{ $item->nisn }}</td>
            <td style="border: 1px solid #CBD5E1;">{{ $item->tempat_lahir }}</td>
            <td style="border: 1px solid #CBD5E1; text-align: center;">{{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d-m-Y') : '-' }}</td>
            <td style="border: 1px solid #CBD5E1; text-align: center;">{{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}</td>
            <td style="border: 1px solid #CBD5E1;">{{ $item->alamat }}</td>
            <td style="border: 1px solid #CBD5E1;">{{ $item->asal_sekolah }}</td>
            <td style="border: 1px solid #CBD5E1;">{{ $item->nama_ortu }}</td>
            <td style="border: 1px solid #CBD5E1; text-align: center; mso-number-format:'\@';">'{{ $item->no_hp_ortu }}</td>
            <td style="border: 1px solid #CBD5E1;">{{ $item->jurusan_pilihan }}</td>
            <td style="border: 1px solid #CBD5E1; text-align: center; background-color: {{ $statusBg }}; color: {{ $statusColor }}; font-weight: bold;">
                {{ strtoupper($item->status_pendaftaran) }}
            </td>
            <td style="border: 1px solid #CBD5E1; text-align: center;">{{ $item->tanggal_daftar ? $item->tanggal_daftar->format('d-m-Y H:i') : '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
