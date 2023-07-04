@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Data Pegawai</h5>
                    </div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="needs-validation" action="/pegawai/{{ $pegawai->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_depan">Nama Depan</label>
                                    <input type="nama_depan" name="nama_depan" class="form-control" id="nama_depan"
                                        aria-describedby="nama_depan" value="{{ $pegawai->nama_depan }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                    <input type="nama_belakang" name="nama_belakang" class="form-control" id="nama_belakang"
                                        style="width: 95%" aria-describedby="nama_belakang"
                                        value="{{ $pegawai->nama_belakang }}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        style="width: 95%" aria-describedby="email" value="{{ $pegawai->user->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="jabatan">Jabatan</label>
                                    <select type="jabatan" name="jabatan" class="form-control" style="width: 95%"
                                        id="jabatan" aria-describedby="jabatan">
                                        <option @if ($pegawai->jabatan == 'Admin') selected @endif value="Admin">Admin
                                        </option>
                                        <option @if ($pegawai->jabatan == 'Pimpinan') selected @endif value="Pimpinan">Pimpinan
                                        </option>
                                        <option @if ($pegawai->jabatan == 'Operator') selected @endif value="Operator">Operator
                                        </option>
                                        <option @if ($pegawai->jabatan == 'Pramubakti') selected @endif value="Pramubakti">
                                            Pramubakti</option>
                                        <option @if ($pegawai->jabatan == 'Petugas Keamanan') selected @endif value="Petugas Keamanan">
                                            Petugas Keamanan</option>
                                        <option @if ($pegawai->jabatan == 'Juru Pelihara Cagar Budaya') selected @endif
                                            value="Juru Pelihara Cagar Budaya">Juru
                                            Pelihara Cagar Budaya</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="role">Role</label>
                                            <select type="role" name="role" class="form-control" id="role"
                                                style="width: 95%" aria-describedby="role">
                                                <option @if ($pegawai->user->role == 1) selected @endif value="1">
                                                    Admin</option>
                                                <option @if ($pegawai->user->role == 2) selected @endif value="2">
                                                    Kepala</option>
                                                <option @if ($pegawai->user->role == 3) selected @endif value="3">
                                                    Pegawai</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="status">Status</label>
                                    <select type="status" name="status" class="form-control" id="status"
                                        style="width: 95%" aria-describedby="status">
                                        <option @if ($pegawai->status == true) selected @endif value="1">
                                            Aktif</option>
                                        <option @if ($pegawai->status == false) selected @endif value="0">
                                            Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-light" href="{{ route('pegawai.index') }}">Batal</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
