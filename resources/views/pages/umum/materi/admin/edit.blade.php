@extends('layouts.admin')

@section('title', 'Edit Materi')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Materi</h6>
          </div>
          <div class="card-body">
            @if (session('berhasil'))
                <div class="alert alert-success">
                    {{ session('berhasil') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="user pt-2" method="POST" action="{{ route('materi.update', $materi->id) }}" enctype="multipart/form-data">
              @csrf @method('PUT')
              @include('pages.umum.materi.admin.includes.form')
              <div class="form-group row">
                <div class="col-md-8"></div>
                <div class="col-md-4 mb-sm-0">
                  <button type="submit" class="btn btn-primary btn-user btn-block">Update Materi</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection