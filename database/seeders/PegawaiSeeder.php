<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'nama_depan'        => 'Admin',
            'nama_belakang'     => 'Satu',
            'id_user'           => 1, 
            'jabatan'           => 'Admin',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Diva',
            'nama_belakang'     => 'Ardhia',
            'id_user'           => 1, 
            'jabatan'           => 'Admin',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Anton',
            'nama_belakang'     => 'Hariyanto',
            'id_user'           => 2, 
            'jabatan'           => 'Pimpinan',
        ]);
    }
}
