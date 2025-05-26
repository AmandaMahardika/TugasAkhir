<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\TindakLanjut;
use App\Models\LaporanSelesai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function dashboard()
    {
        $laporans = Laporan::where('status', 'baru')->get();
        $tindakLanjut = TindakLanjut::with('laporan')->get();
        return view('dashboard.petugas', compact('laporans', 'tindakLanjut'));
    }

    public function laporanDiproses()
    {
        $laporanDiproses = Laporan::where('status', 'diproses')
            ->with('tindakLanjutTerakhir')
            ->get();

        return view('petugas.laporan_diproses', compact('laporanDiproses'));
    }

    public function laporanSelesai()
    {
        $laporanSelesai = LaporanSelesai::with('laporan', 'petugas')->get();
        return view('petugas.laporan_selesai', compact('laporanSelesai'));
    }

    public function terimaLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);

        DB::transaction(function () use ($laporan) {
            // Ubah status laporan menjadi 'diproses'
            $laporan->update(['status' => 'diproses']);

            // Buat entri di tabel tindak_lanjuts dengan status 'diterima'
            TindakLanjut::create([
                'laporan_id' => $laporan->id,
                'petugas_id' => Auth::id(),
                'penanganan' => null, // Bisa diisi nanti saat edit
                'status' => 'diterima',
            ]);
        });

        return back()->with('success', 'Laporan berhasil diterima dan ditambahkan ke Tindak Lanjut.');
    }

    public function editTindakLanjut($id)
    {
        $tindakLanjut = TindakLanjut::findOrFail($id);
        return view('petugas.edit_tindak_lanjut', compact('tindakLanjut'));
    }

    public function updateTindakLanjut(Request $request, $id)
{
    $tindakLanjut = TindakLanjut::findOrFail($id);

    // Simpan status lama untuk pembanding
    $statusLama = $tindakLanjut->status;

    // Validasi dasar
    $request->validate([
        'status' => 'required|in:diproses,selesai', // paksa agar tidak bisa pilih "diterima"
    ], [
        'status.in' => 'Status harus diubah ke "diproses" atau "selesai".',
    ]);

    // Validasi penanganan wajib diisi jika status bukan 'diterima'
    if (in_array($request->status, ['diproses', 'selesai']) && empty(trim($request->penanganan))) {
        return redirect()->back()
            ->withErrors(['penanganan' => 'Penanganan harus diisi jika status bukan "diterima".'])
            ->withInput();
    }

    DB::transaction(function () use ($request, $tindakLanjut) {
        $tindakLanjut->update([
            'penanganan' => $request->penanganan,
            'status' => $request->status,
        ]);

        $tindakLanjut->laporan->update([
            'status' => $request->status,
        ]);

        if ($request->status === 'selesai') {
            LaporanSelesai::updateOrCreate(
                ['laporan_id' => $tindakLanjut->laporan_id],
                [
                    'penanganan' => $request->penanganan,
                    'petugas_id' => Auth::id(),
                    'status' => $request->status,
                ]
            );
        }
    });

    return redirect()->route('petugas.dashboard')->with('success', 'Tindak lanjut berhasil diperbarui.');
}

}
