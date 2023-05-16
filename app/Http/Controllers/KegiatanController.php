<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PegawaiKegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kegiatan.create');
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
            'kegiatan_kinerja' => 'required',
            'target_down' => 'required',
            'target_up' => 'required',
            'jabatan' => 'required',
        ]);

        $kegiatan = new Kegiatan();
        $kegiatan->kegiatan_kinerja = $request->kegiatan_kinerja;
        $kegiatan->target = $request->target_down . "% - " . $request->target_up . "%";
        $kegiatan->jabatan = $request->jabatan;
        $kegiatan->save();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('admin.kegiatan.detail', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id);
        $target = explode(" - ", $kegiatan->target);
        $target[0] = str_replace("%", "", $target[0]);
        $target[1] = str_replace("%", "", $target[1]);
        $kegiatan->target_down = $target[0];
        $kegiatan->target_up = $target[1];
        return view('admin.kegiatan.edit', compact('kegiatan'));
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
            'kegiatan_kinerja' => 'required',
            'target_down' => 'required',
            'target_up' => 'required',
            'jabatan' => 'required',
        ]);

        $kegiatan = Kegiatan::find($id);
        $kegiatan->kegiatan_kinerja = $request->kegiatan_kinerja;
        $kegiatan->target = $request->target_down . "% - " . $request->target_up . "%";
        $kegiatan->jabatan = $request->jabatan;
        $kegiatan->save();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }
}
