@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Edit Data kegiatan</h5>
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

                        <form class="needs-validation" action="/kegiatan/{{ $kegiatan->id }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="kegiatan_kinerja">Kegiatan Kinerja</label>
                                    <textarea type="kegiatan_kinerja" name="kegiatan_kinerja" class="form-control" id="kegiatan_kinerja"
                                        aria-describedby="kegiatan_kinerja" style="width: 95%">{{ $kegiatan->kegiatan_kinerja }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="jabatan">Jabatan</label>
                                    <select type="jabatan" name="jabatan" class="form-control" style="width: 95%"
                                        id="jabatan" aria-describedby="jabatan">
                                        <option @if ($kegiatan->jabatan == 'Admin') selected @endif value="Admin">Admin
                                        </option>
                                        <option @if ($kegiatan->jabatan == 'Pimpinan') selected @endif value="Pimpinan">Pimpinan
                                        </option>
                                        <option @if ($kegiatan->jabatan == 'Operator') selected @endif value="Operator">Operator
                                        </option>
                                        <option @if ($kegiatan->jabatan == 'Pramubakti') selected @endif value="Pramubakti">
                                            Pramubakti</option>
                                        <option @if ($kegiatan->jabatan == 'Petugas Keamanan') selected @endif value="Petugas Keamanan">
                                            Petugas Keamanan</option>
                                        <option @if ($kegiatan->jabatan == 'Juru Pelihara Cagar Budaya') selected @endif
                                            value="Juru Pelihara Cagar Budaya">Juru
                                            Pelihara Cagar Budaya</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label class="form-label" for="nama_belakang">Target</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="number" name="target_down" class="form-control"
                                                    id="target_down" aria-describedby="target_down" value="{{$kegiatan->target_down}}">
                                                <span class="input-group-text">%</span>
                                                <span class="mt-2 ms-3">-</span>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="number" name="target_up" class="form-control" id="target_up"
                                                    aria-describedby="target_up" value="{{ $kegiatan->target_up }}">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-1">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-light" href="{{ route('kegiatan.index') }}">Batal</a>
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

@push('js')
    <script>
        $('#target_down, #target_up').on('change', function(){
            var up = parseInt($('#target_up').val());
            var down = parseInt($('#target_down').val());
            if($('#target_down').val() > 120){
                $('#target_down').val(120);
                $('#target_up').val(120);
            } else if($('#target_up').val() > 120){
                $('#target_up').val(120);
            } else if(up < down){
                $('#target_up').val(down+1);
            }
        });
    </script>
@endpush
