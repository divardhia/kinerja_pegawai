@extends('layouts.app')
@section('content')
    <div class="col-sm-12">
        <form class="needs-validation" action="{{ route('pegawai.nilai_kinerja.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header pb-0">
                    <h5>Input Nilai Kinerja</h5>
                    <span>
                        Nama Pegawai : {{ $pegawai->user->name }}
                    </span>
                    <span>Jabatan : {{ $pegawai->jabatan }}</span>
                    <hr>
                    <span>
                        Keterangan kriteria penilaian <br>
                        C1 = Nilai Kinerja <br>
                        C2 = Orientasi Pelayanan <br>
                        C3 = Komitmen <br>
                        C4 = Inisiatif Kerja <br>
                        C5 = Kerja sama <br>
                    </span>
                    <hr>
                </div>
                <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $pegawai->id }}">

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
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table" id="example">
                                    <thead class="bg-primary">
                                        <tr class="text-center">
                                            <th class="text-center">Kegiatan Kinerja</th>
                                            <th scope="col">Target</th>
                                            <th scope="col">Realisasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->kegiatan_kinerja }}</td>
                                                <td>{{ $item->target }}</td>
                                                <td><input type="number" class="form-control" name="realisasi[]"
                                                        id="realisasi" value="{{ $item->realisasi ?? '' }}" required></td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-center">
                                            <td>Nilai Akhir C1</td>
                                            <td>-</td>
                                            <td>{{$pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first() ? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c2">C2</label>
                                    <input type="number" name="c2" class="form-control" id="c2"
                                        aria-describedby="c2" value="{{ $nilai_kriteria[0] }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="c3">C3</label>
                                    <input type="number" name="c3" class="form-control" id="c3"
                                        aria-describedby="c3" value="{{ $nilai_kriteria[1] }}">
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c4">C4</label>
                                    <input type="number" name="c4" class="form-control" id="c4"
                                        aria-describedby="c4" value="{{ $nilai_kriteria[2] }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="c5">C5</label>
                                    <input type="number" name="c5" class="form-control" id="c5"
                                        aria-describedby="c5" value="{{$nilai_kriteria[3]}}">
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $('#realisasi').on('change', function() {
            if ($(this).val() > 120) {
                $(this).val(120);
            }
        });
    </script>
@endpush
