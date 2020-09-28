@extends('layouts.mengerjakan')

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
                  <h6 class="m-0 font-weight-bold text-dark">{{ $soal->judul }}</h6>
                  <h6 class="m-0 text-dark" id="setTime"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @php
                        // session()->forget('soal');
                        // session()->forget('jawaban');
                        // session()->forget('sort');
                        // session()->forget('by');
                    @endphp
                    @if ($toggle == 'null')
                        @include('includes.siswa.mengerjakan')
                    @else
                        @include('includes.siswa.checking')
                    @endif
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection

@push('addon-script')
<script src="{{ asset('assets/libraries/time/countdown.js') }}"></script>
@endpush