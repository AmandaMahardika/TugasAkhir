<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Laporan</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        select, textarea {
            border-radius: 0.625rem;
        }
    </style>
</head>
<body class="relative bg-gradient-to-br from-sky-200 to-white min-h-screen px-4 py-10 overflow-y-auto overflow-x-hidden">

    <!-- Background Blob SVG -->
    <svg class="blob top-[-100px] left-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#38bdf8" d="M43.6,-62.2C56.2,-55.2,65.9,-42,70.3,-27.4C74.7,-12.9,73.7,3,66.9,15.2C60.1,27.5,47.5,36.1,34.8,45.7C22,55.3,11,65.9,-1.6,68.1C-14.2,70.3,-28.4,64.1,-37.9,54.2C-47.4,44.3,-52.2,30.7,-56.5,17.1C-60.8,3.4,-64.6,-10.1,-60.4,-21.9C-56.3,-33.7,-44.2,-43.9,-31.5,-51.7C-18.7,-59.5,-4.4,-64.9,10.7,-69.2C25.8,-73.4,41.4,-76.2,43.6,-62.2Z" transform="translate(100 100)" />
    </svg>

    <svg class="blob bottom-[-100px] right-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
        <path fill="#0284c7" d="M45.6,-61.2C60.2,-53.2,72.9,-41,74.3,-26.4C75.8,-11.8,66,-5.9,56.9,3.1C47.9,12.2,39.6,24.3,28.9,35.2C18.3,46.1,5.1,55.7,-7.2,61.4C-19.5,67.2,-31.1,69.1,-42.7,63.6C-54.4,58,-66.1,45,-68.5,31.1C-70.9,17.3,-64.1,2.5,-59.6,-11.1C-55,-24.8,-52.6,-37.2,-44.4,-47.4C-36.3,-57.7,-22.5,-65.9,-7.4,-68.2C7.8,-70.5,15.6,-66.9,45.6,-61.2Z" transform="translate(100 100)" />
    </svg>

    <!-- Form Container -->
    <div class="relative z-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl max-w-3xl w-full p-8 fade-up mx-auto">

        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md flex items-center gap-3 font-semibold">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md flex items-center gap-3 font-semibold">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-sky-700 mb-8 text-center flex items-center justify-center gap-3">
            <img src="{{ asset('images/undraw_upload_cucu.svg') }}" alt="Icon" class="w-8 h-8" />
            Tambah Laporan Kerusakan
        </h2>

        <!-- Preview Gambar Lokasi Ruang -->
        <img id="previewGambar" src="" alt="Gambar Lokasi Ruang"
             class="rounded shadow-sm mb-6 w-full max-w-md object-contain mx-auto hidden" />

        <form action="{{ route('laporan.store') }}" method="POST" novalidate>
            @csrf

            <div class="mb-5">
                <label for="lokasi_ruang" class="block mb-2 font-semibold text-sky-600">Lokasi Ruang:</label>
                <select name="lokasi_ruang" id="lokasi_ruang" class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 rounded-lg" required>
                    <option value="" disabled selected>Pilih Lokasi Ruang</option>
                    <option value="lab_aplikasi">Lab Aplikasi</option>
                    <option value="lab_jaringan">Lab Jaringan</option>
                    <option value="lab_multimedia">Lab Multimedia</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="detail1" class="block mb-2 font-semibold text-sky-600">Detail 1:</label>
                <select name="detail1" id="detail1" class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 rounded-lg" required>
                    <option value="" disabled selected>Pilih Detail 1</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="detail2" class="block mb-2 font-semibold text-sky-600">Detail 2:</label>
                <select name="detail2" id="detail2" class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 rounded-lg" required>
                    <option value="" disabled selected>Pilih Detail 2</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="deskripsi_kerusakan" class="block mb-2 font-semibold text-sky-600">Deskripsi Kerusakan:</label>
                <textarea name="deskripsi_kerusakan" id="deskripsi_kerusakan" rows="4"
                          class="w-full border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-sky-400 rounded-lg resize-none"
                          required></textarea>
            </div>

            <div class="flex justify-between gap-4 flex-col sm:flex-row">
                <button type="submit" class="flex items-center justify-center gap-2 bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg transition shadow-md">
                    <i class="fas fa-save"></i> Simpan Laporan
                </button>
                <a href="{{ route('laporan.index') }}" class="flex items-center justify-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-2 px-6 rounded-lg transition shadow-md text-center">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('lokasi_ruang').addEventListener('change', function () {
            var img = document.getElementById('previewGambar');
            var pilihan = this.value;
            var srcMap = {
                'lab_aplikasi': "{{ asset('images/Lab Aplikasi.jpg') }}",
                'lab_jaringan': "{{ asset('images/Lab Jaringan.jpg') }}",
                'lab_multimedia': "{{ asset('images/Lab Multipedia.jpg') }}"
            };
            if (pilihan && srcMap[pilihan]) {
                img.src = srcMap[pilihan];
                img.classList.remove('hidden');
            } else {
                img.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
