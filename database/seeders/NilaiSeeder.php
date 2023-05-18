<?php

namespace Database\Seeders;

use App\Imports\NilaiKriteriaImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NilaiKriteriaImport, public_path("data/nilai_kriteria_pegawai.xlsx"));
    }
}
