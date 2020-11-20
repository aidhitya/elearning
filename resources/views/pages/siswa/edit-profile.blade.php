@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Edit Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                    </div>
                    <div class="card-body">
                        <form class="user" action="{{ route('murid.update', $murid->nis) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control form-control-user" value="{{ $murid->user->nama }}" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" value="{{ $murid->user->email }}" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="no_telp" class="form-control form-control-user" value="{{ $murid->no_telp }}" placeholder="Nomor HP" required>
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob" class="form-control form-control-user" value="{{ $murid->dob }}" placeholder="Tanggal Lahir" required>
                            </div>
                            <div class="form-group">
                                <select name="jenkel" class="form-control" required>
                                    <option value="">Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ $murid->jenkel == 'Laki-Laki' ? 'selected' : null }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $murid->jenkel == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="agama" class="form-control" required>
                                    <option value="">Agama</option>
                                    <option value="Islam" {{ $murid->agama == 'Islam' ? 'selected' : null }}>Islam</option>
                                    <option value="Kristen" {{ $murid->agama == 'Kristen' ? 'selected' : null }}>Kristen</option>
                                    <option value="Katolik" {{ $murid->agama == 'Katolik' ? 'selected' : null }}>Katolik</option>
                                    <option value="Hindu" {{ $murid->agama == 'Hindu' ? 'selected' : null }}>Hindu</option>
                                    <option value="Buddha" {{ $murid->agama == 'Buddha' ? 'selected' : null }}>Buddha</option>
                                    <option value="Konghucu" {{ $murid->agama == 'Konghucu' ? 'selected' : null }}>Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" rows="10" class="form-control" placeholder="Alamat" required>{{ $murid->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control">
                                @if ($murid->foto !== null)
                                    <img src="{{ asset('storage/'.$murid->foto) }}" alt="soal" class="w-25 img-fluid mb-2">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection