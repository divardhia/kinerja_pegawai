@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="title text-center">Selamat datang Sistem Informasi Penilaian Kinerja Pegawai</div>
                    </div>
                    <hr>

                    <div class="card-body">
                        <div class="text-center">Silahkan pilih menu pada sidebar {{ Auth::user()->name }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            Penilaian kinerja Pegawai Pemerintah Non Pegawai Negeri (PPNPN) oleh kepala jabatan
                            masing-masing memiliki kriteria yang diuji
                            yaitu hasil kerja, orientasi pelayanan, komitmen, inisiatif kerja, dan kerja sama. penilaian
                            dikelompokkan sesuai dengan jabatan masing-masing.
                        </div>
                        <div class="row">
                            alur sistem:
                            <center><img src="{{ asset('images/alur-program.png') }}" alt=""></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
