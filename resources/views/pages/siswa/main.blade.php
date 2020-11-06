@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">
            @foreach ($mapel->mapels as $key => $item)
              <div class="col-xl-4 col-md-6 mb-4">
                @php
                $badges = ['info', 'warning', 'success', 'danger'];
                $intdiv = intdiv(count($mapel->mapels), count($badges));
                $new = $badges;
                for ($i=1; $i < $intdiv; $i++) { 
                  for ($j=0; $j < count($badges); $j++) { 
                    array_push($new, $badges[$j]);
                  }
                }
                @endphp
                <div class="card border-left-{{ $new[$key] }} shadow h-100 py-2">
                  <a href="{{ route('murid.mapel', strtolower(\Str::slug($item->nama))) }}" class="text-decoration-none">
                    <div class="card-body p-2">
                      <div class="float-right">
                        @isset($item->tugas_count)
                        <span class="badge badge-{{ $new[$key] }} ml-1">{{ $item->tugas_count }} Tugas</span>
                        @endisset
                        @isset($item->soals_count)
                          <span class="badge badge-danger">{{ $item->soals_count }} Soal</span>
                        @endisset
                      </div>
                      <div class="row no-gutters align-items-center w-100">
                        <div class="col mr-2">
                          <div class="text-{{ $new[$key] }} text-uppercase mb-1"><h6 class="font-weight-bold">{{ $item->nama }}</h6></div>
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
              <div class="card shadow mb-4 border-info">
                <!-- Card Header - Dropdown -->
                <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-white">Pengumuman</h6>
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
                <div id="calendar" style="margin: 0px -15px"></div>
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