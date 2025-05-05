<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())->get();
        return view('dashboard.pengguna', compact('laporans'));
    }

    public function create()
    {
        return view('dashboard.laporan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_ruang' => 'required',
            'detail1' => 'required',
            'detail2' => 'required',
            'deskripsi_kerusakan' => 'required',
        ]);

        Laporan::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->name,
            'lokasi_ruang' => $request->lokasi_ruang,
            'detail1' => $request->detail1,
            'detail2' => $request->detail2,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }
}

