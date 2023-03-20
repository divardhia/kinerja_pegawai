@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Detail Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Nama Depan: </b>{{ $pegawai->nama_depan }}</li>
                            <li class="list-group-item"><b>Nama Belakang: </b>{{ $pegawai->nama_belakang }}</li>
                            <li class="list-group-item"><b>Jabatan: </b>{{ $pegawai->jabatan }}</li>
                            <li class="list-group-item"><b>Nama Lengkap: </b>{{ $pegawai->nama_depan }}
                                {{ $pegawai->nama_belakang }}</li>
                            <li class="list-group-item"><b>Role: </b>
                                @if ($pegawai->user->role == '1')
                                    Admin
                                @elseif ($pegawai->user->role == '2')
                                    Kepala
                                @else
                                    Pegawai
                                @endif
                            </li>
                        </ul>
                    </div>
                    <br>
                    @if (Auth::user()->role == '1')
                        <a class="btn btn-success mt-3" href="/pegawai">Kembali</a>
                    @else
                        <a class="btn btn-success mt-3" href="/pegawai_kepala">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
