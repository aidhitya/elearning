<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/pdf.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    {{-- <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700|Lato:300,400,700" rel="stylesheet"> --}}


</head>

<body width="100%" style="margin: 0; padding: 0 !important; background-color: #FFFFFF !important;">
    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
        <tr>
            <th class="text-center">
                <div class="d-inline">
                    <img src="{{ asset('assets/images/login.png') }}" class="rounded mb-3 mt-3">
                </div>
                <h4>SMPN 4 PEMALANG</h4>
                <h6>Jl. Sumbing No. 2 Pemalang, Mulyoharjo, Kec. Pemalang, Kab. Pemalang Prov. Jawa Tengah</h6>
            </th>
        </tr>
        <tr>
            <td class="bg-white email-section">
                <div class="heading-section" style="text-align: center; padding: 0 30px; margin-top: 15px">
                    <h4>Terima Kasih Anda Telah Mengikuti Ujian Online</h4>
                </div>
            </td>
        </tr>
        <!-- end: tr -->
        <tr>
            <td class="bg_white">
                <table class="table table-bordered" style="width: 90%;">
                    <tr>
                        <th>NIS : </th>
                        <td>{{ $checker->murid->murid->nis }}</td>
                    </tr>
                    <tr>
                        <th>Nama :</th>
                        <td>{{ $checker->murid->nama }}</td>

                    </tr>
                    <tr>
                        <th>Mata Pelajaran :</th>
                        <td>{{ $checker->nilaiable->mapel->nama }}</td>
                    </tr>
                    <tr>
                        <th>Soal :</th>
                        <td>{{ $checker->nilaiable->judul }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Ujian :</th>
                        <td>{{ $checker->nilaiable->created_at }}</td>
                    </tr>
                    <tr>

                        <th>Jumlah Soal :</th>
                        <td>{{ $checker->nilaiable->detail_soal_count }}</td>
                    </tr>
                    <tr>

                        <th>Jumlah Jawab Benar :</th>
                        <td>
                            @php
                                $b = 0;
                                foreach ($checker->checker as $item) {
                                   if ($item->jawaban->kunci == 1) {
                                       $b++;
                                   }
                                }

                                echo $b;
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Jawab Salah :</th>
                        <td>
                            @php
                                $s = 0;
                                foreach ($checker->checker as $item) {
                                   if ($item->jawaban->kunci == 0) {
                                       $s++;
                                   }
                                }

                                echo $s;
                            @endphp
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <div style="page-break-after: always"></div>
            </td>
        </tr>
    </table>

        <table class="table table-bordered" style="width: 90%; background-color:#FFFFFF; margin-top: 40px !important;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jawaban Anda</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checker->checker as $key => $check)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $check->jawaban->jawaban }}</td>
                        <td>{{ $check->jawaban->kunci == 1 ? 'B' : 'S' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>