@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            @foreach ($mapel->mapels as $key => $item)
              @if ($key < 4)
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <a href="{{ route('murid.mapel', strtolower(\Str::slug($item->nama))) }}" class="text-decoration-none">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-info text-uppercase mb-1"><h6 class="font-weight-bold">{{ $item->nama }}</h6></div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                              </div>
                              <div class="col">
                                <div class="progress progress-sm mr-2">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              @endif
            @endforeach
          </div>

          <div class="collapse" id="sisaMapel">
            <div class="row">
              @foreach ($mapel->mapels as $key => $item)
                @if ($key > 3)
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                      <a href="{{ route('murid.mapel', strtolower(\Str::slug($item->nama))) }}" class="text-decoration-none">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-info text-uppercase mb-1"><h6 class="font-weight-bold">{{ $item->nama }}</h6></div>
                              <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                  <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                                      aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-auto">
                              <i class="fas fa-spinner fa-2x text-gray-300"></i>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
          <span data-toggle="tooltip" data-placement="left" title="Show All Mapel">
            <button class="btn btn-sm btn-primary float-right" type="button" data-toggle="collapse" data-target="#sisaMapel" aria-expanded="false" aria-controls="sisaMapel">
              <i class="fas fa-angle-down"></i>
            </button>
          </span>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

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