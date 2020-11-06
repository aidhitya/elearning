@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="container-fluid">
          <div class="row">
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-white">Soal Berjalan</h6>
                </div>
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @if (count($soal) == 0)
                      <li class="list-group-item list-group-item-action font-weight-bold"><span class="mr-5 text-primary">Tidak Ada</li>
                    @endif
                    @foreach ($soal as $item)
                      <li class="list-group-item list-group-item-action font-weight-bold text-wrap"><span class="mr-2 text-primary">{{ $item->judul }}</span><span class="ml-5">{{ date('d/m/Y H:i:s', strtotime($item->mulai)) }} <span class="font-weight-normal">s/d</span> {{ date('d/m/Y H:i:s', strtotime($item->selesai)) }}</span> - <span class="{{ $item->detail_soal_count < 5 ? 'text-danger' : 'text-info' }} ml-2">{{ $item->detail_soal_count }} Soal</span></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-5">
              <div class="shadow mb-4">
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