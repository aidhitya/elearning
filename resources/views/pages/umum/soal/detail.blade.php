@extends('layouts.'.$layout)

@section('title', 'Dashboard Detail Soal')

@section('content')
    <div class="container-fluid">
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">{{ $complete->judul }} - {{ is_null($complete->kelas) ? 'Kelas '.$complete->speckelas->kelas .' '. $complete->speckelas->kode_kelas : 'Kelas '.$complete->kelas}}</h6>
                  <h6 class="m-0 font-weight-bold text-primary">{{ is_null($complete->materi_id) ? $complete->mapel->nama : $complete->mapel->nama . ' - '. $complete->materi->judul}}</h6>
                  <h6 class="m-0 font-weight-bold text-primary">{{ $complete->author->nama }}</h6>
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
                                <th>No</th>
                                <th>Soal</th>
                                <th>Gambar</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complete->detail_soal as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-wrap w-75 text-justify">{!! $item->isi !!}</td>
                                        <td>
                                            @if ($item->gambar !== null)
                                            @if (\File::exists('storage/'. $item->gambar))
                                            <img src="{{ asset('storage/'.$item->gambar) }}" alt="soal" class="w-50 img-fluid rounded">
                                            @else
                                            <img src="{{ url($item->gambar) }}" alt="sda" class="img-fluid rounded">
                                            @endif
                                            @endif
                                        </td>
                                        @foreach ($item->jawabans as $jwb)
                                            <td class="{{ $jwb->kunci == 1 ? 'text-success font-weight-bold' : null }} text-justify text-wrap w-50">{{ $jwb->jawaban }}</td>
                                        @endforeach
                                        <td>
                                            <a href="{{ route('detail.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ route('detail.destroy', $item->id) }}" method="POST" class="d-inline">
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
    </div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                scrollX: true,
                
            });
        });
    </script>
@endpush