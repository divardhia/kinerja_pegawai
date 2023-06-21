@extends('layouts.app')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5>Hasil Penilaian Jabatan {{$jabatan}} {{$year}}</h5>
                <span>
                    Berisi hasil penilaian seluruh pegawai dengan jabatan {{$jabatan}} tahun {{$year}}.
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
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Rangking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->nilai_akhir }}</td>
                                            <td>{{$item->rank}}</td>
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
                order: [[2, 'asc']],
            });
        });
    </script>
@endpush
