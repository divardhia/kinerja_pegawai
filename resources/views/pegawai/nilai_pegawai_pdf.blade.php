<!DOCTYPE html>
<html lang="">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/viho/assets/css/fontawesome.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous">
    </script>
    <title>Data Nilai Pegawai {{ $pegawai->user->name }} Tahun {{ $year_now }}</title>
</head>

<body>
    <div class="text-center mb-5">
        <h3>LAPORAN NILAI PEGAWAI {{ $year_now }}</h3>
    </div>
    <h4 class="text-start mb-3">Biodata Pegawai</h4>
    <table>
        <tr>
            <td style="width: 25%">
                <div class="text-start mb-3">Nama</div>
            </td>
            <td>
                <div class="text-start mb-3">: {{ $pegawai->user->name }}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 25%">
                <div class="text-start mb-3">Jabatan</div>
            </td>
            <td>
                <div class="text-start mb-3">: {{ $pegawai->jabatan }}</div>
            </td>
        </tr>
    </table>

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

    <h4 class="text-start mb-3">Detail Nilai Kinerja</h4>
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kegiatan Kinerja</th>
                    <th>Target</th>
                    <th>Realisasi</th>
                </tr>
            </thead>
            @foreach ($kegiatan as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kegiatan_kinerja }}</td>
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->realisasi ?? '-' }}</td>
                </tr>
            @endforeach
            <tr class="text-center">
                <td colspan="2">Nilai Akhir Kinerja</td>
                <td>-</td>
                <td>{{ $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()? $pegawai->pegawai_kriteria->where('id_kriteria', 1)->where('year', date('Y'))->first()->nilai: '-' }}
                </td>
            </tr>
        </table>
    </div>

    <h4 class="text-start mb-3">Nilai Semua Kriteria</h4>
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            @foreach ($nilai_kriteria as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['nama_kriteria'] }}</td>
                    <td>{{ $item['nilai'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <br><br>
    <div class="container-fluid">
        <table style="width: 100%">
            <tr>
                <td class="col-9">
                    <div class="text-start">Mengetahui</div>
                    <br><br><br><br>
                    <div class="text-start">{{ $pegawai->user->name }}</div>
                </td>
                <td class="col-3">
                    <div class="text-start">Menyetujui</div>
                    <br><br><br><br>
                    <div class="text-start">{{ $pimpinan->name }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
