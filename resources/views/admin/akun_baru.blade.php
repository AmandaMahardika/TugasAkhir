@extends('layouts.app')

@section('title', 'Akun Baru')

@section('content')
    <h1 class="mb-4">Akun Baru</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if($akunBaru->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-user-clock me-1"></i> Tidak ada akun baru yang menunggu perubahan role.
        </div>
    @else
        <div class="table-responsive">
            <table class="table custom-table table-striped table-hover text-center text-capitalize align-middle">
                <thead class="table-primary">
                    <tr>
                        <th><i class="fas fa-user me-1"></i> Nama</th>
                        <th><i class="fas fa-envelope me-1"></i> Email</th>
                        <th><i class="fas fa-user-tag me-1"></i> Role Saat Ini</th>
                        <th><i class="fas fa-edit me-1"></i> Ubah Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($akunBaru as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                <form action="{{ route('admin.ubahRole', $user->id) }}" method="POST" class="d-flex align-items-center justify-content-center gap-2">
                                    @csrf
                                    <select name="role" class="form-select form-select-sm w-auto" required>
                                        <option value="" disabled selected>Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="pengguna">Pengguna</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
