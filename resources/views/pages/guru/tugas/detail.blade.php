@extends('layouts.guru')

@section('title', 'Dashboard Tugas')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Detail Tugas {{ $tugas->judul_tugas }}</h6>
          </div>
          <div class="card-body">
            @if (session('berhasil'))
                <div class="alert alert-success">
                    {{ session('berhasil') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="table-responsive">
              <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Mengumpulkan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tugas->kumpultugas as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->murid->nama }}</td>
                      <td><a href="{{ asset('storage/'. $item->file) }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-alt-circle-down"></i></a></td>
                      <td>{{ $item->created_at }}</td>
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
      $(document).ready(function() {
          $('#dataTable').DataTable( {
              scrollX: true
          } );
      });
    </script>
@endpush