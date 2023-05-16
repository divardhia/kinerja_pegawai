@extends('layouts.app')
@section('content')
<div class="col-sm-12">
    <form class="needs-validation" action="{{ route('pegawai.nilai_kinerja.store') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header pb-0">
                <h5>Input Nilai Kinerja</h5>
                <span>
                    Nama Pegawai : {{$pegawai->user->name}}
                </span>
                <span>Jabatan : {{$pegawai->jabatan}}</span>
                <hr>
            </div>
            <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{$pegawai->id}}">
    
            <div class="card-body">
                <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            <table class="table" id="example">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th scope="col">Kegiatan Kinerja</th>
                                        <th scope="col">Target</th>
                                        <th scope="col">Realisasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatan as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->kegiatan_kinerja }}</td>
                                        <td>{{ $item->target }}</td>
                                        <td><input type="number" class="form-control" name="realisasi[]" id="realisasi" value="{{$item->realisasi ?? ""}}" required></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
    $(function () {
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

    $('#realisasi').on('change', function(){
        if($(this).val() > 120){
            $(this).val(120);
        }
    });
</script>
@endpush