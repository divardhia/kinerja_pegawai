<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Memastikan bahwa setiap aplikasi yang digunakan bisa berjalan dengan baik',
            'target'            => '90% - 100%',
            'jabatan'           => 'Operator',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Bertanggung jawab pada mesin pendukung',
            'target'            => '90% - 100%',
            'jabatan'           => 'Operator',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Memastikan bahwa setiap komputer yang digunakan bisa berkomunikasi dengan baik dan terhubung dengan sistem jaringan',
            'target'            => '90% - 100%',
            'jabatan'           => 'Operator',
        ]);


        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Membantu kebersihan dan kerapihan ruangan kerja',
            'target'            => '90% - 100%',
            'jabatan'           => 'Pramubakti',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Membantu kegiatan administrasi kantor',
            'target'            => '90% - 100%',
            'jabatan'           => 'Pramubakti',
        ]);


        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Kebersihan dan kerapian mobil',
            'target'            => '90% - 100%',
            'jabatan'           => 'Pengemudi',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Ketangkasan dalam antar jemput',
            'target'            => '90% - 100%',
            'jabatan'           => 'Pengemudi',
        ]);


        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Melakukan pemeriksaan pada tamu',
            'target'            => '90% - 100%',
            'jabatan'           => 'Petugas Keamanan',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Memeriksa mobil / motor yang masuk dan keluar',
            'target'            => '90% - 100%',
            'jabatan'           => 'Petugas Keamanan',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Menertibkan parkir mobil dan motor di area kantor',
            'target'            => '90% - 100%',
            'jabatan'           => 'Petugas Keamanan',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Menjaga dan memelihara inventaris kantor',
            'target'            => '90% - 100%',
            'jabatan'           => 'Petugas Keamanan',
        ]);


        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Merawat, memelihara, dan menjaga keamanan cagar budaya',
            'target'            => '90% - 100%',
            'jabatan'           => 'Juru Pelihara Cagar Budaya',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Merawat secara berkala dan rutin',
            'target'            => '90% - 100%',
            'jabatan'           => 'Juru Pelihara Cagar Budaya',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Memandu dan memberi penjelasan kepada pengunjung kawasan cagar budaya',
            'target'            => '90% - 100%',
            'jabatan'           => 'Juru Pelihara Cagar Budaya',
        ]);

        DB::table('kegiatans')->insert([
            'kegiatan_kinerja'  => 'Membuat laporan bulanan dan tahunan',
            'target'            => '90% - 100%',
            'jabatan'           => 'Juru Pelihara Cagar Budaya',
        ]);
    }
}
