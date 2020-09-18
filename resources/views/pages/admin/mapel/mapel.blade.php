@extends('layouts.admin')

@section('title', 'Dashboard Admin - Mapel')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Mapel</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  @if (session('berhasil'))
                      <div class="alert alert-success">
                          {!! session('berhasil') !!}
                      </div>
                  @endif
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="mapel-utama" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="true">Mapel</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="details" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="false">Detail Mapel</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="mapel" role="tabpanel" aria-labelledby="mapel-utama">
                      <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="table-mapel" width="100%" cellspacing="0">
                          @php
                                $n = 1;
                            @endphp
                          <thead>
                              <tr>
                              <th>ID</th>
                              <th>Mapel</th>
                              <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($mapel as $item)
                              <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                  <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                  {{-- <form action="{{ route('mapel.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                  </form> --}}
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="details">
                      <div class="table-responsive pt-3">
                        <table class="table table-bordered" id="table-mapel-detail" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                              @php
                                  $n = 1;
                              @endphp
                                @foreach ($detail as $item)
                                <tr>
                                <td>{{ $n++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }}</td>
                                <td>{{ $item->guru->nama }} {{ $item->guru->guru->pendidikan }}</td>
                                <td>
                                  <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                  <form action="{{ route('mapel.destroy', $item->id) }}" method="POST" class="d-inline">
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

            <!-- Pie Chart -->
            <div class="col-xl-3 col-lg-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Kelas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <a href="{{ route('mapel.create') }}" class="btn btn-primary">Tambah Mapel</a>
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
          $('#table-mapel-detail').DataTable();
      } );
    </script>
@endpush