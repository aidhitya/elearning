@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="card-header py-3 flex-row align-items-center justify-content-center text-center">
                        @if (\Request::route()->getName() == 'soal.selesai' && isset($soal))
                          @include('includes.siswa.nilai.hasil')
                        @else
                          @include('includes.siswa.nilai.alert')
                        @endif
                    </div>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection