<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Panel')</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  
  <!-- Custom Styles -->
  <style>
    body, html {
      margin: 0; padding: 0; height: 100%;
      font-family: 'Poppins', sans-serif;
      background: #fff7ed;
      position: relative;
    }

    .blob-bg {
      position: absolute;
      top: -120px;
      right: -120px;
      width: 450px;
      height: 450px;
      background: #fdba74;
      border-radius: 50%;
      opacity: 0.25;
      z-index: 0;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(20px); }
    }

    #sidebar {
      background-color: #fdba74;
      min-height: 100vh;
      padding-top: 0;
      position: fixed;
      width: 250px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
      z-index: 2;
    }

    #sidebar .brand-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 30px 20px 25px 20px;
      margin-bottom: 10px;
    }

    #sidebar .brand-header img {
      height: 55px;
    }

    #sidebar .brand-header span {
      font-size: 1.4rem;
      font-weight: 700;
      color: #4a2c00;
    }

    #sidebar .nav-link {
      color: #4a2c00;
      padding: 12px 20px;
      font-weight: 600;
      border-radius: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: 0.3s ease;
      text-decoration: none;
    }

    #sidebar .nav-link:hover, #sidebar .nav-link.active {
      background-color: #fb923c;
      color: white;
    }

    #sidebar .nav-link.logout-link {
      color: #e74c3c;
      margin-top: auto;
    }

    #sidebar .nav-link.logout-link:hover {
      background-color: #c0392b;
      color: white;
    }

    main {
      margin-left: 250px;
      padding: 2.5rem 3rem;
      background: transparent;
      position: relative;
      z-index: 1;
    }

    main h1 {
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
      color: #9a3412;
    }

    .custom-table {
      background: white;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(252, 146, 53, 0.2);
      overflow: hidden;
    }

    .custom-table thead th {
      background-color: #fb923c;
      color: white;
      font-weight: 700;
      text-align: center;
      vertical-align: middle;
      padding: 14px 12px;
    }

    .custom-table tbody td {
      vertical-align: middle;
      padding: 14px 12px;
      text-align: center;
      border-bottom: 1px solid #ffe8d0;
    }

    .custom-table tbody td.text-left {
      text-align: left;
    }

    .custom-table tbody tr:hover {
      background-color: #fff0e0;
      cursor: pointer;
    }

    .badge-status {
      padding: 0.4em 0.8em;
      font-size: 0.85rem;
      font-weight: 600;
      border-radius: 12px;
      background-color: #fb923c;
      color: white;
      text-transform: capitalize;
    }

    .btn-primary {
      background-color: #fb923c;
      border-color: #fb923c;
      font-weight: 600;
      border-radius: 8px;
      padding: 6px 14px;
      transition: 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #ea580c;
      border-color: #ea580c;
      color: white;
    }

    .table-responsive {
      overflow-x: auto;
    }

    @media (max-width: 992px) {
      main {
        margin-left: 0;
        padding: 2rem 1.5rem;
      }

      #sidebar {
        position: fixed;
        width: 100%;
        height: 60px;
        bottom: 0;
        top: auto;
        padding: 0;
        display: flex;
        justify-content: space-around;
        border-radius: 0;
        z-index: 1030;
      }

      #sidebar .brand-header {
        display: none;
      }

      #sidebar .nav-link {
        flex-grow: 1;
        padding: 10px 0;
        font-size: 0.9rem;
        justify-content: center;
      }

      #sidebar .nav-link span {
        display: none;
      }
    }

    @media (max-width: 576px) {
      .custom-table {
        font-size: 0.9rem;
      }
    }
  </style>

  @stack('styles')
</head>

<body>
  <div class="blob-bg"></div>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="d-flex flex-column">
        <!-- Brand Header -->
        <div class="brand-header">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" />
          <span>Lab Komputer</span>
        </div>

        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
        </a>
        <a class="nav-link" href="{{ route('admin.laporanDiproses') }}">
          <i class="fas fa-exclamation-triangle"></i><span>Laporan Masuk</span>
        </a>
        <a class="nav-link" href="{{ route('admin.laporanSelesai') }}">
          <i class="fas fa-check-circle"></i><span>Laporan Selesai</span>
        </a>
        <a class="nav-link" href="{{ route('admin.akunBaru') }}">
          <i class="fas fa-user-plus"></i><span>Akun Baru</span>
        </a>
        <a class="nav-link" href="{{ route('admin.semuaAkun') }}">
          <i class="fas fa-users"></i><span>Semua Akun</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a class="nav-link logout-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i><span>Logout</span>
        </a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('content')
      </main>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')
</body>
</html>
