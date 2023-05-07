<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';
    protected $fillable = [
        'id_pegawai',
        'kegiatan_kinerja',
        'target',
        'jabatan',
    ];

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_kriterias', 'id_kegiatan', 'id_pegawai');
    }

    public function pegawai_kegiatan()
    {
        return $this->hasMany(PegawaiKegiatan::class, 'id_kegiatan', 'id');
    }
}
