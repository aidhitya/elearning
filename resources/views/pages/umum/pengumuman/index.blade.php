@extends('layouts.' . $layout)

@section('title', 'Dashboard Materi')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4 border-info">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">List Pengumuman</h6>
            <a href="{{ route('pengumuman.create') }}" class="btn btn-primary border-white">Tambah <i class="far fa-plus-square"></i></a>
          </div>
          <div class="card-body">
            <h6 class="mb-2 font-weight-bold text-dark">Pengumuman Per Kelas</h6>
            <div class="form-group row" style="margin-bottom: -10px">
              <div class="col-md-6 mb-3 mb-sm-0">
                <select name="kelas" id="filter-kelas" class="form-control" required>
                  <option value="">Kelas</option>
                  @if ($layout == 'admin')
                    @foreach ($kelas as $item)
                      <option value="{{ $item->kelas }}{{ $item->kode_kelas }}">Kelas {{ $item->kelas }}{{ $item->kode_kelas }}</option>
                    @endforeach
                  @else
                    @foreach ($kelas as $item)
                      <option value="{{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}">Kelas {{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}</option>
                    @endforeach
                  @endif
                  
                </select>
              </div>
            </div>
            <div class="table-responsive pt-3">
              <table class="table table-bordered" id="pengumumanTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Judul</th>
                    <th>Author</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($pengumuman as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>
                          @foreach ($item->kelas as $k)
                            Kelas  {{ $k->kelas ?? '' }}{{ $k->kode_kelas . ', ' ?? '' }} 
                          @endforeach
                      </td>
                      <td>{{ $item->judul }}</td>
                      <th>{{ $item->author->nama }}</th>
                      <td>
                        <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-md btn-info"><i class="far fa-eye"></i></a>
                        @if (Auth::id() == $item->author->id)
                          <a href="{{ route('pengumuman.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="far fa-edit"></i>Edit</a>
                          <form id="delete-pengumuman{{ $item->id }}" action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button data-id="{{ $item->id }}" class="btn btn-sm btn-danger rm-pengumuman"><i class="fa fa-trash"></i></button>
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
  </div>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function (){
      var table = $('#pengumumanTable').removeAttr('width').DataTable({
        scrollY:        "300px",
        columnDefs: [
            { width: 60, targets: 0 }
        ],
        fixedColumns: true,
      });
      
      $('#filter-kelas').on('change', function(){
        table.column(1).search(this.value).draw();   
      });

      $('.rm-pengumuman').on('click', function(e){
        e.preventDefault();
        var id_pengumuman = $(this).attr('data-id');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: 'Hapus Pengumuman',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal",
        }).then((isConfirm) => {
          if (isConfirm.isConfirmed == true) {
            $('#delete-pengumuman'+id_pengumuman).submit();
          }
        });
      })

    });
  </script>
@endpush