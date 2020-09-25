@extends('layouts.admin')

@section('title', 'Admin - Tambah Kelas')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Kelas</h6>
                </div>
                <!-- Card Body -->
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
                  <form class="user" method="POST" action="{{ route('kelas.update', $kelas->id) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <div class="mb-3 mb-sm-0">
                            <select name="guru_id" id="wali_kelas" class="form-control">
                              <option value="{{ $kelas->wali_kelas }}">{{ $kelas->wali_kelas->nama }}</option>
                              @foreach ($guru as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->guru->pendidikan }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="kelas" class="form-control form-control-user" placeholder="Kelas" value="{{ $kelas->kelas }}" required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="kode_kelas" class="form-control form-control-user" placeholder="Kode Kelas" value="{{ $kelas->kode_kelas }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Update Kelas</button>
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