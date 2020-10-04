@extends('layouts.guru')

@section('title', 'Tambah Materi Tambahan')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Materi Kelas {{ $kelas->kelas }}{{ $kelas->kode_kelas }}</h6>
            <h6 class="m-0 font-weight-bold text-primary">{{ $mapel->nama }}</h6>
          </div>
          <div class="card-body">
            <form class="user pt-2" method="POST" action="{{ route('materi.store') }}" enctype="multipart/form-data">
              @csrf
              @include('pages.umum.materi.guru.includes.form')
              <div class="form-group row">
                <div class="col-md-8"></div>
                <div class="col-md-4 mb-sm-0">
                  <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Materi</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection