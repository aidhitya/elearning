@extends('layouts.'.$layout)

@section('title', 'Dashboard Soal')

@section('content')
    <div class="container-fluid">
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Soal</h6>
                  <a href="{{ route('soal.create') }}" class="btn btn-primary">Tambah+</a>
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
                    <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Kelas</th>
                                <th>Kelas (s)</th>
                                <th>Kategori</th>
                                <th>Mapel</th>
                                <th>Materi</th>
                                <th>Author</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($soal as $key => $item)
                                <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>
                                  @if ($item->speckelas !== null)
                                    {{ $item->speckelas->kelas }}
                                  @else
                                    {{ $item->kelas }}
                                  @endif
                                </td>
                                <td>
                                  @if ($item->speckelas !== null)
                                      {{ $item->speckelas->kelas }} {{ $item->speckelas->kode_kelas }}
                                  @else
                                  -
                                  @endif
                                </td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->mapel->nama }}</td>
                                <td>
                                  @if ($item->materi !== null)
                                      {{ $item->materi->judul }}
                                  @else
                                  -
                                  @endif
                                </td>
                                <td>{{ $item->pembuat->nama }}</td>
                                <td>{{ $item->mulai }}</td>
                                <td>{{ $item->selesai }}</td>
                                <td>
                                  <a href="{{ route('detail.create', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>
                                  <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></i></a>
                                  @if ($item->author == Auth::id())
                                    @if ($item->mulai > now())
                                      <a href="{{ route('soal.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    @endif
                                    <form action="{{ route('soal.destroy', $item->id) }}" method="POST" class="d-inline ml-2">
                                      @csrf @method('DELETE')
                                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                  @endif
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
            {{-- <div class="col-xl-2 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                </div>
              </div>
            </div>
          </div> --}}

    </div>
@endsection

@push('addon-script')
    <script>
      $(document).ready(function() {
          $('#dataTable').DataTable( {
              scrollX: true
          } );
      });
    </script>
@endpush