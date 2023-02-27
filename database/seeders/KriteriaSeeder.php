<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->insert([
            'nama_kriteria'     => 'Nilai Kinerja',
            'bobot'             => 0.7,
            'created_by'        => 1, 
        ]);

        DB::table('kriterias')->insert([
            'nama_kriteria'     => 'Orientasi Pelayanan',
            'bobot'             => 0.075,
            'created_by'        => 1, 
        ]);

        DB::table('kriterias')->insert([
            'nama_kriteria'     => 'Komitmen',
            'bobot'             => 0.075,
            'created_by'        => 1, 
        ]);

        DB::table('kriterias')->insert([
            'nama_kriteria'     => 'Inisiatif Kerja',
            'bobot'             => 0.075,
            'created_by'        => 1, 
        ]);

        DB::table('kriterias')->insert([
            'nama_kriteria'     => 'Kerjasama',
            'bobot'             => 0.075,
            'created_by'        => 1, 
        ]);
    }
}
