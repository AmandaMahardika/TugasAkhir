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
        $request->validate([
            'penanganan' => 'nullable|string',
            'status' => 'required|in:diterima,diproses,selesai',
        ]);

        $tindakLanjut = TindakLanjut::findOrFail($id);
        $laporan = $tindakLanjut->laporan; // Ambil laporan terkait

        DB::transaction(function () use ($request, $tindakLanjut, $laporan) {
            $tindakLanjut->update([
                'penanganan' => $request->penanganan,
                'status' => $request->status,
            ]);

            $laporan->update(['status' => $request->status]);

            // Pindahkan data ke LaporanSelesai jika status 'selesai'
            if ($request->status == 'selesai') {
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

        return redirect()->route('petugas.dashboard')->with('success', 'Tindak lanjut berhasil diperbarui.');
    }
}
