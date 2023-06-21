<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\PegawaiKegiatan;
use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::whereHas('user', function($q){
            $q->where('role', User::PEGAWAI);
        })->get();
        return view('admin.penilaian.index', compact('pegawai'));
    }

    public function index_hasil_pegawai()
    {
        return view('pegawai.index_hasil');
    }

    public function hasil_nilai_pegawai(Request $request)
    {
        $year = $request->year;
        $jabatan = Pegawai::where('id_user', Auth::user()->id)->first()->jabatan;
        $nilai = Rank::where([['jabatan', $jabatan], ['year', $year]])->orderBy('rank')->get();
        if(count($nilai) > 0){
            return view('pegawai.hasil_pegawai', compact('nilai', 'year', 'jabatan'));
        } else {
            return back()->withErrors('Mohon maaf, Hasil Penilaian Belum Tersedia');
        }
    }

    public function nilai_pegawai()
    {
        $year_now = date('Y');
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $kegiatan = Kegiatan::where('jabatan', $pegawai->jabatan)->get();
        foreach ($kegiatan as $k) {
            $k->realisasi = PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first() ? PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first()->realisasi : "-";
        }
        $nilai_kriteria = [];
        $kriteria = Kriteria::pluck('nama_kriteria')->toArray();
        for ($i = 1; $i <= 5; $i++) {
            $nilai_kriteria[] = [
                'nama_kriteria' => $kriteria[$i-1],
                'nilai' => $pegawai->pegawai_kriteria->where('id_kriteria', $i)->where('year', date('Y'))->first() ? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai : "-"
            ];
        }
        return view('pegawai.nilai_pegawai', compact('pegawai', 'kegiatan', 'nilai_kriteria'));
    }
}
