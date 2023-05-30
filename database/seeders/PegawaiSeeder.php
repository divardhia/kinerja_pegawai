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
            'id_user'           => 2, 
            'jabatan'           => 'Admin',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Anton',
            'nama_belakang'     => 'Hariyanto',
            'id_user'           => 3, 
            'jabatan'           => 'Pimpinan',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Kepala',
            'nama_belakang'     => 'Operator',
            'id_user'           => 4, 
            'jabatan'           => 'Pegawai',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Kepala',
            'nama_belakang'     => 'Pramubakti',
            'id_user'           => 5, 
            'jabatan'           => 'Pegawai',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Kepala',
            'nama_belakang'     => 'Pengemudi',
            'id_user'           => 6, 
            'jabatan'           => 'Pegawai',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Kepala',
            'nama_belakang'     => 'Keamanan',
            'id_user'           => 7, 
            'jabatan'           => 'Pegawai',
        ]);

        DB::table('pegawais')->insert([
            'nama_depan'        => 'Kepala Juru Pelihara',
            'nama_belakang'     => 'Cagar Budaya',
            'id_user'           => 8, 
            'jabatan'           => 'Pegawai',
        ]);
    }
}
