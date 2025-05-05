@extends('layouts.app')

@section('title', 'Laporan Selesai')

@section('content')
    <h1 class="mb-4">Laporan Selesai</h1>

    <!-- Filter Section -->
    <div class="d-flex flex-wrap align-items-center mb-4">
        <div class="me-3 mb-2">
            <label for="tanggal_awal" class="form-label mb-1">Tanggal Awal:</label>
            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ $tanggal_awal }}">
        </div>
        <div class="me-3 mb-2">
            <label for="tanggal_akhir" class="form-label mb-1">Tanggal Akhir:</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ $tanggal_akhir }}">
        </div>
        <div class="mb-2">
            <button onclick="filterTanggal()" class="btn btn-primary mt-4">Filter</button>
        </div>
        <div class="mb-2 ms-auto">
            <a href="{{ route('admin.exportPdf', ['tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]) }}" class="btn btn-success mt-4">
                <i class="fas fa-file-pdf"></i> Unduh PDF
            </a>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table custom-table table-striped table-hover text-center text-capitalize align-middle">
            <thead class="table-success">
                <tr>
                    <th><i class="fas fa-user me-1"></i> Nama Pelapor</th>
                    <th><i class="fas fa-location-dot me-1"></i> Lokasi Ruang</th>
                    <th><i class="fas fa-info-circle me-1"></i> Detail 1</th>
                    <th><i class="fas fa-info-circle me-1"></i> Detail 2</th>
                    <th><i class="fas fa-tools me-1"></i> Deskripsi Kerusakan</th>
                    <th><i class="fas fa-wrench me-1"></i> Penanganan</th>
                    <th><i class="fas fa-calendar-alt me-1"></i> Tanggal Dikirim</th>
                    <th><i class="fas fa-check-circle me-1"></i> Status</th>
                    <th><i class="fas fa-user-cog me-1"></i> Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporanSelesai as $laporan)
                    <tr>
                        <td>{{ $laporan->laporan->nama }}</td>
                        <td>{{ str_replace('_', ' ', $laporan->laporan->lokasi_ruang) }}</td>
                        <td>{{ $laporan->laporan->detail1 }}</td>
                        <td>{{ $laporan->laporan->detail2 }}</td>
                        <td class="text-wrap">{{ $laporan->laporan->deskripsi_kerusakan }}</td>
                        <td class="text-wrap">{{ $laporan->penanganan }}</td>
                        <td>{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <span class="badge bg-success">{{ ucfirst($laporan->status) }}</span>
                        </td>
                        <td>{{ $laporan->petugas->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            <i class="fas fa-folder-open me-1"></i> Tidak ada laporan selesai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @push('scripts')
    <script>
        function filterTanggal() {
            const awal = document.getElementById('tanggal_awal').value;
            const akhir = document.getElementById('tanggal_akhir').value;
            if (awal && akhir) {
                window.location.href = `?tanggal_awal=${awal}&tanggal_akhir=${akhir}`;
            }
        }
    </script>
    @endpush
@endsection
