<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNilaiRequest;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PegawaiKegiatan;
use App\Models\PegawaiKriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = Pegawai::where('id_user', Auth::user()->id)->first()->jabatan;
        if(Auth::user()->role == User::KEPALA){
            $pegawai = Pegawai::where([['jabatan', $jabatan], ['status', true]])->whereHas('user', function($q){
                $q->where('role', User::PEGAWAI);
            })->get();
        } else {
            $pegawai = Pegawai::all();
        }
        
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = new User();
        $user->name = $request->get('nama_depan') . " " . $request->get('nama_belakang');
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->role = $request->role;
        $user->save();

        $pegawai = new Pegawai();
        $pegawai->nama_depan = $request->get('nama_depan');
        $pegawai->nama_belakang = $request->get('nama_belakang') ?? "";
        $pegawai->jabatan = $request->get('jabatan');
        $pegawai->id_user = $user->id;
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.detail', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::with('user')->where('id', $id)->first();
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_depan' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $user = User::find($pegawai->id_user);

        $user->name = $request->get('nama_depan') . " " . $request->get('nama_belakang');
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        $pegawai->nama_depan = $request->get('nama_depan');
        $pegawai->nama_belakang = $request->get('nama_belakang') ?? "";
        $pegawai->jabatan = $request->get('jabatan');
        $pegawai->status = $request->get('status');
        $pegawai->save();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')
            ->with('success');
    }

    public function nilai_kinerja(Request $request, $id)
    {
        $year_now = $request->year;
        $pegawai = Pegawai::find($id);
        $kegiatan = Kegiatan::where('jabatan', $pegawai->jabatan)->get();
        foreach ($kegiatan as $k) {
            $k->realisasi = PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first() ? PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $k->id], ['year', $year_now]])->first()->realisasi : "";
        }
        $nilai_kriteria = array();
        for ($i = 2; $i <= 5; $i++) {
            $c = $pegawai->pegawai_kriteria->where('id_kriteria', $i)->where('year', $year_now)->first() ? $pegawai->pegawai_kriteria->where('id_kriteria', $i)->where('year', $year_now)->first()->nilai : "";
            array_push($nilai_kriteria, $c);
        }
        return view('pegawai.nilai_kinerja', compact('pegawai', 'kegiatan', 'nilai_kriteria', 'year_now'));
    }

    public function store_nilai_kinerja(StoreNilaiRequest $request)
    {
        $year_now = $request->year;
        $pegawai = Pegawai::find($request->id_pegawai);
        $kegiatan = Kegiatan::where('jabatan', $pegawai->jabatan)->pluck('id')->toArray();
        $realisasi = $request->realisasi;
        $nilai_kinerja = array_sum($realisasi) / count($realisasi);
        $nilai_c = [$nilai_kinerja, $request->c2, $request->c3, $request->c4, $request->c5];

        // simpan nilai realisasi pada tabel pegawai_kegiatan
        for ($i = 0; $i < count($kegiatan); $i++) {
            $pegawai_kegiatan = PegawaiKegiatan::where([['id_pegawai', $pegawai->id], ['id_kegiatan', $kegiatan[$i]], ['year', $year_now]])->first();
            if ($pegawai_kegiatan == null) {
                $pegawai_kegiatan = new PegawaiKegiatan();
            }
            $pegawai_kegiatan->id_pegawai = $pegawai->id;
            $pegawai_kegiatan->id_kegiatan = $kegiatan[$i];
            $pegawai_kegiatan->realisasi = $realisasi[$i];
            $pegawai_kegiatan->year = $year_now;
            $pegawai_kegiatan->save();
        }

        // simpan nilai C pada tabel pegawai_kriteria
        for ($i = 1; $i <= 5; $i++) {
            $pegawai_kriteria = PegawaiKriteria::where([['id_pegawai', $pegawai->id], ['id_kriteria', $i], ['year', $year_now]])->first();
            if ($pegawai_kriteria == null) {
                $pegawai_kriteria = new PegawaiKriteria();
            }
            $pegawai_kriteria->id_pegawai = $pegawai->id;
            $pegawai_kriteria->id_kriteria = $i;
            $pegawai_kriteria->nilai = $nilai_c[$i-1];
            $pegawai_kriteria->year = $year_now;
            $pegawai_kriteria->save();
        }

        return redirect()->route('pegawai.nilai_kinerja', ['id'=>$pegawai->id,'year'=>$year_now])
            ->with('success', 'Nilai berhasil diinput');
    }
}
