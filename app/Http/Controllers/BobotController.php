<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function edit()
    {
        $kriteria = Kriteria::all();
        return view('admin.bobot.edit', compact('kriteria'));
    }

    public function update(Request $request)
    {
        $kriteria = Kriteria::all();
        foreach ($kriteria as $key => $value) {
            $nama_bobot = "bobot-" . $value->id;
            $value->bobot = $request->get($nama_bobot);
            $value->save();
        }
        return redirect()->route('bobot.edit')
            ->with('success', 'Bobot berhasil diupdate');
    }
}
