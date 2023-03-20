@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Tambah Data</h5>
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

                        <form class="needs-validation" action="{{ route('pegawai.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama_depan">Nama Depan</label>
                                    <input type="nama_depan" name="nama_depan" class="form-control" id="nama_depan"
                                        aria-describedby="nama_depan" value="{{ old('nama_depan') }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="nama_belakang">Nama Belakang</label>
                                    <input type="nama_belakang" name="nama_belakang" class="form-control" id="nama_belakang"
                                        aria-describedby="nama_belakang" value="{{ old('nama_belakang') }}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="email" value="{{ old('email') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        aria-describedby="password" style="width: 95%">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="jabatan">Jabatan</label>
                                    <select type="jabatan" name="jabatan" class="form-control" id="jabatan"
                                        aria-describedby="role">
                                        <option value="Admin">Admin</option>
                                        <option value="Pimpinan">Pimpinan</option>
                                        <option value="Operator">Operator</option>
                                        <option value="Pramubakti">Pramubakti</option>
                                        <option value="Pengemudi">Pengemudi</option>
                                        <option value="Petugas Keamanan">Petugas Keamanan</option>
                                        <option value="Juru Pelihara Cagar Budaya">Juru Pelihara Cagar Budaya</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="role">Role</label>
                                    <select type="role" name="role" class="form-control" id="role"
                                        aria-describedby="role">
                                        <option value="1">Admin</option>
                                        <option value="2">Kepala</option>
                                        <option value="3">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                    </div>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
