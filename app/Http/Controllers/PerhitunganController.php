<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        return view('admin.perhitungan.index');
    }

    public function hasil(Request $request)
    {
        $jabatan = $request->jabatan;
        $year = $request->year;
        $pegawai = Pegawai::where('jabatan', $jabatan)->get();

        // cek kelengkapan nilai pegawai
        foreach($pegawai as $p){
            for ($i=1; $i<=5 ; $i++) { 
                if($p->pegawai_kriteria->where('id_kriteria', $i)->where('year', $year)->first() == null){
                    return back()->withErrors('Mohon maaf, tidak dapat dilakukan perhitungan karena nilai pegawai belum lengkap');
                }
            }
        }

        // input matriks keputusan
        $matriks = [];
        foreach($pegawai as $p){
            $matriks[] = [
                'nama' => $p->user->name,
                'c1' => $p->pegawai_kriteria->where('id_kriteria', 1)->where('year', $year)->first()->nilai,
                'c2' => $p->pegawai_kriteria->where('id_kriteria', 2)->where('year', $year)->first()->nilai,
                'c3' => $p->pegawai_kriteria->where('id_kriteria', 3)->where('year', $year)->first()->nilai,
                'c4' => $p->pegawai_kriteria->where('id_kriteria', 4)->where('year', $year)->first()->nilai,
                'c5' => $p->pegawai_kriteria->where('id_kriteria', 5)->where('year', $year)->first()->nilai
            ];
        }
        
        // hitung normalisasi
        $normalisasi = [];
        $kuadrat_kriteria = [0,0,0,0,0];
        $kriteria = ['c1', 'c2', 'c3', 'c4', 'c5'];
        foreach($matriks as $m){
            for ($i=0; $i < 5; $i++) { 
                $kuadrat_kriteria[$i] += pow($m[$kriteria[$i]], 2);
            }
        }
        
        $nilai_kriteria = [];
        foreach($matriks as $m){
            for ($i=0; $i < 5; $i++) { 
                $nilai_kriteria[$i] = $m[$kriteria[$i]] / sqrt($kuadrat_kriteria[$i]);
            }
            $normalisasi[] = [
                'nama' => $m['nama'],
                'c1' => $nilai_kriteria[0],
                'c2' => $nilai_kriteria[1],
                'c3' => $nilai_kriteria[2],
                'c4' => $nilai_kriteria[3],
                'c5' => $nilai_kriteria[4]
            ];
        }

        // hitung normalisasi terbobot
        $bobot = Kriteria::pluck('bobot')->toArray();
        $normalisasi_terbobot = [];
        foreach($normalisasi as $n){
            $normalisasi_terbobot[] = [
                'nama' => $n['nama'],
                'c1' => $n['c1'] * $bobot[0],
                'c2' => $n['c2'] * $bobot[1],
                'c3' => $n['c3'] * $bobot[2],
                'c4' => $n['c4'] * $bobot[3],
                'c5' => $n['c5'] * $bobot[4]
            ];  
        }
        return view('admin.perhitungan.hasil', compact('jabatan', 'year', 'pegawai', 'matriks', 'normalisasi', 'normalisasi_terbobot'));
    }
}
