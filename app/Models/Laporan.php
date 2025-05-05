<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'user_id',
        'nama',
        'lokasi_ruang',
        'detail1',
        'detail2',
        'deskripsi_kerusakan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class, 'laporan_id');
    }

    public function tindakLanjutTerakhir()
    {
        return $this->hasOne(TindakLanjut::class, 'laporan_id')->latestOfMany();
    }

    public function laporanSelesai()
    {
        return $this->hasOne(LaporanSelesai::class, 'laporan_id');
    }
}
