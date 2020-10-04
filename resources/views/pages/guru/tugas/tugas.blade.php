@extends('layouts.guru')

@section('title', 'Dashboard Tugas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-11">
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Tugas</h6>
                    <a href="{{ route('tugas.create') }}" class="btn btn-primary">Tambah+</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Kelas</th>
                                <th>Mapel</th>
                                <th>File</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tugas as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->judul_tugas }}</td>
                                        <td class="text-wrap text-justify">{{ $item->deskripsi }}</td>
                                        <td>{{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}</td>
                                        <td>{{ $item->mapel->nama }}</td>
                                        <td>
                                            @if ($item->file !== null)
                                                <a href="{{ asset('storage/'. $item->file) }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $item->mulai }}</td>
                                        <td>{{ $item->selesai }}</td>
                                        <td>
                                            <a href="{{ route('tugas.show', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></i></a>
                                            @if ($item->selesai > now())
                                            <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                                            @endif
                                            <form id="delete-tugas{{ $item->id }}" action="{{ route('tugas.destroy', $item->id) }}" method="POST" class="d-inline ml-2">
                                                @csrf @method('DELETE')
                                                <button data-id="{{ $item->id }}" class="btn btn-sm btn-danger rm-tugas"><i class="fa fa-trash"></i></button>
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
              scrollX: true
          } );

          $('.rm-tugas').on('click', function(e){
          e.preventDefault();
          var id_tugas = $(this).attr('data-id');

          Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Tugas Yang Mempunyai Relasi Tidak Dapat Dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
          }).then((isConfirm) => {
            if (isConfirm.isConfirmed == true) {
              $('#delete-tugas'+id_tugas).submit();
            }
          });
        })
      });
    </script>
@endpush