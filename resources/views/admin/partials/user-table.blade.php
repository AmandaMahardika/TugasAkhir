<table class="table custom-table table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td class="text-left">{{ $user->name }}</td>
        <td class="text-left">{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td>
          <form action="{{ route('admin.hapusAkun', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash-alt"></i> Hapus
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="5" class="text-center text-muted">Tidak ada akun pada kategori ini.</td>
      </tr>
    @endforelse
  </tbody>
</table>
