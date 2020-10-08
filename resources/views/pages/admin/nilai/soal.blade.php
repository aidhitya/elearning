@extends('layouts.admin')

@section('title', 'Dashboard List Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-10 col-lg-9">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Detail Soal Kelas {{ $data->kelas }}{{ $data->kode_kelas }}</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive pt-3">
              <table class="table table-bordered" id="table-soal" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>Jumlah</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data->soals as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->kategori }}</td>
                      <td>{{ $item->nilais_count }}</td>
                      <td>
                        <a href="{{ route('nilai.murid', [$data->id, $data->kelas.'-'.$data->kode_kelas, \Str::slug($item->mapel->nama), $item->mapel->id, Str::slug($item->judul), $item->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  @foreach ($data->soal as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->kategori }}</td>
                      <td>{{ $item->nilais_count }}</td>
                      <td>
                        <a href="{{ route('nilai.murid', [$data->id, $data->kelas.'-'.$data->kode_kelas, \Str::slug($item->mapel->nama), $item->mapel->id, Str::slug($item->judul), $item->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
