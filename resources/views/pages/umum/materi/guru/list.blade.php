@extends('layouts.guru')

@section('title', 'Dashboard Materi')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Materi Kelas {{ $detail->kelas }}{{ $detail->kode_kelas }}</h6>
                  <a href="{{ route('materi.create', $detail->kelas.'-'.$detail->kode_kelas) }}" class="btn btn-primary">Tambah+</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  @if (session('berhasil'))
                      <div class="alert alert-success">
                          {{ session('berhasil') }}
                      </div>
                  @endif
                  <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="materi-utama" data-toggle="tab" href="#materi" role="tab" aria-controls="materi" aria-selected="true">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="materi-tambahan" data-toggle="tab" href="#tambahan" role="tab" aria-controls="tambahan" aria-selected="false">Tambahan</a>
                        </li>
                    </ul>
                  </div>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="materi" role="tabpanel" aria-labelledby="materi-utama">
                      <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="table-materi" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                              <th>Pertemuan</th>
                              <th>Judul</th>
                              <th>File</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($detail->materi as $item)
                              <tr>
                                <td>{{ $item->pertemuan }}</td>
                                <td>{{ $item->judul }}</td>
                                <td><a href="{{ asset('storage/'. $item->file) }}" class="btn btn-primary"><i class="fas fa-arrow-circle-down"></i></a></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="tambahan" role="tabpanel" aria-labelledby="materi-tambahan">
                      <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="table-materi-tambahan" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>File</th>
                            <th>URL</th>
                            <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($detail->materis as $key => $item)
                              <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                  @if (!is_null($item->file))
                                    <a href="{{ asset('storage/'. $item->file) }}" class="btn btn-primary"><i class="fas fa-arrow-circle-down"></i></a> 
                                  @endif
                                </td>
                                <td>
                                  @if (!is_null($item->url))
                                    <a href="{{ $item->url }}">Link</i></a> 
                                  @endif
                                </td>
                                <td>
                                  <a href="{{ route('materi.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                  <form action="{{ route('materi.destroy', $item->id) }}" method="POST" class="d-inline ml-2">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                  </form>
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

    </div>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function(){
      $('#table-materi').dataTable();
      $('#table-materi-tambahan').dataTable();
    })
  </script>
@endpush