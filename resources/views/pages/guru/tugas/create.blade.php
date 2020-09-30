@extends('layouts.guru')

@section('title', 'Dashboard Guru - Tambah Profile')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Guru</h6>
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
                <form class="user" action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <select name="kelas_id" class="form-control" id="kelas" required>
                                <option value="0" id="zonk">Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas_id }}">{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }} - {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="judul_tugas" class="form-control form-control-user" value="{{ old('judul_tugas') }}" placeholder="Judul Tugas" required>
                    </div>
                    <div class="form-group">
                        <textarea name="deskripsi" cols="30" class="form-control" placeholder="Deskripsi Tugas" required>{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" id="file" name="file" class="form-control form-control-file" value="{{ old('file') }}">
                    </div>
                    <div class="form-group">
                        <label for="mulai">Mulai</label>
                        <input type="datetime-local" id="mulai" name="mulai" class="form-control form-control-user" value="{{ old('mulai') }}" placeholder="Mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Selesai</label>
                        <input type="datetime-local" id="selesai" name="selesai" class="form-control form-control-user" value="{{ old('selesai') }}" placeholder="Selesai" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Tambah</button>
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