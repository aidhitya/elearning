@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs text-primary text-uppercase mb-1"><h6 class="font-weight-bold">Murid</h6></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $murid }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-3x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h6 class="font-weight-bold">Guru</h6></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-tie fa-3x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><h6 class="font-weight-bold">Kelas</h6></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $kelas }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher fa-3x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><h6 class="font-weight-bold">Mata Pelajaran</h6></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mapel }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book-open fa-3x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-white">Pengumuman</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @foreach ($pengumuman as $peng)
                      <li class="list-group-item list-group-item-action">
                        <a href="{{ route('pengumuman.show', $peng->id) }}" class="m-0 font-weight-bold text-primary">{{ $peng->judul }}</a>
                        <br>
                        @if (count($peng->kelas) > 0)
                            Kelas 
                        @foreach ($peng->kelas as $item)
                            {{ $item->kelas }}{{ $item->kode_kelas }},
                        @endforeach
                        @else
                        #
                        @endif
                         - {{ $peng->author->nama }}
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div id="calendar" style="margin: 0px -15px"></div>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/calendar/css/calendar.css') }}">
@endpush

@push('addon-script')
  <script src="{{ asset('assets/calendar/js/calendar.js') }}"></script>
@endpush