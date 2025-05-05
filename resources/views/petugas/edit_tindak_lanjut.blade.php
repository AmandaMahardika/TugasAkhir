<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Tindak Lanjut</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
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
      opacity: 0.15;
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
  </style>
</head>
<body class="relative bg-gradient-to-br from-orange-100 to-white min-h-screen py-12 px-4 overflow-hidden flex items-center justify-center">

  <!-- SVG Blob Background -->
  <svg class="blob top-[-100px] left-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#f97316" d="M43.6,-62.2C56.2,-55.2,65.9,-42,70.3,-27.4C74.7,-12.9,73.7,3,66.9,15.2C60.1,27.5,47.5,36.1,34.8,45.7C22,55.3,11,65.9,-1.6,68.1C-14.2,70.3,-28.4,64.1,-37.9,54.2C-47.4,44.3,-52.2,30.7,-56.5,17.1C-60.8,3.4,-64.6,-10.1,-60.4,-21.9C-56.3,-33.7,-44.2,-43.9,-31.5,-51.7C-18.7,-59.5,-4.4,-64.9,10.7,-69.2C25.8,-73.4,41.4,-76.2,43.6,-62.2Z" transform="translate(100 100)" />
  </svg>
  <svg class="blob bottom-[-100px] right-[-100px] w-[300px] lg:w-[500px]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#fb923c" d="M45.6,-61.2C60.2,-53.2,72.9,-41,74.3,-26.4C75.8,-11.8,66,-5.9,56.9,3.1C47.9,12.2,39.6,24.3,28.9,35.2C18.3,46.1,5.1,55.7,-7.2,61.4C-19.5,67.2,-31.1,69.1,-42.7,63.6C-54.4,58,-66.1,45,-68.5,31.1C-70.9,17.3,-64.1,2.5,-59.6,-11.1C-55,-24.8,-52.6,-37.2,-44.4,-47.4C-36.3,-57.7,-22.5,-65.9,-7.4,-68.2C7.8,-70.5,15.6,-66.9,45.6,-61.2Z" transform="translate(100 100)" />
  </svg>

  <!-- Kontainer Form -->
  <div class="relative z-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl w-full max-w-2xl mx-auto p-10 fade-up">

    <!-- Header -->
    <div class="flex items-center justify-center mb-8 gap-6">
      <img src="{{ asset('images/logo.png') }}" alt="Edit Icon" class="w-20 h-auto" />
      <h1 class="text-3xl font-semibold text-orange-600">Edit Tindak Lanjut</h1>
    </div>

    <form action="{{ route('tindakLanjut.update', $tindakLanjut->id) }}" method="POST" class="space-y-8">
      @csrf
      @method('PUT')

      <div>
        <label for="penanganan" class="block text-orange-600 font-semibold mb-2">Penanganan:</label>
        <textarea id="penanganan" name="penanganan" rows="4" class="w-full rounded-lg border border-orange-300 px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-400 resize-y">{{ old('penanganan', $tindakLanjut->penanganan) }}</textarea>
        @error('penanganan')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="status" class="block text-orange-600 font-semibold mb-2">Status:</label>
        <select id="status" name="status" class="w-full rounded-lg border border-orange-300 px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-400">
          <option value="diterima" {{ $tindakLanjut->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
          <option value="diproses" {{ $tindakLanjut->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
          <option value="selesai" {{ $tindakLanjut->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        @error('status')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-between gap-4 mt-6">
        <button type="submit" class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-orange-300">
          <i class="fas fa-save"></i> Simpan
        </button>
        <a href="{{ route('petugas.dashboard') }}" class="flex items-center justify-center gap-2 bg-gray-400 hover:bg-gray-600 text-white font-semibold py-3 px-8 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-gray-400">
          <i class="fas fa-arrow-left"></i> Batal
        </a>
      </div>
    </form>

  </div>
</body>
</html>
