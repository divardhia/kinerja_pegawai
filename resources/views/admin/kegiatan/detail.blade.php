@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Detail Kinerja</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Kegiatan Kinerja: </b>{{ $kegiatan->kegiatan_kinerja }}</li>
                            <li class="list-group-item"><b>Target: </b>{{ $kegiatan->target }}</li>
                            <li class="list-group-item"><b>Jabatan: </b>{{ $kegiatan->jabatan }}</li>
                        </ul>
                    </div>
                    <br>
                    @if (Auth::user()->role == '1')
                        <a class="btn btn-success mt-3" href="/kegiatan">Kembali</a>
                    @else
                        <a class="btn btn-success mt-3" href="/kegiatan_kepala">Kembali</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
