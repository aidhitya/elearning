@extends('layouts.admin')

@section('title', 'Admin - Tambah Kelas')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-9 col-lg-8">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Mapel</h6>
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="new-mapel" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="true">Mapel Baru</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="mapel-kelas" data-toggle="tab" href="#mapelkelas" role="tab" aria-controls="mapelkelas" aria-selected="false">Mapel - Kelas</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="mapel" role="tabpanel" aria-labelledby="new-mapel">
                <form class="user pt-2" method="POST" action="{{ route('mapel.store') }}">
                  @csrf
                  @include('pages.admin.mapel.includes.input-parent')
                  <div class="form-group row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 mb-sm-0">
                      <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Mapel</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane fade" id="mapelkelas" role="tabpanel" aria-labelledby="mapel-kelas">
                <form class="user pt-2" method="POST" action="{{ route('mapel.store') }}">
                  @csrf
                  @include('pages.admin.mapel.includes.selects')
                  <div class="form-group row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 mb-sm-0">
                      <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Mapel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection