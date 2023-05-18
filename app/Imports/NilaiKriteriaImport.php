<?php

namespace App\Imports;

use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\PegawaiKegiatan;
use App\Models\PegawaiKriteria;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiKriteriaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // save new user for pegawai
            $user = new User();
            $nama = $row['nama_depan'] . " " . $row['nama_belakang'];
            $user->name = $nama;
            $user->email = $row['email'];
            $user->password = Hash::make($row['password']);
            $user->role = $row['role'];
            $user->save();

            // save new data pegawai
            $pegawai = new Pegawai();
            $pegawai->nama_depan = $row['nama_depan'];
            $pegawai->nama_belakang = $row['nama_belakang'] ?? "";
            $pegawai->jabatan = $row['jabatan'];
            $pegawai->id_user = $user->id;
            $pegawai->save();

            // save data nilai pegawai kegiatan
            $kegiatan = Kegiatan::where('jabatan', $row['jabatan'])->get();
            foreach ($kegiatan as $k) {
                $pegawai_kegiatan = new PegawaiKegiatan();
                $pegawai_kegiatan->id_pegawai = $pegawai->id;
                $pegawai_kegiatan->id_kegiatan = $k->id;
                $pegawai_kegiatan->realisasi = $row['c1'];
                $pegawai_kegiatan->year = 2023;
                $pegawai_kegiatan->save();
            }

            $kriteria = ['c1', 'c2', 'c3', 'c4', 'c5'];
            for ($i=0; $i < 5; $i++) { 
                $pegawai_kriteria = new PegawaiKriteria();
                $pegawai_kriteria->id_pegawai = $pegawai->id;
                $pegawai_kriteria->id_kriteria = ($i+1);
                $pegawai_kriteria->nilai = $row[$kriteria[$i]];
                $pegawai_kriteria->year = 2023;
                $pegawai_kriteria->save();
            }
        }
    }
}
