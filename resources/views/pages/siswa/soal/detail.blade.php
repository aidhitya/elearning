@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List Soal {{ $soal->nama }}</h6>
            </div>
            <div class="justif-content-center m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-mapel" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Kategori</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Mengerjakan</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal->soals as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->mulai }}</td>
                                    <td>{{ $item->selesai }}</td>
                                    <td class="justify-content-between">
                                        @foreach ($item->nilais as $t)
                                            <p class="m-0">{{ $t->created_at }}</p>
                                        @endforeach
                                    </td>
                                    <td>
                                      @if (count($item->nilais) == 2)
                                      <a href="{{ route('murid.soal', [strtolower($item->kategori), \Str::slug($soal->nama), $item->id]) }}" class="btn btn-sm btn-primary">Nilai</a>
                                      @elseif (count($item->nilais) == 1)
                                        @foreach ($item->nilais as $s)
                                            <a href="{{ route('get.nilai.pdf', [strtolower($item->kategori), \Str::slug($item->mapel->nama), $item->id, $s->percobaan]) }}" class="m-2 btn btn-sm btn-primary">Nilai {{ $s->percobaan }}</a>
                                        @endforeach
                                      @endif
                                    <a href="{{ route('murid.soal', [strtolower($item->kategori), \Str::slug($soal->nama), $item->id]) }}" class="btn btn-sm btn-primary {{ ($item->selesai < now() || $item->mulai > now()) ? 'disabled' : (($item->kategori == 'UAS' || $item->kategori == 'UTS') ? (count($item->nilais) >= 1 ? 'disabled' : '') : (count($item->nilais) >= 2 ? 'disabled' : '' )) }}">Kerjakan</a>
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

@push('addon-script')
  <script>
    $(document).ready( function () {
        $('#table-mapel').DataTable();
    });
  </script>
@endpush
