@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">{{ $materi->judul }}</h6>
          </div>
          <div class="card-body">
            @if ($materi->file !== null)
              <iframe src="{{ asset('storage/'. $materi->file) }}" frameborder="0" style="width: 100%; height: 100vh"></iframe>
            @elseif($materi->file !== null && $materi->url !== null)
              <a href="{{ $materi->url }}">LINK</a>
              <iframe src="{{ asset('storage/'. $materi->file) }}" frameborder="0" style="width: 100%"></iframe>
            @else
              <a href="{{ $materi->url }}">LINK</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection