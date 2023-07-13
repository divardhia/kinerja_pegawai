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
                                        <tr class="text-center text-bold">
                                            <th class="text-center">Kegiatan Kinerja</th>
                                            <th scope="col">Target</th>
                                            <th scope="col">Realisasi</th>
                                            <th scope="col">Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kegiatan as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->kegiatan_kinerja }}</td>
                                                <td>{{ $item->target }}</td>
                                                <td><input type="number" class="form-control" name="realisasi[]"
                                                        id="realisasi" value="{{ $item->realisasi ?? '' }}" required></td>
                                                <td class="kategori-{{ $loop->iteration }}"></td>
                                            </tr>
                                        @endforeach
                                        <tr class="text-center">
                                            <td>Nilai Kinerja</td>
                                            <td>-</td>
                                            <td id="c1">
                                                {{ $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai: '-' }}
                                            </td>
                                            <td class="kategori-{{ count($kegiatan) + 1 }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c2">Orientasi Pelayanan</label>
                                    <input type="number" name="c2" class="form-control" id="c2"
                                        aria-describedby="c2" value="{{ $nilai_kriteria[0] }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_c2">Kategori Orientasi Pelayanan</label>
                                    <input type="text" name="kategori_c2" class="form-control" id="kategori_c2"
                                        aria-describedby="kategori_c2" disabled>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c3">Komitmen</label>
                                    <input type="number" name="c3" class="form-control" id="c3"
                                        style="width: 95%" aria-describedby="c3" value="{{ $nilai_kriteria[1] }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_c3">Kategori Komitmen</label>
                                    <input type="text" name="kategori_c3" class="form-control" id="kategori_c3"
                                        aria-describedby="kategori_c3" disabled>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c4">Inisiatif Kerja</label>
                                    <input type="number" name="c4" class="form-control" id="c4"
                                        aria-describedby="c4" value="{{ $nilai_kriteria[2] }}" style="width: 95%">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_c4">Kategori Inisiatif Kerja</label>
                                    <input type="text" name="kategori_c4" class="form-control" id="kategori_c4"
                                        aria-describedby="kategori_c4" disabled>
                                </div>
                            </div>
                            <br>

                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label" for="c5">Kerja Sama</label>
                                    <input type="number" name="c5" class="form-control" id="c5"
                                        style="width: 95%" aria-describedby="c5" value="{{ $nilai_kriteria[3] }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="kategori_c5">Kategori Kerja Sama</label>
                                    <input type="text" name="kategori_c5" class="form-control" id="kategori_c5"
                                        aria-describedby="kategori_c5" disabled>
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
        // function untuk rentang penilaian
        const rentang_penilaian = (nilai) => {
            if (nilai >= 101 && nilai <= 110) {
                return 'Sangat Baik';
            } else if (nilai >= 90 && nilai <= 100) {
                return 'Baik';
            } else if (nilai >= 80 && nilai <= 89) {
                return 'Cukup';
            } else if (nilai >= 60 && nilai <= 79) {
                return 'Kurang';
            } else {
                return 'Sangat Kurang';
            }
        }

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

        // function get realisasi array
        const array_realisasi = () => {
            var realisasi = $('input[name="realisasi[]"]').map(function() {
                return $(this).val();
            }).get();
            return realisasi;
        }

        // function hitung nilai c1
        const hitungC1 = () => {
            var realisasi = array_realisasi();
            var total = 0;
            var jumlahElemen = realisasi.length;

            // Jumlahkan semua elemen dalam array
            for (var i = 0; i < jumlahElemen; i++) {
                total += parseInt(realisasi[i]);
            }

            // Hitung rata-rata
            var c1 = total / jumlahElemen;
            c1 = c1.toFixed(0);
            $('#c1').text(c1);
            var jumlah = realisasi.length + 1;
            var nameClass = '.kategori-' + jumlah;
            $(nameClass).text(rentang_penilaian(c1));
        }

        // function untuk set kategori realisasi
        const setKategoriRealisasi = () => {
            var realisasi = array_realisasi();
            for (let index = 0; index < realisasi.length; index++) {
                var i = index + 1;
                var className = ".kategori-" + i;
                $(className).text(rentang_penilaian(realisasi[index]));
            }
        }

        // function untuk set kategori kriteria
        const setKategoriC = () => {
            for (let index = 2; index <= 5; index++) {
                var c = $('#c' + index).val();
                $('#kategori_c' + index).val(rentang_penilaian(c));
            }
        }

        $(document).ready(function() {
            // set awal kategori realisasi dan c1
            setKategoriRealisasi();
            var realisasi = array_realisasi();
            var jumlah = realisasi.length + 1;
            var nameClass = '.kategori-' + jumlah;
            $(nameClass).text(rentang_penilaian($('#c1').text()));

            // set awal kategori kriteria
            setKategoriC();
        });

        // saat nilai realisasi diubah
        $('input[name="realisasi[]"]').on('keyup', function() {
            setKategoriRealisasi();
            hitungC1();
        });

        // saat nilai kriteria diubah
        for (let index = 2; index <= 5; index++) {
            $('#c' + index).on('keyup', function() {
                setKategoriC();
            });
        }
    </script>
@endpush
