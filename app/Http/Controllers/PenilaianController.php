<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::whereHas('user', function($q){
            $q->where('role', User::PEGAWAI);
        })->get();
        return view('admin.penilaian.index', compact('pegawai'));
    }
}
