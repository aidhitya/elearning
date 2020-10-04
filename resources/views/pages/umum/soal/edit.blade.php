@extends('layouts.' . $layout)

@section('title', 'Dashboard Soal - Edit Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-9 col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Soal</h6>
          </div>
          <div class="card-body">
          <form class="user" action="{{ route('soal.update', $soal->id) }}" method="POST">
              @csrf @method('PUT')
              @include('pages.umum.soal.includes.form')
              <button type="submit" class="btn btn-primary btn-user btn-block">Edit Soal</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection