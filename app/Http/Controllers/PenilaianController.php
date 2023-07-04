<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\PegawaiKegiatan;
use App\Models\Rank;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $jabatan = Pegawai::where('id_user', Auth::user()->id)->first()->jabatan;
        if(Auth::user()->role == User::KEPALA){
            $pegawai = Pegawai::where([['status', true], ['jabatan', $jabatan]])->whereHas('user', function($q){
                $q->where('role', User::PEGAWAI);
            })->get();
        } else {
            $pegawai = Pegawai::where('status', true)->whereHas('user', function($q){
                $q->where('role', User::PEGAWAI);
            })->get();
        }
        
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

    public function cetak_nilai_pegawai()
    {
        $year_now = date('Y');
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $pimpinan = User::where('role',User::PIMPINAN)->first();
        $kegiatan = Kegiatan::where('jabatan', $pegawai->jabatan)->get();
        foreach ($kegiatan as $k) {
            $realisasi = PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first() ? PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first()->realisasi : "-";
            $nilai_realisasi = $realisasi == "-" ? 0 : $realisasi;
            $k->realisasi = $realisasi;
            $k->kategori = $this->rentang_penilaian($nilai_realisasi); 
        }
        $nilai_kriteria = [];
        $kriteria = Kriteria::pluck('nama_kriteria')->toArray();
        for ($i = 1; $i <= 5; $i++) {
            $nilai = $pegawai->pegawai_kriteria->where('id_kriteria', $i)->where('year', date('Y'))->first() ? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai : "-";
            $nilai_c = $nilai == "-" ? 0 : $nilai;
            $nilai_kriteria[] = [
                'nama_kriteria' => $kriteria[$i-1],
                'nilai' => $nilai,
                'kategori' => $this->rentang_penilaian($nilai_c)
            ];
        }
        // data c1
        $c1 = $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai: '-';
        $nilai_c1 = $c1 == "-" ? 0 : $c1;
        $kategori_c1 = $this->rentang_penilaian($nilai_c1);

        // setup pdf
        $nama_file = "Laporan_nilai_pegawai_" . $user->name . "_" . $year_now . ".pdf";
        $pdf = Pdf::loadView('pegawai.nilai_pegawai_pdf', compact('pegawai', 'kegiatan', 'nilai_kriteria', 'year_now', 'pimpinan', 'c1', 'kategori_c1'));
        return $pdf->download($nama_file);
        // return view('pegawai.nilai_pegawai_pdf', compact('pegawai', 'kegiatan', 'nilai_kriteria', 'year_now', 'pimpinan'));
    }

    public function rentang_penilaian($nilai)
    {
        if($nilai >= 101 && $nilai <= 110){
            return 'Sangat Baik';
        } else if($nilai >= 90 && $nilai <= 100) {
            return 'Baik';
        } else if($nilai >= 80 && $nilai <= 89) {
            return 'Cukup';
        } else if($nilai >= 60 && $nilai <= 79) {
            return 'Kurang';
        } else {
            return 'Sangat Kurang';
        }
    }

    public function nilai_pegawai()
    {
        $year_now = date('Y');
        $user = Auth::user();
        $pegawai = Pegawai::where('id_user', $user->id)->first();
        $kegiatan = Kegiatan::where('jabatan', $pegawai->jabatan)->get();
        foreach ($kegiatan as $k) {
            $realisasi = PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first() ? PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first()->realisasi : "-";
            $nilai_realisasi = $realisasi == "-" ? 0 : $realisasi;
            $k->realisasi = $realisasi;
            $k->kategori = $this->rentang_penilaian($nilai_realisasi); 
        }
        $nilai_kriteria = [];
        $kriteria = Kriteria::pluck('nama_kriteria')->toArray();
        for ($i = 1; $i <= 5; $i++) {
            $nilai = $pegawai->pegawai_kriteria->where('id_kriteria', $i)->where('year', date('Y'))->first() ? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai : "-";
            $nilai_c = $nilai == "-" ? 0 : $nilai;
            $nilai_kriteria[] = [
                'nama_kriteria' => $kriteria[$i-1],
                'nilai' => $nilai,
                'kategori' => $this->rentang_penilaian($nilai_c)
            ];
        }
        return view('pegawai.nilai_pegawai', compact('pegawai', 'kegiatan', 'nilai_kriteria'));
    }
}
