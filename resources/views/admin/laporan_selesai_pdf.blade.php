<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Selesai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px 30px;
            color: #000;
        }

        h1 {
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
            text-align: left;
        }

        .filter-info {
            font-style: italic;
            margin-bottom: 15px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Kurangi jarak ke footer */
            page-break-inside: auto;
        }

        thead {
            background-color: #ddd;
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            font-weight: bold;
        }

        td.status {
            text-transform: capitalize;
            font-weight: 600;
            color: #2e7d32;
        }

        .footer {
            width: 100%;
            margin-top: 10px; /* Jarak lebih rapat ke tabel */
            text-align: right; /* Footer rata kanan */
            font-size: 12px;
            line-height: 1.6;
        }

        .footer .date {
            margin-bottom: 40px; /* Ruang tanda tangan */
        }

        /* Hindari pemotongan tabel di halaman PDF */
        @media print {
            body {
                margin: 10mm 10mm 10mm 10mm;
            }
        }
    </style>
</head>

<body>
    <h1>Laporan Selesai</h1>

    <div class="filter-info">
        @if($tanggal_awal)
            <div>Tanggal Awal: {{ \Carbon\Carbon::parse($tanggal_awal)->format('d M Y') }}</div>
        @endif
        @if($tanggal_akhir)
            <div>Tanggal Akhir: {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d M Y') }}</div>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Pelapor</th>
                <th>Lokasi Ruang</th>
                <th>Detail 1</th>
                <th>Detail 2</th>
                <th>Deskripsi Kerusakan</th>
                <th>Penanganan</th>
                <th>Tanggal Dikirim</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporanSelesai as $laporan)
                <tr>
                    <td>{{ $laporan->laporan->nama }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $laporan->laporan->lokasi_ruang)) }}</td>
                    <td>{{ $laporan->laporan->detail1 }}</td>
                    <td>{{ $laporan->laporan->detail2 }}</td>
                    <td>{{ $laporan->laporan->deskripsi_kerusakan }}</td>
                    <td>{{ $laporan->penanganan }}</td>
                    <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                    <td class="status">{{ ucfirst($laporan->status) }}</td>
                    <td>{{ $laporan->petugas->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; font-style: italic; color: #888;">Tidak ada laporan selesai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="date">Malang, {{ date('d/m/Y') }}</div>
        <div>{{ Auth::user()->name }}</div>
    </div>
</body>

</html>
