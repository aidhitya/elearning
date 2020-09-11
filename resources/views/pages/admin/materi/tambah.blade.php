@extends('layouts.admin')

@section('title', 'Admin - Tambah Kelas')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tambah Mapel</h6>
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
                  <form class="user pt-2" method="POST" action="{{ route('materi.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                      <div class="col-md-6 mb-3 mb-sm-0">
                        <select name="kelas" id="" class="form-control" required>
                          <option value="">Kelas</option>
                          @foreach ($kelas as $item)
                          <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-6 mb-3 mb-sm-0">
                        <select name="mapel" id="" class="form-control" required>
                          <option value="">Mata Pelajaran</option>
                          @foreach ($mapel as $item)
                          <option value="{{ $item->id }}">{{ $item->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" name="judul" class="form-control form-control-user" value="{{ old('judul') }}" placeholder="Judul Materi" required>
                    </div>
                    <div class="form-group">
                      <input type="file" name="file" class="form-control" value="{{ old('file') }}" placeholder="File Materi (pdf)" required>
                    </div>
                    <div class="form-group">
                      <input type="number" min="0" name="pertemuan" class="form-control form-control-user" value="{{ old('pertemuan') }}" placeholder="Pertemuan">
                    </div>
                    <div class="form-group">
                      <input type="text" name="keterangan" class="form-control form-control-user" value="{{ old('keterangan') }}" placeholder="Keterangan">
                    </div>
                    <div class="form-group row">
                      <div class="col-md-8"></div>
                      <div class="col-md-4 mb-sm-0">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Mapel</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            {{-- <div class="col-xl-3 col-lg-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                   
                </div>
              </div>
            </div> --}}
          </div>

    </div>
@endsection