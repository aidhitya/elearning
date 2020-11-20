@extends('layouts.guru')

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
                        <form class="user" action="{{ route('guru.update', $guru->nip) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <input type="text" name="nama" class="form-control form-control-user" value="{{ $guru->user->nama }}" placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" value="{{ $guru->user->email }}" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="no_telp" class="form-control form-control-user" value="{{ $guru->no_telp }}" placeholder="Nomor HP" required>
                            </div>
                            <div class="form-group">
                                <input type="date" name="dob" class="form-control form-control-user" value="{{ $guru->dob }}" placeholder="Tanggal Lahir" required>
                            </div>
                            <div class="form-group">
                                <select name="jenkel" class="form-control" required>
                                    <option value="">Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ $guru->jenkel == 'Laki-Laki' ? 'selected' : null }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $guru->jenkel == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="agama" class="form-control" required>
                                    <option value="">Agama</option>
                                    <option value="Islam" {{ $guru->agama == 'Islam' ? 'selected' : null }}>Islam</option>
                                    <option value="Kristen" {{ $guru->agama == 'Kristen' ? 'selected' : null }}>Kristen</option>
                                    <option value="Katolik" {{ $guru->agama == 'Katolik' ? 'selected' : null }}>Katolik</option>
                                    <option value="Hindu" {{ $guru->agama == 'Hindu' ? 'selected' : null }}>Hindu</option>
                                    <option value="Buddha" {{ $guru->agama == 'Buddha' ? 'selected' : null }}>Buddha</option>
                                    <option value="Konghucu" {{ $guru->agama == 'Konghucu' ? 'selected' : null }}>Konghucu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="alamat" rows="10" class="form-control" placeholder="Alamat" required>{{ $guru->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control">
                                @if ($guru->foto !== null)
                                    <img src="{{ asset('storage/'.$guru->foto) }}" alt="soal" class="w-25 img-fluid mb-2">
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