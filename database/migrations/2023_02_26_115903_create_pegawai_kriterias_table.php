<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai')->nullable();
            $table->foreign('id_pegawai')->references('id')->on('pegawais');
            $table->unsignedBigInteger('id_kriteria')->nullable();
            $table->foreign('id_kriteria')->references('id')->on('kriterias');
            $table->double('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_kriterias');
    }
}
