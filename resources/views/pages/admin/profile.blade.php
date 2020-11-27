@extends('layouts.admin')

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
                    <li class="list-group-item">{{ $admin->nama }}</li>
                    <li class="list-group-item">{{ $admin->email }}</li>
                    <li class="list-group-item">
                        <button type="button" class="btn btn-sm btn-info m-2" data-toggle="modal" data-target="#changePass">
                          Ganti Password
                        </button>
                        <button type="button" data-nama="{{ $admin->nama }}" data-email="{{ $admin->email }}" class="btn btn-sm btn-primary m-2 adm-prof" data-toggle="modal" data-target="#changeProfil">
                          Ganti Profile
                        </button>
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
        <form action="{{ route('admin.profile.update', $admin->id) }}" method="post" class="user" id="passwordchange">
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

<div class="modal fade" id="changeProfil" tabindex="-1" aria-labelledby="changeProfileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeProfileLabel">Ganti Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.profile.update', $admin->id) }}" method="post" class="user" id="profileChange">
          @csrf @method('PUT')
          <div class="form-group">
            <input type="text" class="form-control form-control-user" name="nama" value="{{ $admin->nama }}" placeholder="Nama">
          </div>
          <div class="form-group">
            <input type="email" class="form-control form-control-user" name="email" value="{{ $admin->email }}" placeholder="Email">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" form="profileChange">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection