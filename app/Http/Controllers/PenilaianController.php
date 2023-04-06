<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        $penilaian = Kriteria::with('pegawai')->get();
        return view('admin.penilaian.index', compact('penilaian'));
    }
}
