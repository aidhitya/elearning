@extends('layouts.admin')

@section('title', 'Dashboard Admin - Tambah Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Siswa</h6>
                    </div>
                    <div class="card-body">
                        <form class="user" action="{{ route('store.siswa') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control form-control-user" value="{{ old('nama') }}" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                                <input type="hidden" name="role" value="2" required>
                            <div class="form-group">
                                <input type="number" name="nis" class="form-control form-control-user" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa" required>
                            </div>
                            <div class="form-group">
                                <select name="kelas" class="form-control" required>
                                    <option value="">Kelas</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}">Kelas {{ $item->kelas.$item->kode_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" name="no_telp" class="form-control form-control-user" value="{{ old('no_telp') }}" placeholder="Nomor HP" required>
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob" class="form-control form-control-user" value="{{ old('dob') }}" placeholder="Tanggal Lahir" required>
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
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" rows="10" class="form-control" placeholder="Alamat" required>{{ old('alamat') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Tambah Siswa</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">File Excel</h6>
                  <a href="{{ asset('storage/murid.xlsx') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-circle-down"></i> File Contoh</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('excel.murid') }}" class="user" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="excel">
                        </div>
                        <button type="submit" class="float-right btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection