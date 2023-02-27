<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiKriteria extends Model
{
    use HasFactory;

    protected $table = 'pegawai_kriterias';
    protected $fillable = [
        'id_pegawai',
        'id_kriteria',
        'nilai',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id');
    }
}
