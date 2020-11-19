@extends('layouts.guru')

@section('title', 'Dashboard Admin - Siswa')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-white font-weight-bold">Profile</h6>
          </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $guru->guru->nip }}</li>
                    <li class="list-group-item">{{ $guru->nama }}</li>
                    <li class="list-group-item">{{ $guru->email }}</li>
                    <li class="list-group-item">{{ $guru->guru->no_telp }}</li>
                    <li class="list-group-item">{{ $guru->guru->jenkel }}</li>
                    <li class="list-group-item">{{ $guru->guru->dob }}</li>
                    <li class="list-group-item">{{ $guru->guru->agama }}</li>
                    <li class="list-group-item">{{ $guru->guru->alamat }}</li>
                    {{-- {{ asset('storage/'. $guru->foto) }} --}}
                    <li class="list-group-item"><img src="{{ $guru->guru->foto }}" class="img-fluid img-thumbnaik w-25" alt=""></li>
                    <li class="list-group-item">
                        <a href="#" class="btn btn-sm btn-info m-2">Change Password</a>
                        <a href="#" class="btn btn-sm btn-primary m-2">Change Profile</a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
  </div>
@endsection