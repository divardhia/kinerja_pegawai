@extends('layouts.app')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h5>Table Kriteria dan Bobot</h5>
                <span>
                    Bobot hanya bisa di submit ketika jumlah bobot mencapai angka 1, tidak bisa lebih atau kurang.
                </span>
                <hr>
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

                <form class="needs-validation" action="{{ route('bobot.update') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @foreach ($kriteria as $item)
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label" for="nama_kriteria">Kriteria {{ $item->id }}</label>
                                <input type="kriteria" name="kriteria" class="form-control" aria-describedby="kriteria"
                                    value="{{ $item->nama_kriteria }}" style="width: 95%" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="bobot">Bobot {{ $item->id }}</label>
                                <input type="bobot" name="bobot-{{ $item->id }}" class="form-control bobot"
                                    style="width: 95%" aria-describedby="bobot" value="{{ $item->bobot }}">
                            </div>
                        </div>
                        <br>
                    @endforeach

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label" for="total-bobot">Total Bobot</label>
                            <input type="total-bobot" name="total-bobot" class="form-control" aria-describedby="kriteria"
                                value="Total Bobot" style="width: 95%" disabled>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="jumlah-bobot">Jumlah Bobot</label>
                            <input type="jumlah-bobot" name="jumlah-bobot" class="form-control" id="jumlah-bobot"
                                aria-describedby="jumlah-bobot" style="width: 95%">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-1">
                            <button class="btn btn-primary" id="edit_button" type="submit">Edit</button>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-light" href="{{ route('bobot.edit') }}">Batal</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var total = 0;

        const totalBobot = () => {
            total = 0;
            $('.bobot').each(function(i, obj) {
                total = (parseFloat(total) + parseFloat($(obj).val())).toFixed(3);
            });
            $('#jumlah-bobot').val(total);
        }

        $(document).ready(function() {
            totalBobot();
        });

        $('.bobot').on('keyup', function() {
            totalBobot();
            if ($('#jumlah-bobot').val() == 1) {
                $('#edit_button').attr('disabled', false);
            } else {
                $('#edit_button').attr('disabled', true);
            }
        });
    </script>
@endpush
