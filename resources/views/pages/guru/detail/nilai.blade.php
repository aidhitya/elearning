@extends('layouts.guru')

@section('title', 'Dashboard Detail Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Detail Nilai Soal Kelas {{ $nilai->speckelas->kelas ?? $nilai->kelas }}{{ $nilai->speckelas->kode_kelas ?? '' }}</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive pt-3">
              <table class="table table-bordered" id="table-nilai" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Percobaan</th>
                  <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($nilai->nilais as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->murid->nama }}</td>
                        <td>{{ $item->percobaan }}</td>
                        <td>{{ $item->nilai }}</td>
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
      $('#table-nilai').dataTable();
    })  
  </script>
@endpush
