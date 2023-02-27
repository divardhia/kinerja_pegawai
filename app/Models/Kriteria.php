<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $fillable = [
        'nama_kriteria',
        'bobot',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function pegawai()
    {
        return $this->belongsToMany(Kriteria::class, 'pegawai_kriterias', 'id_kriteria', 'id_pegawai');
    }

    public function pegawai_kriteria()
    {
        return $this->hasMany(PegawaiKriteria::class, 'id_kriteria', 'id');
    }
}
