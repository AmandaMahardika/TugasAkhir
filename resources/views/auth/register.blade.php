<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            poppins: ['Poppins', 'sans-serif']
          },
          colors: {
            primary: '#fb923c',
          }
        }
      }
    }
  </script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(20px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .icon-input {
      position: relative;
    }
    .icon-input svg {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      color: #9ca3af;
    }
    .icon-input input {
      padding-left: 2.5rem;
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .fade-in-up {
      opacity: 0;
      animation: fadeInUp 0.9s ease-out forwards;
      animation-delay: 0.3s;
    }
    .fade-in-up-slow {
      opacity: 0;
      animation: fadeInUp 1.2s ease-out forwards;
      animation-delay: 0.6s;
    }
  </style>
</head>
<body class="relative bg-orange-50 min-h-screen flex items-center justify-center px-4 py-8">

  <!-- SVG Blob Background -->
  <svg class="absolute -top-32 -left-32 w-[300px] lg:w-[500px] -z-10 opacity-20" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#fb923c" d="M43.6,-62.2C56.2,-55.2,65.9,-42,70.3,-27.4C74.7,-12.9,73.7,3,66.9,15.2C60.1,27.5,47.5,36.1,34.8,45.7C22,55.3,11,65.9,-1.6,68.1C-14.2,70.3,-28.4,64.1,-37.9,54.2C-47.4,44.3,-52.2,30.7,-56.5,17.1C-60.8,3.4,-64.6,-10.1,-60.4,-21.9C-56.3,-33.7,-44.2,-43.9,-31.5,-51.7C-18.7,-59.5,-4.4,-64.9,10.7,-69.2C25.8,-73.4,41.4,-76.2,43.6,-62.2Z" transform="translate(100 100)" />
  </svg>

  <svg class="absolute bottom-[-150px] right-[-100px] w-[300px] lg:w-[500px] -z-10 opacity-20" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
    <path fill="#f97316" d="M45.6,-61.2C60.2,-53.2,72.9,-41,74.3,-26.4C75.8,-11.8,66,-5.9,56.9,3.1C47.9,12.2,39.6,24.3,28.9,35.2C18.3,46.1,5.1,55.7,-7.2,61.4C-19.5,67.2,-31.1,69.1,-42.7,63.6C-54.4,58,-66.1,45,-68.5,31.1C-70.9,17.3,-64.1,2.5,-59.6,-11.1C-55,-24.8,-52.6,-37.2,-44.4,-47.4C-36.3,-57.7,-22.5,-65.9,-7.4,-68.2C7.8,-70.5,15.6,-66.9,45.6,-61.2Z" transform="translate(100 100)" />
  </svg>

  <!-- Register Card -->
  <div class="glass-card max-w-4xl w-full rounded-3xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 p-8 shadow-xl z-10 fade-in-up">

    <!-- Ilustrasi -->
    <div class="hidden lg:flex items-center justify-center p-4 fade-in-up-slow">
      <img src="{{ asset('images/undraw_email-consent_j36b.svg') }}" alt="Register Illustration" class="max-h-[400px] object-contain">
    </div>

    <!-- Form Register -->
    <div class="p-6 flex flex-col justify-center">
      <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14">
      </div>

      <h2 class="text-3xl font-bold text-orange-600 mb-1 text-center">Buat Akun</h2>
      <p class="text-gray-600 text-sm mb-6 text-center">Isi data di bawah untuk membuat akun barumu.</p>

      @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm text-center font-semibold">
          {{ $errors->first('register') ?? $errors->first() }}
        </div>
      @endif

      <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-user" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-3-3.87"/><path d="M4 21v-2a4 4 0 0 1 3-3.87"/><circle cx="12" cy="7" r="4"/></svg>
          <input type="text" name="name" required placeholder="Nama lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-orange-400 focus:outline-none">
        </div>

        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-mail" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 6-10 7L2 6" /></svg>
          <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-orange-400 focus:outline-none">
        </div>

        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-lock" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" name="password" required placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-orange-400 focus:outline-none">
        </div>

        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-lock-keyhole" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="15" r="1"/><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" name="password_confirmation" required placeholder="Ulangi password" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-orange-400 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
          Daftar
        </button>
      </form>

      <p class="mt-4 text-sm text-gray-600 text-center">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-orange-500 hover:underline">Login di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
