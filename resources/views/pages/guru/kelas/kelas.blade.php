@extends('layouts.guru')

@section('title', 'Dashboard Guru - Kelas')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-10 col-lg-9">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">{{ $data->nama }} / {{ $data->kelas->kelas }}{{ $data->kelas->kode_kelas }}</h6>
                  <h6 class="m-0 text-primary">Jumlah Siswa : <span class="font-weight-bold">{{ count($data->kelas->murids) }}</span></h6>
                  <h6 class="m-0 text-primary">Wali Kelas : <span class="font-weight-bold">{{ $data->kelas->wali_kelas->nama }} {{ $data->kelas->wali_kelas->guru->pendidikan }}</span></h6>
                </div>
                <!-- Card Body -->
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

            {{-- <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Kelas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div> --}}

    </div>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function(){
      $('#dataMurid').dataTable();
    })
  </script>
@endpush