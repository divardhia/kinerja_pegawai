<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        return view('admin.perhitungan.index');
    }

    public function hasil(Request $request)
    {
        DB::beginTransaction();
        try {
            $jabatan = $request->jabatan;
            $year = $request->year;
            $pegawai = Pegawai::where('jabatan', $jabatan)->get();

            // cek kelengkapan nilai pegawai
            foreach ($pegawai as $p) {
                for ($i = 1; $i <= 5; $i++) {
                    if ($p->pegawai_kriteria->where('id_kriteria', $i)->where('year', $year)->first() == null) {
                        return back()->withErrors('Mohon maaf, tidak dapat dilakukan perhitungan karena nilai pegawai belum lengkap');
                    }
                }
            }

            // input matriks keputusan
            $matriks = [];
            foreach ($pegawai as $p) {
                $matriks[] = [
                    'id_user' => $p->user->id,
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
            $kuadrat_kriteria = [0, 0, 0, 0, 0];
            $kriteria = ['c1', 'c2', 'c3', 'c4', 'c5'];
            foreach ($matriks as $m) {
                for ($i = 0; $i < 5; $i++) {
                    $kuadrat_kriteria[$i] += pow($m[$kriteria[$i]], 2);
                }
            }

            $nilai_kriteria = [];
            foreach ($matriks as $m) {
                for ($i = 0; $i < 5; $i++) {
                    $nilai_kriteria[$i] = $m[$kriteria[$i]] / sqrt($kuadrat_kriteria[$i]);
                }
                $normalisasi[] = [
                    'id_user' => $m['id_user'],
                    'nama' => $m['nama'],
                    'c1' => round($nilai_kriteria[0], 3),
                    'c2' => round($nilai_kriteria[1], 3),
                    'c3' => round($nilai_kriteria[2], 3),
                    'c4' => round($nilai_kriteria[3], 3),
                    'c5' => round($nilai_kriteria[4], 3)
                ];
            }

            // hitung normalisasi terbobot
            $bobot = Kriteria::pluck('bobot')->toArray();
            $normalisasi_terbobot = [];
            foreach ($normalisasi as $n) {
                $normalisasi_terbobot[] = [
                    'id_user' => $n['id_user'],
                    'nama' => $n['nama'],
                    'c1' => round($n['c1'] * $bobot[0], 3),
                    'c2' => round($n['c2'] * $bobot[1], 3),
                    'c3' => round($n['c3'] * $bobot[2], 3),
                    'c4' => round($n['c4'] * $bobot[3], 3),
                    'c5' => round($n['c5'] * $bobot[4], 3)
                ];
            }

            // hitung nilai yi dan rank
            $yi = [];
            foreach ($normalisasi_terbobot as $nt) {
                $yi[] = [
                    'id_user' => $nt['id_user'],
                    'nama' => $nt['nama'],
                    'yi' => $nt['c1'] + $nt['c2'] + $nt['c3'] + $nt['c4'] + $nt['c5']
                ];
            }

            // simpan rangking pada database
            $rank = collect($yi)->sortByDesc('yi')->values()->all();
            $rangking = 1;
            foreach ($rank as $r) {
                $data_rank = Rank::where([['id_user', $r['id_user']], ['jabatan', $jabatan], ['year', $year]])->first();
                if ($data_rank == null) {
                    $data_rank = new Rank();
                }
                $data_rank->id_user = $r['id_user'];
                $data_rank->jabatan = $jabatan;
                $data_rank->nilai_akhir = $r['yi'];
                $data_rank->rank = $rangking;
                $data_rank->year = $year;
                $data_rank->save();
                $rangking += 1;
            }

            DB::commit();
            return view('admin.perhitungan.hasil', compact('jabatan', 'year', 'pegawai', 'matriks', 'normalisasi', 'normalisasi_terbobot', 'rank'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('toast_error', $th->getMessage());
        }
    }
}
