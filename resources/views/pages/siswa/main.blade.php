@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">
            @foreach ($mapel->mapels as $key => $item)
              <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <a href="{{ route('murid.mapel', strtolower(\Str::slug($item->nama))) }}" class="text-decoration-none">
                    <div class="card-body">
                      <div class="float-right">
                        @isset($item->tugas_count)
                        <span class="badge badge-info ml-1">{{ $item->tugas_count }} Tugas</span>
                        @endisset
                        @isset($item->soals_count)
                          <span class="badge badge-danger">{{ $item->soals_count }} Soal</span>
                        @endisset
                      </div>
                      <div class="row no-gutters align-items-center w-100">
                        <div class="col mr-2">
                          <div class="text-info text-uppercase mb-1"><h6 class="font-weight-bold">{{ $item->nama }}</h6></div>
                          <div class="row no-gutters align-items-center">
                            <div class="col-auto w-100">
                              <p class="m-0 font-weight-bold text-dark">{{ $item->guru->nama }} {{ $item->guru->guru->pendidikan }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="container border border-primary rounded">
                    <ul class="list-group list-group-flush m-4">
                      @foreach ($pengumuman as $item)
                        <li class="list-group-item list-group-item-action"><a href="{{ route('pengumuman.murid', [$item->id, \Str::slug($item->judul)]) }}"  class="font-weight-bold text-primary">{{ $item->judul }}</a> - <span class="text-muted">{{ $item->created_at }}</span></li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
              </div>
            </div>
          </div>

    </div>
@endsection