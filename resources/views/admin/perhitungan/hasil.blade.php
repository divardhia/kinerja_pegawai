@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card mt-3">
                    <div class="card-header pb-0">
                        <h5>Hasil Perhitungan Moora</h5>
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
                        <div class="span">Jabatan : {{$jabatan}}</div>
                        <div class="span">Tahun : {{$year}}</div>
                        <hr>

                        <h2>Matriks Keputusan</h2>
                        <div class="table-responsive">
                            <table class="table" id="matriks">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai Kinerja</th>
                                        <th scope="col">Orientasi Pelayanan</th>
                                        <th scope="col">Komitmen</th>
                                        <th scope="col">Iniaiatif Kerja</th>
                                        <th scope="col">Kerjasama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriks as $item)
                                        <tr class="text-center">
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{$item['c1']}}</td>
                                            <td>{{$item['c2']}}</td>
                                            <td>{{$item['c3']}}</td>
                                            <td>{{$item['c4']}}</td>
                                            <td>{{$item['c5']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <h2>Normalisasi</h2>
                        <div class="table-responsive">
                            <table class="table" id="normalisasi">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai Kinerja</th>
                                        <th scope="col">Orientasi Pelayanan</th>
                                        <th scope="col">Komitmen</th>
                                        <th scope="col">Iniaiatif Kerja</th>
                                        <th scope="col">Kerjasama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalisasi as $item)
                                        <tr class="text-center">
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{$item['c1']}}</td>
                                            <td>{{$item['c2']}}</td>
                                            <td>{{$item['c3']}}</td>
                                            <td>{{$item['c4']}}</td>
                                            <td>{{$item['c5']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <h2>Normalisasi Terbobot</h2>
                        <div class="table-responsive">
                            <table class="table" id="normalisasi_terbobot">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nilai Kinerja</th>
                                        <th scope="col">Orientasi Pelayanan</th>
                                        <th scope="col">Komitmen</th>
                                        <th scope="col">Iniaiatif Kerja</th>
                                        <th scope="col">Kerjasama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalisasi_terbobot as $item)
                                        <tr class="text-center">
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{$item['c1']}}</td>
                                            <td>{{$item['c2']}}</td>
                                            <td>{{$item['c3']}}</td>
                                            <td>{{$item['c4']}}</td>
                                            <td>{{$item['c5']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
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
            $('#matriks').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $(function() {
            $('#normalisasi').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });

        $(function() {
            $('#normalisasi_terbobot').DataTable({
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