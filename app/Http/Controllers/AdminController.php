<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TindakLanjut;
use App\Models\User;
use App\Models\LaporanSelesai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Hitung jumlah laporan
        $jumlahLaporanMasuk = Laporan::where('status', 'diproses')->count();
        $jumlahLaporanSelesai = LaporanSelesai::count();

        // Hitung jumlah akun
        $jumlahAkunBaru = User::whereNull('role_updated_at')
                       ->where('created_at', '>=', now()->subDays(7))
                       ->count();

        // Hitung total semua akun (tefrmasuk admin, petugas, dan pengguna)
        $jumlahSemuaAkun = User::count();

        // Data laporan (opsional, jika ingin ditampilkan di dashboard)
        $laporans = Laporan::whereIn('status', ['diterima', 'diproses', 'selesai'])->get();

        // Kirim data ke view
        return view('dashboard.admin', compact(
            'laporans',
            'jumlahLaporanMasuk',
            'jumlahLaporanSelesai',
            'jumlahAkunBaru',
            'jumlahSemuaAkun'
        ));
    }

    public function laporanDiproses()
    {
        $laporanDiproses = Laporan::where('status', 'diproses')
            ->with('tindakLanjutTerakhir')
            ->get();

        return view('admin.laporan_diproses', compact('laporanDiproses'));
    }

    public function laporanSelesai(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $laporanSelesai = LaporanSelesai::with('laporan', 'petugas')
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('created_at', $tahun);
            })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('created_at', $bulan);
            })
            ->when($tanggal_awal, function ($query, $tanggal_awal) use ($tanggal_akhir) {
                try {
                    $query->whereDate('created_at', '>=', Carbon::parse($tanggal_awal));
                    if ($tanggal_akhir) {
                        $query->whereDate('created_at', '<=', Carbon::parse($tanggal_akhir));
                    }
                } catch (\Exception $e) {
                    // Tangani jika format tanggal salah
                    return $query; // Abaikan filter jika tanggal tidak valid
                }
                return $query;
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan_selesai', compact('laporanSelesai', 'tahun', 'bulan', 'tanggal_awal', 'tanggal_akhir'));
    }

    public function exportPdf(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $tanggal_awal = $request->input('tanggal_awal');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $laporanSelesai = LaporanSelesai::with('laporan', 'petugas')
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('created_at', $tahun);
            })
            ->when($bulan, function ($query, $bulan) {
                return $query->whereMonth('created_at', $bulan);
            })
            ->when($tanggal_awal, function ($query, $tanggal_awal) use ($tanggal_akhir) {
                try {
                    $query->whereDate('created_at', '>=', Carbon::parse($tanggal_awal));
                    if ($tanggal_akhir) {
                        $query->whereDate('created_at', '<=', Carbon::parse($tanggal_akhir));
                    }
                } catch (\Exception $e) {
                    // Tangani jika format tanggal salah
                    return $query; // Abaikan filter jika tanggal tidak valid
                }
                return $query;
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('admin.laporan_selesai_pdf', compact('laporanSelesai', 'tahun', 'bulan', 'tanggal_awal', 'tanggal_akhir'));

        return $pdf->download('laporan_selesai_' . Carbon::now()->toDateString() . '.pdf');
    }

    public function akunBaru()
    {
        // Ambil daftar akun baru, hanya yang memiliki role 'pengguna' dan belum diubah role-nya
        $akunBaru = User::where('role', 'pengguna')
            ->whereNull('role_updated_at')
            ->get();
        return view('admin.akun_baru', compact('akunBaru'));
    }

    public function semuaAkun()
{
    $admins = User::where('role', 'admin')->whereNotNull('role_updated_at')->get();
    $petugas = User::where('role', 'petugas')->whereNotNull('role_updated_at')->get();
    $pengguna = User::where('role', 'pengguna')->whereNotNull('role_updated_at')->get();

    return view('admin.semua_akun', compact('admins', 'petugas', 'pengguna'));
}


    public function hapusAkun(User $user)
    {
        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }

    public function ubahRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $newRole = $request->role;

        $user->role = $newRole;
        $user->role_updated_at = now(); // Set timestamp saat role diubah
        $user->save();

        return redirect()->route('admin.akunBaru')->with('success', 'Role berhasil diubah.');
    }

    public function tambahAkun($role)
    {
        return view('admin.tambahAkun', ['role' => $role]);
    }

    public function simpanAkun(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $user->save();

        return redirect()->route('admin.semuaAkun')->with('success', 'Akun berhasil ditambahkan.');
    }


    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:diterima,diproses,selesai',
            'penanganan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $laporan) {
            // Update status di tabel laporans
            $laporan->update(['status' => $request->status]);

            // Update atau buat data di tabel tindak_lanjuts
            TindakLanjut::updateOrCreate(
                ['laporan_id' => $laporan->id],
                [
                    'penanganan' => $request->penanganan,
                    'petugas_id' => Auth::id(),
                    'status' => $request->status,
                ]
            );

            // Pindahkan data ke LaporanSelesai hanya jika status 'selesai'
            if ($request->status == 'selesai') {
                // Pastikan hanya satu entri LaporanSelesai per Laporan
                LaporanSelesai::updateOrCreate(
                    ['laporan_id' => $laporan->id],
                    [
                        'penanganan' => $request->penanganan,
                        'petugas_id' => Auth::id(),
                        'status' => $request->status,
                    ]
                );
            }
        });

        return back()->with('success', 'Status laporan berhasil diubah.');
    }

    public function tandaiDiproses(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => 'diproses']);

        // Buat entri di tabel tindak_lanjuts
        TindakLanjut::create([
            'laporan_id' => $laporan->id,
            'petugas_id' => Auth::id(),
            'penanganan' => 'Laporan ditandai sebagai diproses',
            'status' => 'diproses',
        ]);

        return redirect()->route('admin.laporanDiproses')->with('success', 'Laporan berhasil ditandai sebagai diproses.');
    }

    public function selesaiLaporanAdmin(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        // Pastikan laporan berstatus 'selesai'
        if ($laporan->status != 'selesai') {
            return back()->with('error', 'Laporan harus berstatus "selesai" untuk diselesaikan.');
        }

        // Ambil data tindak lanjut terakhir
        $tindakLanjutTerakhir = $laporan->tindakLanjutTerakhir;

        // Validasi request
        $request->validate([
            'penanganan' => 'nullable|string',
        ]);

        // Pindahkan data ke LaporanSelesai
        LaporanSelesai::updateOrCreate(
            ['laporan_id' => $laporan->id],
            [
                'penanganan' => $request->filled('penanganan') ? $request->penanganan : ($tindakLanjutTerakhir ? $tindakLanjutTerakhir->penanganan : null),
                'petugas_id' => Auth::id(), // Gunakan ID Admin
                'status' => 'selesai',
            ]
        );

        // Hapus data dari tabel Laporan
        $laporan->delete();

        return redirect()->route('admin.laporanSelesai')->with('success', 'Laporan berhasil diselesaikan dan dipindahkan ke Laporan Selesai.');
    }
}
