@extends('layouts.app')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5>Nilai Pegawai</h5>
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
                        <h4>Detail Nilai Kinerja</h4>
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
                                            <td>{{ $item->realisasi ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="text-center">
                                        <td>Nilai Akhir Kinerja</td>
                                        <td>-</td>
                                        <td>{{ $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai: '-' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <br>

                        <h4>Nilai Semua Kriteria</h4>
                        <div class="table-responsive">
                            <table class="table" id="nilai">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th class="text-center">Kriteria</th>
                                        <th scope="col">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai_kriteria as $item)
                                        <tr class="text-center">
                                            <td>{{ $item['nama_kriteria'] }}</td>
                                            <td>{{ $item['nilai'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('cetak.nilai.pegawai')}}" class="btn btn-primary">Cetak</a>
            </div>
        </div>
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

        $(function() {
            $('#nilai').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
