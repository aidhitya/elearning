@extends('layouts.siswa')

@section('title', 'Dashboard Tugas Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark">Detail Tugas</h6>
                  <h6 class="m-0 font-weight-bold text-dark">{{ $tugas->mapel->nama }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-dark">{{ $tugas->judul_tugas }}</h5>
                        <form action="{{ route('murid.kumpul.tugas', [$tugas->id, \Str::slug($tugas->judul_tugas)]) }}" class="form-inline" method="POST" enctype="multipart/form-data">
                          @csrf
                            <div class="col">
                                <label class="sr-only" for="file">File</label>
                                <input type="file" name="file" class="form-control form-control-file mb-2 mr-sm-2" id="file">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mb-2" {{ $tugas->selesai < now() ? 'disabled' : ($tugas->nilais[0] !== NULL ? 'disabled' : '') }}>Upload</button>
                        </form>
                    </div>
                    <div class="card mt-3">
                        <p class="text-dark text-justify m-4">
                            {{ $tugas->deskripsi }}
                        </p>
                    @if ($tugas->file !== null)
                    <p class="text-dark text-justify">
                      Download File Tugas : 
                      <a href="{{ asset('storage/'. $tugas->file) }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-alt-circle-down"></i></a>
                    </p>
                    @endif
                    </div>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection