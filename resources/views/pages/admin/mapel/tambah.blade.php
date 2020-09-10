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
                  {{-- /* */ --}}
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="new-mapel" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="true">Mapel Baru</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="mapel-kelas" data-toggle="tab" href="#mapelkelas" role="tab" aria-controls="mapelkelas" aria-selected="false">Mapel - Kelas</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="mapel" role="tabpanel" aria-labelledby="new-mapel">
                      <form class="user pt-2" method="POST" action="{{ route('mapel.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="mb-3 mb-sm-0">
                              <label for="mapel">Mata Pelajaran</label>
                                <input type="text" id="mapel" name="nama" class="form-control form-control-user" value="{{ old('nama') }}" placeholder="Nama Mapel" required>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-8"></div>
                          <div class="col-md-4 mb-sm-0">
                            <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Mapel</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="tab-pane fade" id="mapelkelas" role="tabpanel" aria-labelledby="mapel-kelas">
                      <form class="user pt-2" method="POST" action="{{ route('mapel.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                              <label for="parent">Mapel</label>
                              <select name="parent" id="parent" class="form-control">
                                <option value="">Mapel</option>
                                @foreach ($mapel as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                              <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control">
                                <option value="">Kelas</option>
                                @foreach ($kelas as $item)
                                  <option value="{{ $item->id }}">{{ $item->kelas }} {{ $item->kode_kelas }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                              <label for="guru">Guru</label>
                                <select name="guru" id="guru" class="form-control">
                                <option value="">Guru</option>
                                @foreach ($guru as $item)
                                  <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->guru->pendidikan }}</option>
                                @endforeach
                              </select>
                            </div>
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
                  {{-- // --}}
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