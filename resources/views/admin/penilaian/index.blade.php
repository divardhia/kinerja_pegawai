@extends('layouts.app')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-sm-6">
                <div class="card mt-3">
                    <div class="card-header pb-0">
                        <h5>Penilaian Pegawai</h5>
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

                        <form class="needs-validation" action="{{ route('penilaian.nilai') }}" method="get"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="year">Year</label>
                                <input type="text" name="year" class="form-control" id="year"
                                    aria-describedby="year" required>
                            </div>
                            <br>

                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    </div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
         $("#year").datepicker( {
            format: "yyyy",
            startView: "years", 
            minViewMode: "years"
        });
    </script>
@endpush