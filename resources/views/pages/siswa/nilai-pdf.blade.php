<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>NILAI</title>
    <style>
    .page-break {
        page-break-after: always;
    }
    .none {
        border: none !important;
    }
</style>
</head>
<body>
    <div id="wrapper" class="mt-3">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <table class="table-striped none" cellspacing="0" cellpadding="0" style="width: 550px">
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">NIS
                                <span style="padding-left: 105px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ $checker->murid->murid->nis }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">NAMA
                                <span style="padding-left: 81px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ $checker->murid->nama }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">KELAS
                                <span style="padding-left: 84px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ $checker->murid->murid->kelas->kelas }}{{ $checker->murid->murid->kelas->kode_kelas }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">TANGGAL
                                <span style="padding-left: 57px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ now() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">UJIAN
                                <span style="padding-left: 84px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ $checker->nilaiable->judul }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="font-weight-bold ml-2">JUMLAH SOAL
                                <span style="padding-left: 20px">:</span>
                            </span>
                            <span class="text-uppercase ml-3">{{ $checker->nilaiable->detail_soal_count }}</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="page-break"></div>
            <div class="table-responsive">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Jawaban</th>
                                <th scope="col">Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checker->checker as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->jawaban->jawaban }}</td>
                                        <td>{{ $item->jawaban->kunci == 1 ? 'B' : 'S' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>