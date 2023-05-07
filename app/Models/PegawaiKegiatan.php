<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiKegiatan extends Model
{
    use HasFactory;

    protected $table = 'pegawai_kegiatans';
    protected $fillable = [
        'id_pegawai',
        'id_kegiatan',
        'realisasi',
        'kategori'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }
}
