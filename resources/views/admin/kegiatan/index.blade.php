@extends('layouts.app')
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h5>Table Kegiatan</h5>
            <span>
                Berisi data Kegiatan.
            </span>
            <hr>
        </div>

        <div class="card-body">
            <div class="card-block row">
                <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        @if (Auth::user()->role == '1')
                        <div class="float-start mb-3">
                            <a class="btn btn-primary" href="/kegiatan/create"> Input Data</a>
                        </div>
                        @endif
                        <table class="table" id="example">
                            <thead class="bg-primary">
                                <tr class="text-center">
                                    <th scope="col">Kegiatan Kinerja</th>
                                    <th scope="col">Target</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col" width="350px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $item)
                                <tr class="text-justify">
                                    <td>{{ $item->kegiatan_kinerja }}</td>
                                    <td>{{ $item->target }}</td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td class="text-center">
                                        @if (Auth::user()->role == '1')
                                        <a class="btn btn-primary" href="/kegiatan/{{ $item->id }}"> <i
                                                class="fas fa-eye"></i> Detail </a>

                                        <a class="btn btn-primary" href="/kegiatan/{{ $item->id }}/edit"> <i
                                                class="fas fa-pen"></i> Edit </a>
                                        {{-- @else
                                        <a class="btn btn-primary" href="/kegiatan_kepala/{{ $item->id }}"> <i
                                                class="fas fa-eye"></i> Detail </a> --}}
                                        @endif
                                        <form action="/kegiatan/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger mt-2"
                                                onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i>
                                                Delete </button>
                                        </form>
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
    $(function () {
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