@extends('layouts.guru')

@section('title', 'Tambah Materi Tambahan')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-11 col-lg-10">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Materi Kelas {{ $materi->kelas_spec->kelas }}{{ $materi->kelas_spec->kode_kelas }}</h6>
                  <h6 class="m-0 font-weight-bold text-primary">{{ $materi->mapel->nama }}</h6>
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
                  <form class="user pt-2" method="POST" action="{{ route('materi.update', $materi->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <input type="hidden" name="kelas" value="{{ $materi->kelas_spec->id }}">
                    <input type="hidden" name="kode" value="{{ $materi->kelas_spec->kode_kelas }}">
                    <div class="form-group">
                      <input type="text" name="judul" class="form-control form-control-user" value="{{ $materi->judul }}" placeholder="Judul Materi" required>
                    </div>
                    <div class="form-group">
                      <input type="text" name="url" class="form-control form-control-user" value="{{ $materi->url }}" placeholder="URL Materi">
                    </div>
                    <div class="form-group">
                      <input type="file" name="file" class="form-control mb-2" value="{{ old('file') }}" placeholder="File Materi (pdf)">
                      @if (!is_null($materi->file))
                        <iframe src="{{ asset('storage/'.$materi->file) }}" width="100%" height="500px"></iframe>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="text" name="keterangan" class="form-control form-control-user" value="{{ $materi->keterangan }}" placeholder="Keterangan">
                    </div>
                    <div class="form-group row">
                      <div class="col-md-8"></div>
                      <div class="col-md-4 mb-sm-0">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Edit Materi</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection