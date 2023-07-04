@extends('layouts.app')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5>Table Penilaian</h5>
                <span>
                    Berisi data Nilai Pegawai, dimana... <br> 
                    C1 = Nilai Kinerja <br>
                    C2 = Orientasi Pelayanan <br>
                    C3 = Komitmen <br>
                    C4 = Inisiatif Kerja <br>
                    C5 = Kerja sama <br>
                </span>
                <hr>
            </div>

            <div class="card-body">
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table" id="example">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">Nama</th>
                                        <th scope="col">nilai Kinerja</th>
                                        <th scope="col">Orientasi Pelayanan</th>
                                        <th scope="col">Komitmen</th>
                                        <th scope="col">Inisiatif Kerja</th>
                                        <th scope="col">Kerja sama</th>
                                        @if (Auth::user()->role == '1' || Auth::user()->role == '4')
                                        <th class="text-center" scope="col" width="350px">Action</th>
                                        @endif  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $item)
                                        <tr class="text-justify">
                                            <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                            <td>{{$item->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first() ? $item->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                            <td>{{$item->pegawai_kriteria->where('id_kriteria', 2)->where('year', date('Y'))->first() ? $item->pegawai_kriteria->where('id_kriteria', 2)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                            <td>{{$item->pegawai_kriteria->where('id_kriteria', 3)->where('year', date('Y'))->first() ? $item->pegawai_kriteria->where('id_kriteria', 3)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                            <td>{{$item->pegawai_kriteria->where('id_kriteria', 4)->where('year', date('Y'))->first() ? $item->pegawai_kriteria->where('id_kriteria', 4)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                            <td>{{$item->pegawai_kriteria->where('id_kriteria', 5)->where('year', date('Y'))->first() ? $item->pegawai_kriteria->where('id_kriteria', 5)->where('year', date('Y'))->first()->nilai : "-"}}</td>
                                            @if (Auth::user()->role == '1' || Auth::user()->role == '4')
                                            <td class="text-center"> <a class="btn btn-primary" href="{{route('pegawai.nilai_kinerja', $item->id)}}"> Input Nilai</a> </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
