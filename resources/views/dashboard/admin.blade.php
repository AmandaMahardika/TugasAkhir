@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="page-header">
  <h1>Dashboard Admin</h1>
</div>

<div class="welcome-panel" id="greetingBox">
  <h3 id="greetingText">Selamat Datang, {{ Auth::user()->name }}!</h3>
  <p>Kelola laporan, akun, dan pantau aktivitas di sini.</p>
  <img id="greetingImage" src="{{ asset('images/undraw_mornings_kmib.svg') }}" alt="Dashboard Illustration" style="max-width: 300px; margin: 20px auto 0;">
</div>

<div class="cards">
  <div class="card-stats">
    <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
    <div class="number">{{ $jumlahLaporanMasuk }}</div>
    <div class="label">Laporan Masuk</div>
  </div>

  <div class="card-stats">
    <div class="icon"><i class="fas fa-check-circle"></i></div>
    <div class="number">{{ $jumlahLaporanSelesai }}</div>
    <div class="label">Laporan Selesai</div>
  </div>

  <div class="card-stats">
    <div class="icon"><i class="fas fa-user-plus"></i></div>
    <div class="number">{{ $jumlahAkunBaru }}</div>
    <div class="label">Akun Baru</div>
  </div>

  <div class="card-stats">
    <div class="icon"><i class="fas fa-users"></i></div>
    <div class="number">{{ $jumlahSemuaAkun }}</div>
    <div class="label">Total Akun</div>
  </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    margin-bottom: 20px;
    text-align: center;
}
.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
}

.welcome-panel {
    background: #e0f7fa;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(52, 152, 219, 0.3);
    margin-bottom: 30px;
    text-align: center;
}
.welcome-panel h3 {
    font-weight: 700;
    font-size: 1.8rem;
}
.cards {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
}
.card-stats {
    flex: 1 1 220px;
    background: #f0f8ff;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
    padding: 20px 30px;
    text-align: center;
    transition: all 0.3s ease;
}
.card-stats:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px rgba(52, 152, 219, 0.25);
}
.card-stats .icon {
    font-size: 2.8rem;
    margin-bottom: 15px;
    color: #3498db;
}
.card-stats .number {
    font-size: 2.2rem;
    font-weight: 700;
}
.card-stats .label {
    font-weight: 600;
    font-size: 1.1rem;
    color: #217dbb;
}
</style>
@endpush

@push('scripts')
<script>
function updateGreeting() {
    const now = new Date();
    const hour = now.getHours();
    let greeting = "Selamat Datang";
    let image = "undraw_mornings_kmib.svg";

    if (hour >= 5 && hour < 12) {
        greeting = "Selamat Pagi";
        image = "undraw_mornings_kmib.svg";
    } else if (hour >= 12 && hour < 17) {
        greeting = "Selamat Siang";
        image = "undraw_pancakes_5hix.svg";
    } else {
        greeting = "Selamat Malam";
        image = "undraw_late-at-night_0fob.svg";
    }

    document.getElementById('greetingText').innerHTML = `${greeting}, {{ Auth::user()->name }}!`;
    document.getElementById('greetingImage').src = `{{ asset('images') }}/${image}`;
}

// Update saat page load
updateGreeting();

// Optional: kalau mau auto update terus tiap 1 menit
setInterval(updateGreeting, 60000);
</script>
@endpush
