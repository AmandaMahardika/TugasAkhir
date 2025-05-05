<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .fa, .fas, .far, .fal, .fab {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }

        .blob {
            position: absolute;
            z-index: 0;
            opacity: 0.2;
        }

        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-spin-slow {
            animation: spin 2.5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="relative bg-gradient-to-br from-orange-100 to-white min-h-screen py-12 px-4">

    <!-- SVG Blob Background -->
    <svg class="blob top-[-100px] left-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#fb923c" d="M43.6,-62.2C56.2,-55.2,65.9,-42,70.3,-27.4C74.7,-12.9,73.7,3,66.9,15.2C60.1,27.5,47.5,36.1,34.8,45.7C22,55.3,11,65.9,-1.6,68.1C-14.2,70.3,-28.4,64.1,-37.9,54.2C-47.4,44.3,-52.2,30.7,-56.5,17.1C-60.8,3.4,-64.6,-10.1,-60.4,-21.9C-56.3,-33.7,-44.2,-43.9,-31.5,-51.7C-18.7,-59.5,-4.4,-64.9,10.7,-69.2C25.8,-73.4,41.4,-76.2,43.6,-62.2Z" transform="translate(100 100)" />
    </svg>

    <svg class="blob bottom-[-100px] right-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#f97316" d="M45.6,-61.2C60.2,-53.2,72.9,-41,74.3,-26.4C75.8,-11.8,66,-5.9,56.9,3.1C47.9,12.2,39.6,24.3,28.9,35.2C18.3,46.1,5.1,55.7,-7.2,61.4C-19.5,67.2,-31.1,69.1,-42.7,63.6C-54.4,58,-66.1,45,-68.5,31.1C-70.9,17.3,-64.1,2.5,-59.6,-11.1C-55,-24.8,-52.6,-37.2,-44.4,-47.4C-36.3,-57.7,-22.5,-65.9,-7.4,-68.2C7.8,-70.5,15.6,-66.9,45.6,-61.2Z" transform="translate(100 100)" />
    </svg>

    <!-- Kontainer Utama -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl max-w-6xl mx-auto p-8 fade-up">

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

        <!-- Ringkasan Box -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 fade-up">
            <div class="bg-white rounded-xl shadow-md text-center py-6 px-4 border border-gray-200">
                <div class="text-3xl font-bold text-orange-500 mb-1">{{ $laporans->count() }}</div>
                <div class="text-gray-600 flex justify-center items-center gap-2">
                    <i class="fas fa-folder-open"></i> Total Laporan
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md text-center py-6 px-4 border border-gray-200">
                <div class="text-3xl font-bold text-green-600 mb-1">{{ $laporans->where('status', 'selesai')->count() }}</div>
                <div class="text-gray-600 flex justify-center items-center gap-2">
                    <i class="fas fa-check-circle"></i> Selesai
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md text-center py-6 px-4 border border-gray-200">
                <div class="text-3xl font-bold text-yellow-500 mb-1">{{ $laporans->where('status', 'diproses')->count() }}</div>
                <div class="text-gray-600 flex justify-center items-center gap-2">
                    <i class="fas fa-spinner animate-spin-slow"></i> Diproses
                </div>
            </div>
        </div>

        <!-- Tombol Tambah -->
        <div class="mb-4">
            <a href="{{ route('laporan.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md inline-flex items-center transition">
                <i class="fas fa-plus mr-2"></i> Tambah Laporan
            </a>
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

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow text-sm">
                <thead class="bg-orange-500 text-white text-center rounded-t-xl">
                    <tr>
                        <th class="py-3 px-4 rounded-tl-xl"><i class="fas fa-user mr-1"></i> Nama</th>
                        <th class="py-3 px-4"><i class="fas fa-location-dot mr-1"></i> Lokasi Ruang</th>
                        <th class="py-3 px-4"><i class="fas fa-info-circle mr-1"></i> Detail</th>
                        <th class="py-3 px-4"><i class="fas fa-tools mr-1"></i> Deskripsi Kerusakan</th>
                        <th class="py-3 px-4"><i class="fas fa-calendar-alt mr-1"></i> Tanggal Lapor</th>
                        <th class="py-3 px-4 rounded-tr-xl"><i class="fas fa-tasks mr-1"></i> Status</th>
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
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-white text-xs font-bold
                                    @if($laporan->status === 'diproses') bg-yellow-500
                                    @elseif($laporan->status === 'selesai') bg-green-600
                                    @elseif($laporan->status === 'ditolak') bg-red-500
                                    @else bg-gray-400 @endif">
                                    @if($laporan->status === 'diproses')
                                        <i class="fas fa-spinner"></i>
                                    @elseif($laporan->status === 'selesai')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($laporan->status === 'ditolak')
                                        <i class="fas fa-times-circle"></i>
                                    @else
                                        <i class="fas fa-hourglass-half"></i>
                                    @endif
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-gray-500 italic text-center">
                                <i class="fas fa-folder-open mr-2"></i> Belum ada laporan yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
