@extends('layouts.admin')

@section('title', 'Dashboard Admin - Siswa')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-white">Jumlah Siswa : <span class="font-weight-bold">{{ count($siswa) }}</span></h6>
            <h6 class="m-0 text-white">Tidak Memiliki Kelas : <span class="font-weight-bold">{{ $nonkelas }}</span></h6>
            <h6 class="m-0 text-white">Belum Aktif : <span class="font-weight-bold">{{ $nonactive }}</span></h6>
            <a href="{{ route('tambah.siswa') }}" class="btn btn-sm btn-primary border-white"><i class="far fa-plus-square"></i> Tambah</a>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered nowrap" id="dataMurid" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                          <th>NIS</th>
                          <th>Nama</th>
                          <th>Kelas</th>
                          <th>Tanggal Lahir</th>
                          <th>Jenkel</th>
                          <th>Foto</th>
                          <th>Alamat</th>
                          <th>Nomor HP</th>
                          <th>Status</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($siswa as $item)
                          <tr>
                            <td>{{ $item->murid->nis }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->murid->kelas->kelas ?? '' }}{{ $item->murid->kelas->kode_kelas ?? null }}</td>
                            <td>{{ $item->murid->dob }}</td>
                            <td>{{ $item->murid->jenkel }}</td>
                            <td><img src="{{ asset('storage/'. $item->murid->foto) }}" alt="" class="img-fluid img-thumbnail" style="width: 150px;"></td>
                            <td>{{ $item->murid->alamat }}</td>
                            <td>{{ $item->murid->no_telp }}</td>
                            <td>{!! $item->status == 0 ? '<span class="text-danger"><i class="far fa-times-circle"></i> False</span>' : '<span class="text-success"><i class="far fa-check-circle"></i> True</span>' !!}</td>
                            <td>
                              <form action="{{ route('activation', $item->id) }}" class="form-inline" method="post" id="activation{{ $item->id }}">
                                @csrf
                              </form>
                              <button type="submit" class="m-0 btn btn-sm btn-warning" form="activation{{ $item->id }}"><i class="fas fa-spinner"></i>Status</button>
                              <button type="button"
                              data-id="{{ $item->id }}"
                              data-nis="{{ $item->murid->nis }}"
                              data-nama="{{ $item->nama }}"
                              data-kelas="{{ $item->murid->kelas->id ?? '' }}"
                              class="m-0 btn btn-sm btn-info edit"
                              data-toggle="modal"
                              data-target="#editSiswa">
                                <i class="far fa-edit"></i>Edit
                              </button>
                              <form action="{{ route('delete.user', $item->id) }}" method="post" id="delete{{ $item->id }}">
                                @csrf @method('DELETE')
                              </form>
                              <button type="submit" data-id="{{ $item->id }}" class="m-0 btn btn-sm btn-danger rm-user" form="delete{{ $item->id }}"><i class="far fa-trash-alt"></i>Delete</button>
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

  <!-- Modal -->
<div class="modal fade" id="editSiswa" tabindex="-1" aria-labelledby="modelSiswa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelSiswa"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('edit.siswa') }}" class="user" method="POST" id="formEditSiswa">
          @csrf
          <div class="formedit"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="formEditSiswa">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script>
    $(document).ready(function(){
      $('#dataMurid').dataTable({
        scrollX:true,
      });

      $('.edit').on('click', function(){
        var a = $(this).attr('data-nis')
        var c = $(this).attr('data-id')
        var b = $(this).attr('data-kelas')
        var d = $(this).attr('data-nama')
        $('#modelSiswa').text(d)
        $('.formedit').html(`
          <input type="hidden" name="id" value="`+c+`">
          <div class="form-group">
            <input type="number" min="0" name="nis" class="form-control form-control-user" value="`+ a +`" placeholder="NIS" required>
          </div>
          <div class="form-group">
            <select name="kelas" id="kelasiswa" class="form-control">
              <option value="" class="form-control">Kelas</option>
              @foreach ($kelas as $item)
                <option value="{{ $item->id }}" class="form-control opt-kelas">Kelas {{ $item->kelas.$item->kode_kelas }}</option>
              @endforeach
            </select>
          </div>
        `);
        
        $('.opt-kelas').each(function(){
          if ($(this).attr('value') == b) {
            $(this).attr('selected', 'selected')
          }
        })

      })

      $('.rm-user').on('click', function(e){
        e.preventDefault();
        var id_user = $(this).attr('data-id');

        Swal.fire({
          title: 'Konfirmasi Hapus',
          text: 'Murid Beserta Relasi (Nilai, Tugas, DLL) Akan Ikut Terhapus, Yakin ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal",
        }).then((isConfirm) => {
          if (isConfirm.isConfirmed == true) {
            $('#delete'+id_user).submit();
          }
        });
      })
    })
  </script>
@endpush