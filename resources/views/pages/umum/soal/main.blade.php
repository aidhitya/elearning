@extends('layouts.'.$layout)

@section('title', 'Dashboard Soal')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List Soal</h6>
            <a href="{{ route('soal.create') }}" class="btn btn-primary">Tambah+</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Judul</th>
                    @if (Auth::user()->is_admin)
                      <td>Kelas</td>
                    @endif
                    <th>Kelas (s)</th>
                    <th>Kategori</th>
                    <th>Mapel</th>
                    <th>Materi</th>
                    @if (Auth::user()->is_admin)
                      <td>Author</td>
                    @endif
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
                    @if (Auth::user()->is_admin)
                      <td>
                        @if ($item->speckelas !== null)
                          {{ $item->speckelas->kelas }}
                        @else
                          {{ $item->kelas }}
                        @endif
                      </td>
                    @endif
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
                      @if (Auth::user()->is_admin)
                        <td>{{ $item->author->nama }}</td>
                      @endif
                    <td>{{ $item->mulai }}</td>
                    <td>{{ $item->selesai }}</td>
                    <td>
                      <a href="{{ route('detail.create', $item->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>
                      <a href="{{ route('soal.show', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></i></a>
                      @if ($item->guru_id == Auth::id())
                        @if ($item->selesai > now())
                          <a href="{{ route('soal.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                        @endif
                        <form  id="delete-soal{{ $item->id }}" action="{{ route('soal.destroy', $item->id) }}" method="POST" class="d-inline ml-2">
                          @csrf @method('DELETE')
                          <button data-id="{{ $item->id }}" class="btn btn-sm btn-danger rm-soal"><i class="fa fa-trash"></i></button>
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
  </div>
@endsection

@push('addon-script')
    <script>
      $(document).ready(function() {
          $('#dataTable').DataTable( {
              scrollX: true
          } );

           $('.rm-soal').on('click', function(e){
            e.preventDefault();
            var id_soal = $(this).attr('data-id');

            Swal.fire({
              title: 'Konfirmasi Hapus',
              text: 'Soal Yang Mempunyai Relasi Tidak Dapat Dihapus',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: "Hapus",
              cancelButtonText: "Batal",
            }).then((isConfirm) => {
              if (isConfirm.isConfirmed == true) {
                $('#delete-soal'+id_soal).submit();
              }
            });
          })
      });
    </script>
@endpush