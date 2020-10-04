@extends('layouts.admin')

@section('title', 'Dashboard Materi')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">List Materi</h6>
                  <a href="{{ route('materi.create') }}" class="btn btn-primary">Tambah+</a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <h6 class="mb-2 font-weight-bold text-dark">Search Materi</h6>
                    <div class="form-group row">
                      <div class="col-md-6 mb-3 mb-sm-0">
                        <select name="kelas" id="filter-kelas" class="form-control" required>
                          <option value="">Kelas</option>
                          @foreach ($kelas as $item)
                          <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-6 mb-3 mb-sm-0">
                        <select name="mapel" id="filter-mapel" class="form-control" required>
                          <option value="">Mata Pelajaran</option>
                          @foreach ($mapel as $item)
                          <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="materiTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                          <th>No</th>
                          <th>Materi</th>
                          <th>Kelas(U)</th>
                          <th>Kelas</th>
                          <th>Mapel</th>
                          <th>Pertemuan</th>
                          <th>Author</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($materi as $key => $item)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>
                              @if ($item->kelas_spec !== null)
                                  {{ $item->kelas_spec->kelas }} {{ $item->kelas_spec->kode_kelas }}
                              @endif
                            </td>
                            <td>{{ $item->mapel->nama }}</td>
                            <td>{{ $item->pertemuan }}</td>
                            <td>{{ $item->author->nama }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                              <a href="{{ route('materi.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                              <form id="delete-materi{{ $item->id }}" action="{{ route('materi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button data-id="{{ $item->id }}" class="btn btn-sm btn-danger rm-materi"><i class="fa fa-trash"></i></button>
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
    $(document).ready(function (){
      var table = $('#materiTable').removeAttr('width').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        columnDefs: [
            { width: 60, targets: 8 }
        ],
        fixedColumns: true,
        dom: 'lrtip'
      });
      
      $('#filter-kelas').on('change', function(){
        table.column(2).search(this.value).draw();   
      });

      $('#filter-mapel').on('change', function(){
        table.column(4).search(this.value).draw();   
      });

      $('.rm-materi').on('click', function(e){
        e.preventDefault();
        var id_materi = $(this).attr('data-id');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: 'Soal Yang Mempunyai Relasi Tidak Dapat Dihapus',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal",
        }).then((isConfirm) => {
          if (isConfirm.isConfirmed == true) {
            $('#delete-materi'+id_materi).submit();
          }
        });
      })

    });
  </script>
@endpush