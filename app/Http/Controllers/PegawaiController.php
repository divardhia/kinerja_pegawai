<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
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
        $pegawai = Pegawai::with('divisi')->get();
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
            'nama_belakang' => 'required',
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
        $pegawai->nama_belakang = $request->get('nama_belakang');
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
            'nama_belakang' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $pegawai = Pegawai::find($id);
        $user = User::find($pegawai->id_user);

        $user->name = $request->get('nama_depan') . " " . $request->get('nama_belakang');
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        $pegawai->nama_depan = $request->get('nama_depan');
        $pegawai->nama_belakang = $request->get('nama_belakang');
        $pegawai->jabatan = $request->get('jabatan');
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
}
