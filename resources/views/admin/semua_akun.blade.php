@extends('layouts.app')

@section('title', 'Semua Akun')

@section('content')
    <h1 class="mb-4">Semua Akun</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- Tab Navs -->
    <ul class="nav nav-tabs mb-3" id="roleTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">
                <i class="fas fa-user-shield me-1"></i> Admin
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="petugas-tab" data-bs-toggle="tab" data-bs-target="#petugas" type="button" role="tab" aria-controls="petugas" aria-selected="false">
                <i class="fas fa-user-cog me-1"></i> Petugas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pengguna-tab" data-bs-toggle="tab" data-bs-target="#pengguna" type="button" role="tab" aria-controls="pengguna" aria-selected="false">
                <i class="fas fa-users me-1"></i> Pengguna
            </button>
        </li>
    </ul>

    <div class="tab-content" id="roleTabsContent">
        <!-- Admin Tab -->
        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
            <div class="table-responsive">
                <table class="table custom-table table-striped table-hover text-center text-capitalize align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="fas fa-user me-1"></i> Nama</th>
                            <th><i class="fas fa-envelope me-1"></i> Email</th>
                            <th><i class="fas fa-user-tag me-1"></i> Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Petugas Tab -->
        <div class="tab-pane fade" id="petugas" role="tabpanel" aria-labelledby="petugas-tab">
            <div class="table-responsive">
                <table class="table custom-table table-striped table-hover text-center text-capitalize align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="fas fa-user me-1"></i> Nama</th>
                            <th><i class="fas fa-envelope me-1"></i> Email</th>
                            <th><i class="fas fa-user-tag me-1"></i> Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($petugas as $petugas)
                            <tr>
                                <td>{{ $petugas->name }}</td>
                                <td>{{ $petugas->email }}</td>
                                <td>{{ $petugas->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengguna Tab -->
        <div class="tab-pane fade" id="pengguna" role="tabpanel" aria-labelledby="pengguna-tab">
            <div class="table-responsive">
                <table class="table custom-table table-striped table-hover text-center text-capitalize align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th><i class="fas fa-user me-1"></i> Nama</th>
                            <th><i class="fas fa-envelope me-1"></i> Email</th>
                            <th><i class="fas fa-user-tag me-1"></i> Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengguna as $pengguna)
                            <tr>
                                <td>{{ $pengguna->name }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td>{{ $pengguna->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
