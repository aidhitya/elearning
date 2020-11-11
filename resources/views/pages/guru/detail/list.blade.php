@extends('layouts.guru')

@section('title', 'Dashboard Detail Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-10 col-lg-9">
        <div class="card shadow mb-4 border-info">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">List Detail Soal Kelas {{ $data->kelas }}{{ $data->kode_kelas }}</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive pt-3">
              <table class="table table-bordered" id="table-soal" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>Jumlah</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data->soals as $key => $item)
                    <tr>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->kategori }}</td>
                      <td>{{ $item->nilais_count }}</td>
                      <td>
                        <a href="{{ route('detail.soal.murid', [$data->id, $item->id, \Str::slug($item->judul)]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"> Detail</i></a>
                        <a href="{{ route('soal.nilai.export', [$item->id, $data->id]) }}" class="btn btn-sm btn-info"><i class="far fa-arrow-alt-circle-down"></i> Nilai</a>
                      </td>
                    </tr>
                  @endforeach
                  @foreach ($data->soal as $key => $item)
                    <tr>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->kategori }}</td>
                      <td>{{ $item->nilais_count }}</td>
                      <td>
                        <a href="{{ route('detail.soal.murid', [$data->id, $item->id, \Str::slug($item->judul)]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"> Detail</i></a>
                        <a href="{{ route('soal.nilai.export', [$item->id, $data->id]) }}" class="btn btn-sm btn-info"><i class="far fa-arrow-alt-circle-down"></i> Nilai</a>
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
@endsection

@push('addon-script')
  <script>
    $(document).ready(function(){
      $('#table-soal').dataTable();
    })  
  </script>
@endpush
