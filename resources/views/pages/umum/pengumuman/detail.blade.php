@extends('layouts.' . $layout)

@section('title', $pengumuman->judul)

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">{{ $pengumuman->judul }}</h6>
            <h6 class="m-0 font-weight-bold text-white">{{ $pengumuman->author->nama }}</h6>
            @if ($layout == 'siswa')
              <h6 class="m-0 font-weight-bold text-white">{{ $pengumuman->author->mengajarspec->nama }}</h6>
            @endif
          </div>
          <div class="card-body">
            <div class="containe border border-primary rounded p-4">
                @if ($pengumuman->gambar !== null)
                    <div class="justify-content-center mb-3 mx-auto">
                        <img src="{{ asset('storage/'. $pengumuman->gambar) }}" alt="gambar" class="img-fluid m-2">
                    </div>
                @endif
                <h6 style="font-weight: 450">{!! $pengumuman->isi !!}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection