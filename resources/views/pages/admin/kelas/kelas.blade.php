@extends('layouts.admin')

@section('title', 'Dashboard Admin - Kelas')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Kelas</h6>
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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Option</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Option</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($kelas as $key => $item)
                                    <tr>
                                      <td>{{ $key + 1 }}</td>
                                      <td>{{ $item->kelas }} {{ $item->kode_kelas }}</td>
                                      <td>{{ $item->wali_guru_kelas->nama }}</td>
                                      <td>
                                        <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                                         @csrf @method('DELETE')
                                         <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                      </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Kelas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection