@extends('layouts.guru')

@section('title', 'Dashboard Guru - Tambah Profile')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-9 col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Guru</h6>
          </div>
          <div class="card-body">
          <form class="user" action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @include('pages.guru.tugas.includes.form')
              <button type="submit" class="btn btn-primary btn-user btn-block">Tambah</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection