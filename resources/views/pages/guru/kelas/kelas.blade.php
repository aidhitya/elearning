@extends('layouts.guru')

@section('title', 'Dashboard Guru - Kelas')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">{{ $data->nama }} / {{ $data->kelas->kelas }}{{ $data->kelas->kode_kelas }}</h6>
            <h6 class="m-0 text-white">Jumlah Siswa : <span class="font-weight-bold">{{ count($data->kelas->murids) }}</span></h6>
            <h6 class="m-0 text-white">Wali Kelas : <span class="font-weight-bold">{{ $data->kelas->wali_kelas->nama }} {{ $data->kelas->wali_kelas->guru->pendidikan }}</span></h6>
            <a href="{{ route('mapel.nilai.export',[$data->parent_id, $data->kelas->id]) }}" class="btn btn-md btn-primary m-0 font-weight-bold text-white border-white">Nilai <i class="fas fa-arrow-circle-down"></i></a>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataMurid" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Foto</th>
                          <th>Jenkel</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($data->kelas->murids as $item)
                          <tr>
                            <td>{{ $item->nis }}</td>
                            <td>{{ $item->user->nama }}</td>
                            <td><img src="{{ $item->foto }}" alt="" class="img-fluid img-thumbnail" style="width: 150px;"></td>
                            <td>{{ $item->jenkel }}</td>
                            <td><a href="#"><i class="fas fa-eye"></i></a></td>
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
      $('#dataMurid').dataTable();
    })
  </script>
@endpush