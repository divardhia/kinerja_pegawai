<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Admin',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Diva',
            'email'=> 'diva@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Anton',
            'email'=> 'anton@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 2
        ]);

        DB::table('users')->insert([
            'name'=> 'Kepala Operator',
            'email'=> 'operator@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Kepala Pramubakti',
            'email'=> 'pramubakti@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Kepala Pengemudi',
            'email'=> 'pengemudi@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Kepala Keamanan',
            'email'=> 'keamanan@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);

        DB::table('users')->insert([
            'name'=> 'Kepala Juru Pelihara Cagar Budaya',
            'email'=> 'pelihara@gmail.com',
            'password'=> Hash::make('12345678'),
            'role' => 1
        ]);
    }
}
