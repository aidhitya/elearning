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
                  <h6 class="m-0 font-weight-bold text-primary">Edit Mapel</h6>
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
                    @if ($edit->parent_id == null)
                        <li class="nav-item">
                            <a class="nav-link active" id="new-mapel" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="true">Mapel Baru</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" id="mapel-kelas" data-toggle="tab" href="#mapelkelas" role="tab" aria-controls="mapelkelas" aria-selected="false">Mapel - Kelas</a>
                        </li>
                    @endif
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    @if ($edit->parent_id == null)

                        <div class="tab-pane fade show active" id="mapel" role="tabpanel" aria-labelledby="new-mapel">
                            <form class="user pt-2" method="POST" action="{{ route('mapel.update', $edit->id) }}">
                                @csrf @method('PUT')
                                <div class="form-group">
                                    <div class="mb-3 mb-sm-0">
                                    <label for="mapel">Mata Pelajaran</label>
                                        <input type="text" id="mapel" name="nama" class="form-control form-control-user" value="{{ $edit->nama }}" placeholder="Nama Mapel" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4 mb-sm-0">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Update Mapel</button>
                                </div>
                                </div>
                            </form>
                        </div>

                    @else

                        <div class="tab-pane fade show active" id="mapelkelas" role="tabpanel" aria-labelledby="mapel-kelas">
                            <form class="user pt-2" method="POST" action="{{ route('mapel.update', $edit->id) }}">
                                @csrf @method('PUT')
                                @include('pages.admin.mapel.includes.selects')
                                <div class="form-group row">
                                <div class="col-md-8"></div>
                                <div class="col-md-4 mb-sm-0">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Update Mapel</button>
                                </div>
                                </div>
                            </form>
                        </div>

                    @endif
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