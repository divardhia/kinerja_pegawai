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
                                        <th scope="col">C1</th>
                                        <th scope="col">C2</th>
                                        <th scope="col">C3</th>
                                        <th scope="col">C4</th>
                                        <th scope="col">C5</th>
                                        <th scope="col" width="350px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaian as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td>
                                                @if (Auth::user()->role == '1')
                                                    <a class="btn btn-primary" href="/admin/penilaian/edit"> Input Nilai</a>
                                                @else
                                                    <a class="btn btn-primary" href="admin/penilaian/{{ $item->id }}">
                                                        <i class="fas fa-eye"></i> Detail </a>
                                                @endif

                                                {{-- <form action="/pegawai/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i>
                                                Delete </button>
                                        </form> --}}
                                            </td>
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
