<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
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
            primary: '#38bdf8',
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
<body class="relative bg-gray-50 min-h-screen flex items-center justify-center px-4 py-8">

  <!-- Background SVG Wave -->
  <div class="absolute inset-0 -z-10 overflow-hidden">
    <svg class="w-screen h-screen" preserveAspectRatio="none" viewBox="0 0 1440 600" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill="#a2d2ff" fill-opacity="1"
        d="M0,128L80,138.7C160,149,320,171,480,160C640,149,800,107,960,122.7C1120,139,1280,213,1360,250.7L1440,288L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
      </path>
    </svg>
  </div>

  <!-- Login Card -->
  <div class="glass-card max-w-4xl w-full rounded-3xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 p-8 shadow-xl z-10 fade-in-up">

    <!-- Ilustrasi -->
    <div class="hidden lg:flex items-center justify-center p-4 fade-in-up-slow">
      <img src="{{ asset('images/undraw_login_weas.svg') }}" alt="Login Illustration" class="max-h-[400px] object-contain">
    </div>

    <!-- Form -->
    <div class="p-6 flex flex-col justify-center">
      <h2 class="text-3xl font-bold text-primary mb-1">Selamat Datang</h2>
      <p class="text-gray-600 text-sm mb-6">Masukkan email dan password untuk masuk.</p>

      @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm text-center font-semibold">
          {{ $errors->first('login') ?? $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Email -->
        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-mail" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2" /><path d="m22 6-10 7L2 6" /></svg>
          <input type="email" name="email" required placeholder="Email"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-primary focus:outline-none">
        </div>

        <!-- Password -->
        <div class="icon-input">
          <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-lock" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input type="password" name="password" required placeholder="Password"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-primary focus:outline-none">
        </div>

        <!-- Tombol -->
        <div>
          <button type="submit"
                  class="w-full bg-primary hover:bg-sky-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            Login
          </button>
        </div>
      </form>

      <p class="mt-4 text-sm text-gray-600 text-center">
        Belum punya akun? <a href="{{ route('register') }}" class="text-primary hover:underline">Daftar sekarang</a>
      </p>
    </div>
  </div>

</body>
</html>
