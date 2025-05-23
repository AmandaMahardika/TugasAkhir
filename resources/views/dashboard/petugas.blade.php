<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .blob { position: absolute; z-index: 0; opacity: 0.15; }
        .fade-up { opacity: 0; transform: translateY(30px); animation: fadeInUp 1s ease-out forwards; }
        @keyframes fadeInUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="relative bg-orange-50 bg-gradient-to-br from-orange-100 to-white min-h-screen py-12 px-4">

    <!-- SVG Blob Background -->
    <svg class="blob top-[-100px] left-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#f97316" d="M43.6,-62.2C56.2,-55.2,65.9,-42,70.3,-27.4C74.7,-12.9,73.7,3,66.9,15.2C60.1,27.5,47.5,36.1,34.8,45.7C22,55.3,11,65.9,-1.6,68.1C-14.2,70.3,-28.4,64.1,-37.9,54.2C-47.4,44.3,-52.2,30.7,-56.5,17.1C-60.8,3.4,-64.6,-10.1,-60.4,-21.9C-56.3,-33.7,-44.2,-43.9,-31.5,-51.7C-18.7,-59.5,-4.4,-64.9,10.7,-69.2C25.8,-73.4,41.4,-76.2,43.6,-62.2Z" transform="translate(100 100)" />
    </svg>
    <svg class="blob bottom-[-100px] right-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#fb923c" d="M45.6,-61.2C60.2,-53.2,72.9,-41,74.3,-26.4C75.8,-11.8,66,-5.9,56.9,3.1C47.9,12.2,39.6,24.3,28.9,35.2C18.3,46.1,5.1,55.7,-7.2,61.4C-19.5,67.2,-31.1,69.1,-42.7,63.6C-54.4,58,-66.1,45,-68.5,31.1C-70.9,17.3,-64.1,2.5,-59.6,-11.1C-55,-24.8,-52.6,-37.2,-44.4,-47.4C-36.3,-57.7,-22.5,-65.9,-7.4,-68.2C7.8,-70.5,15.6,-66.9,45.6,-61.2Z" transform="translate(100 100)" />
    </svg>

    <div class="relative z-10 bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl max-w-6xl mx-auto p-8 fade-up">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Icon" class="w-20 h-auto">
                <h1 class="text-2xl font-semibold text-orange-600">
                    Selamat Datang, <span class="text-orange-500">{{ auth()->user()->name }}</span>!
                </h1>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-lg transition">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md flex items-center gap-3">
                <i class="fas fa-exclamation-triangle text-xl"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Laporan Masuk -->
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Laporan Masuk</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow text-sm">
                <thead class="bg-orange-500 text-white text-center rounded-t-xl">
                    <tr>
                        <th class="py-3 px-4 rounded-tl-xl"><i class="fas fa-user mr-1"></i> Nama</th>
                        <th class="py-3 px-4"><i class="fas fa-location-dot mr-1"></i> Lokasi Ruang</th>
                        <th class="py-3 px-4"><i class="fas fa-info-circle mr-1"></i> Detail</th>
                        <th class="py-3 px-4"><i class="fas fa-tools mr-1"></i> Deskripsi Kerusakan</th>
                        <th class="py-3 px-4"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lapor</th>
                        <th class="py-3 px-4"><i class="fas fa-check mr-1"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($laporans as $laporan)
                        <tr class="hover:bg-orange-50 transition">
                            <td class="py-3 px-4 capitalize">{{ $laporan->nama }}</td>
                            <td class="py-3 px-4 capitalize">{{ str_replace('_', ' ', $laporan->lokasi_ruang) }}</td>
                            <td class="py-3 px-4 capitalize">{{ $laporan->detail1 }}, {{ $laporan->detail2 }}</td>
                            <td class="py-3 px-4 capitalize">{{ $laporan->deskripsi_kerusakan }}</td>
                            <td class="py-3 px-4">{{ $laporan->created_at->format('d M Y, H:i') }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('terimaLaporan', $laporan->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <i class="fas fa-check mr-2"></i>Terima
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-gray-500 italic text-center">
                                <i class="fas fa-folder-open mr-2"></i> Tidak ada laporan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Tabel Tindak Lanjut -->
<h2 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Tindak Lanjuti</h2>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded-xl shadow text-sm">
        <thead class="bg-orange-500 text-white text-center rounded-t-xl">
            <tr>
                <th class="py-3 px-4 rounded-tl-xl"><i class="fas fa-user mr-1"></i> Nama</th>
                <th class="py-3 px-4"><i class="fas fa-location-dot mr-1"></i> Lokasi Ruang</th>
                <th class="py-3 px-4"><i class="fas fa-info-circle mr-1"></i> Detail</th>
                <th class="py-3 px-4"><i class="fas fa-tools mr-1"></i> Deskripsi Kerusakan</th>
                <th class="py-3 px-4"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lapor</th>
                <th class="py-3 px-4"><i class="fas fa-calendar-check mr-1"></i> Tanggal Tindak Lanjut</th>
                <th class="py-3 px-4"><i class="fas fa-wrench mr-1"></i> Penanganan</th>
                <th class="py-3 px-4"><i class="fas fa-tasks mr-1"></i> Status</th>
                <th class="py-3 px-4 rounded-tr-xl"><i class="fas fa-edit mr-1"></i> Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse($tindakLanjut as $tindak)
                <tr class="hover:bg-orange-50 transition">
                    <td class="py-3 px-4 capitalize">{{ $tindak->laporan->nama }}</td>
                    <td class="py-3 px-4 capitalize">{{ str_replace('_', ' ', $tindak->laporan->lokasi_ruang) }}</td>
                    <td class="py-3 px-4 capitalize">{{ $tindak->laporan->detail1 }}, {{ $tindak->laporan->detail2 }}</td>
                    <td class="py-3 px-4 capitalize">{{ $tindak->laporan->deskripsi_kerusakan }}</td>
                    <td class="py-3 px-4">{{ $tindak->laporan->created_at->format('d M Y, H:i') }}</td>
                    <td class="py-3 px-4">
                        {{ $tindak->created_at != $tindak->updated_at ? $tindak->updated_at->format('d M Y, H:i') : '' }}
                    </td>
                    <td class="py-3 px-4 capitalize">
                        {{ $tindak->penanganan ?: '' }}
                    </td>
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-xs font-bold
                            @if(strtolower($tindak->status) == 'pending') bg-yellow-500
                            @elseif(strtolower($tindak->status) == 'selesai') bg-green-600
                            @elseif(strtolower($tindak->status) == 'ditolak') bg-red-500
                            @else bg-gray-400 @endif">
                            @if(strtolower($tindak->status) == 'pending')
                                <i class="fas fa-hourglass-half"></i>
                            @elseif(strtolower($tindak->status) == 'selesai')
                                <i class="fas fa-check-circle"></i>
                            @elseif(strtolower($tindak->status) == 'ditolak')
                                <i class="fas fa-times-circle"></i>
                            @else
                                <i class="fas fa-question-circle"></i>
                            @endif
                            {{ ucfirst($tindak->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('tindakLanjut.edit', $tindak->id) }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="py-4 text-gray-500 italic text-center">
                        <i class="fas fa-folder-open mr-2"></i> Tidak ada tindak lanjut.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
