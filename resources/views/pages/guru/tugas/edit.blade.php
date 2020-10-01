@extends('layouts.guru')

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
                  <h6 class="m-0 font-weight-bold text-primary">Guru</h6>
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
                <form class="user" action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    @include('pages.guru.tugas.includes.form')
                    <button type="submit" class="btn btn-primary btn-user btn-block">Update</button>
                </form>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection