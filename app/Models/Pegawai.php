<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    protected $fillable = [
        'id_user',
        'nama_depan',
        'nama_belakang',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kriteria()
    {
        return $this->belongsToMany(Kriteria::class, 'pegawai_kriterias', 'id_pegawai', 'id_kriteria');
    }

    public function pegawai_kriteria()
    {
        return $this->hasMany(PegawaiKriteria::class, 'id_pegawai', 'id');
    }

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class, 'pegawai_kegiatans', 'id_pegawai', 'id_kegiatan');
    }

    public function pegawai_kegiatan()
    {
        return $this->hasMany(PegawaiKegiatan::class, 'id_pegawai', 'id');
    }

    public function getStatusNameAttribute()
    {
        if($this->status == true){
            return 'Aktif';
        } else {
            return 'Tidak Aktif';
        }
    }
}
