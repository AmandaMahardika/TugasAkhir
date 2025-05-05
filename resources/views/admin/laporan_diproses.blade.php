@extends('layouts.app')

@section('title', 'Laporan Masuk')

@section('content')
    <h1 class="mb-4">Laporan Masuk</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table custom-table table-striped table-hover align-middle text-center text-capitalize">
            <thead class="table-primary">
                <tr>
                    <th><i class="fas fa-user me-1"></i> Nama Pelapor</th>
                    <th><i class="fas fa-location-dot me-1"></i> Lokasi Ruang</th>
                    <th><i class="fas fa-info-circle me-1"></i> Detail 1</th>
                    <th><i class="fas fa-info-circle me-1"></i> Detail 2</th>
                    <th><i class="fas fa-tools me-1"></i> Deskripsi Kerusakan</th>
                    <th><i class="fas fa-tasks me-1"></i> Status</th>
                    <th><i class="fas fa-wrench me-1"></i> Penanganan Terakhir</th>
                    <th><i class="fas fa-cog me-1"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporanDiproses as $laporan)
                    <tr>
                        <td>{{ $laporan->nama }}</td>
                        <td>{{ str_replace('_', ' ', $laporan->lokasi_ruang) }}</td>
                        <td>{{ $laporan->detail1 }}</td>
                        <td>{{ $laporan->detail2 }}</td>
                        <td class="text-wrap">{{ $laporan->deskripsi_kerusakan }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ ucfirst($laporan->status) }}</span>
                        </td>
                        <td class="text-wrap">
                            @if($laporan->tindakLanjutTerakhir)
                                {{ $laporan->tindakLanjutTerakhir->penanganan }}
                            @else
                                Belum Ada Penanganan
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.laporanSelesai', $laporan->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            <i class="fas fa-folder-open me-1"></i> Tidak ada laporan yang sedang diproses.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
