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
                        <button type="button" class="btn btn-sm btn-info m-2" data-toggle="modal" data-target="#changePass">
                          Ganti Password
                        </button>
                        <a href="{{ route('guru.edit', $guru->guru->nip) }}" class="btn btn-sm btn-primary m-2">Change Profile</a>
                    </li>
                </ul>
            </div>
        </div>
      </div>
  </div>

<div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="changePasslabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasslabel">Ganti Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('guru.update', $guru->guru->nip) }}" method="post" class="user" id="passwordchange">
          @csrf @method('PUT')
          <div class="form-group">
            <input type="password" class="form-control form-control-user" name="oldpass" placeholder="Password Lama">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" name="password" placeholder="Password Baru">
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Konfirmasi Password">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" form="passwordchange">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection