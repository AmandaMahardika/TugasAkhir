@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="dashboard-container">
  <div class="page-header">
    <h1>Dashboard Admin</h1>
  </div>

  <div class="welcome-panel" id="greetingBox">
    <h3 id="greetingText">Selamat Datang, {{ Auth::user()->name }}!</h3>
    <p>Kelola laporan, akun, dan pantau aktivitas di sini.</p>
    <img id="greetingImage" src="{{ asset('images/undraw_mornings_kmib.svg') }}" alt="Dashboard Illustration" class="greeting-img">
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
</div>
@endsection

@push('styles')
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  overflow-x: hidden;
}

.dashboard-container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 0 20px 40px;
}

.page-header h1 {
  font-size: 2.5rem;
  font-weight: 700;
  color: #4a2c00;
  margin-bottom: 20px;
  text-align: center;
}

.welcome-panel {
  background: rgba(253, 186, 116, 0.2);
  padding: 25px 30px;
  border-radius: 15px;
  box-shadow: 0 6px 15px rgba(253, 186, 116, 0.3);
  margin-bottom: 30px;
  text-align: center;
  color: #4a2c00;
}

.welcome-panel h3 {
  font-weight: 700;
  font-size: 1.8rem;
  margin-bottom: 10px;
}

.greeting-img {
  max-width: 300px;
  margin-top: 20px;
}

.cards {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: space-between;
}

.card-stats {
  flex: 1 1 calc(25% - 15px);
  background: #ffedd5;
  border-radius: 15px;
  box-shadow: 0 4px 12px rgba(253, 186, 116, 0.3);
  padding: 20px 15px;
  text-align: center;
  transition: all 0.3s ease;
  min-width: 0;
}

.card-stats:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 18px rgba(253, 186, 116, 0.4);
}

.card-stats .icon {
  font-size: 2.8rem;
  margin-bottom: 15px;
  color: #fb923c;
}

.card-stats .number {
  font-size: 2.2rem;
  font-weight: 700;
  color: #4a2c00;
}

.card-stats .label {
  font-weight: 600;
  font-size: 1.1rem;
  color: #4a2c00;
}

/* Responsive Layout */
@media (max-width: 1024px) {
  .card-stats {
    flex: 1 1 calc(50% - 10px);
  }
}
@media (max-width: 600px) {
  .card-stats {
    flex: 1 1 100%;
  }
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

updateGreeting();
setInterval(updateGreeting, 60000);
</script>
@endpush
