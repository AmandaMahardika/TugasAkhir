<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSelesai extends Model
{
    use HasFactory;

    protected $table = 'laporan_selesai';

    protected $fillable = [
        'laporan_id',
        'penanganan',
        'status',
        'petugas_id',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
