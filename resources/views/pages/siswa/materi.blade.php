@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-9">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark">{{ $materi->judul }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  @if ($materi->file !== null)
                    <iframe src="{{ asset('storage/'. $materi->file) }}" frameborder="0" style="width: 100%; height: 500px"></iframe>
                  @elseif($materi->file !== null && $materi->url !== null)
                    <a href="{{ $materi->url }}">LINK</a>
                    <iframe src="{{ asset('storage/'. $materi->file) }}" frameborder="0" style="width: 100%"></iframe>
                  @else
                    <a href="{{ $materi->url }}">LINK</a>
                  @endif
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            {{-- <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tugas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
              </div>
            </div> --}}
          </div>

    </div>
@endsection