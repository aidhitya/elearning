@extends('layouts.siswa')

@section('title', 'Dashboard Guru - Tambah Profile')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <form class="user" action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <label for="password">New Password</label><br>
                            <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
                        </div>
                        <div class="col-sm-6">
                          <label for=""></label>
                            <input type="password" name="confirm_password" class="form-control form-control-user" placeholder="Confirm Password" required>
                        </div>
                    </div> --}}
                    <div class="form-group">
                    <input type="number" name="nip" class="form-control form-control-user" value="{{ old('nip') }}" placeholder="NIP" required>
                    </div>
                    <div class="form-group">
                    <input type="number" name="no_telp" class="form-control form-control-user" value="{{ old('no_telp') }}" placeholder="Nomor HP" required>
                    </div>
                    <div class="form-group">
                      <label for="dob" class="ml-2">Tanggal Lahir</label>
                      <input type="date" name="dob" id="dob" class="form-control form-control-user" value="{{ old('dob') }}" placeholder="Tanggal Lahir" required>
                    </div>
                    <div class="form-group">
                    <input type="text" name="pendidikan" class="form-control form-control-user" value="{{ old('pendidikan') }}" placeholder="Gelar Pendidikan" required>
                    </div>
                    <div class="form-group">
                        <select name="jenkel" class="form-control" required>
                            <option value="">Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="agama" class="form-control" required>
                            <option value="">Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <textarea name="alamat" rows="10" class="form-control" placeholder="Alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                    <input type="file" name="foto" class="form-control-file" value="{{ old('foto') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Tambah</button>
                </form>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            {{-- <div class="col-xl-3 col-lg-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                   
                </div>
              </div>
            </div> --}}
          </div>
    </div>
@endsection