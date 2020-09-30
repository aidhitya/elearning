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
                <form class="user" action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-6 mb-3 mb-sm-0">
                            <select name="kelas_id" class="form-control" id="kelas" required>
                                <option value="{{ $tugas->kelas_id }}" id="zonk" selected>{{ $tugas->kelas->kelas }}{{ $tugas->kelas->kode_kelas }} - {{ $tugas->mapel->nama }}</option>
                                <option value="" id="zonk">-</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas_id }}">{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }} - {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="judul_tugas" class="form-control form-control-user" value="{{ $tugas->judul_tugas }}" placeholder="Judul Tugas" required>
                    </div>
                    <div class="form-group">
                        <textarea name="deskripsi" cols="30" class="form-control" placeholder="Deskripsi Tugas" required>{{ $tugas->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" id="file" name="file" class="form-control form-control-file">
                        @if ($tugas->file !== null)
                            <iframe src="{{ asset('storage/'.$tugas->file) }}" width="100%" height="500px"></iframe>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="mulai">Mulai</label>
                        <input type="datetime-local" id="mulai" name="mulai" class="form-control form-control-user" value="{{ date('Y-m-d\TH:i', strtotime($tugas->mulai)) }}" placeholder="Mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Selesai</label>
                        <input type="datetime-local" id="selesai" name="selesai" class="form-control form-control-user" value="{{ date('Y-m-d\TH:i', strtotime($tugas->selesai)) }}" placeholder="Selesai" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection