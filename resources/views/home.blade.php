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
                    <div class="text-center">Silahkan pilih menu pada sidebar {{Auth::user()->name}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus dicta, iste et odit illum magnam repellendus nesciunt eius delectus quam quas error labore dolores laudantium, sapiente corrupti eos, nobis inventore?
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
