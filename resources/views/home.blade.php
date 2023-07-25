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
                        @if (Auth::user()->role == '1' || Auth::user()->role == '2')
                            <div class="row mb-5">
                                Alur Sistem:
                                <center><img src="{{ asset('images/alur-program.png') }}" alt=""></center>
                            </div>
                            <div class="row mb-5">
                            @elseif (Auth::user()->role == '4')
                                <div class="row mb-5">
                                    Alur Sistem:
                                    <center><img src="{{ asset('images/alur-program-penilai.png') }}" alt="">
                                    </center>
                                </div>
                                <div class="row mb-5">
                                @else
                                    <div class="row mb-5">
                                        Alur:
                                        <center><img src="{{ asset('images/alur-program-pegawai.png') }}" alt="">
                                        </center>
                                    </div>
                                    <div class="row mb-5">
                        @endif

                        Rentang Nilai:
                        <table class="table mt-3" id="example">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Capaian</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Minimal</th>
                                    <th scope="col">Maksimal</th>
                                    <th scope="col">Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-justify">
                                    <td>101% - 110%</td>
                                    <td>Sangat Baik</td>
                                    <td>110</td>
                                    <td>120</td>
                                    <td>Hasil Kinerja/Perilaku Melampaui Target</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr class="text-justify">
                                    <td>90% - 100%</td>
                                    <td>Baik</td>
                                    <td>90</td>
                                    <td>109</td>
                                    <td>Hasil Kinerja/Perilaku Sesuai Target</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr class="text-justify">
                                    <td>80% - 89%</td>
                                    <td>Cukup</td>
                                    <td>70</td>
                                    <td>89</td>
                                    <td>Hasil Kinerja/Perilaku Sedikit di Bawah Target</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr class="text-justify">
                                    <td>60% - 79%</td>
                                    <td>Kurang</td>
                                    <td>50</td>
                                    <td>69</td>
                                    <td>Hasil Kinerja/Perilaku Jauh di bawah Target</td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr class="text-justify">
                                    <td>0% - 49%</td>
                                    <td>Sangat Kurang</td>
                                    <td>0</td>
                                    <td>49</td>
                                    <td>Hasil Kinerja/Perilaku Hampir Tidak ada</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
