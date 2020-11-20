@extends('layouts.admin')

@section('title', 'Dashboard Admin - Siswa')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 text-white">Jumlah Guru : <span class="font-weight-bold">{{ count($guru) }}</span></h6>
            <a href="{{ route('tambah.guru') }}" class="btn btn-sm btn-primary border-white"><i class="far fa-plus-square"></i> Tambah</a>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered nowrap" id="dataMurid" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                          <th>NIP</th>
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
                        @foreach ($guru as $item)
                          <tr>
                            <td>{{ $item->guru->nip }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if (count($item->mengajar) > 0)
                                    @foreach ($item->mengajar as $kel)
                                        {{ $kel->kelas->kelas.$kel->kelas->kode_kelas }},
                                    @endforeach
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $item->guru->dob }}</td>
                            <td>{{ $item->guru->jenkel }}</td>
                            <td><img src="{{ asset('storage/'. $item->guru->foto) }}" alt="" class="img-fluid img-thumbnail" style="width: 150px;"></td>
                            <td>{{ $item->guru->alamat }}</td>
                            <td>{{ $item->guru->no_telp }}</td>
                            <td>{!! $item->status == 0 ? '<span class="text-danger"><i class="far fa-times-circle"></i> False</span>' : '<span class="text-success"><i class="far fa-check-circle"></i> True</span>' !!}</td>
                            <td>
                              <form action="{{ route('activation', $item->id) }}" class="form-inline" method="post" id="activation{{ $item->id }}">
                                @csrf
                              </form>
                              <button type="submit" class="m-0 btn btn-sm btn-warning" form="activation{{ $item->id }}"><i class="fas fa-spinner"></i>Status</button>
                              <button type="button"
                              data-id="{{ $item->id }}"
                              data-nis="{{ $item->guru->nip }}"
                              data-nama="{{ $item->nama }}"
                              class="m-0 btn btn-sm btn-info edit"
                              data-toggle="modal"
                              data-target="#editGuru">
                                <i class="far fa-edit"></i>Edit
                              </button>
                              {{-- <form action="{{ route('delete.user', $item->id) }}" method="post" id="delete{{ $item->id }}">
                                @csrf @method('DELETE')
                              </form>
                              <button type="submit" data-id="{{ $item->id }}" class="m-0 btn btn-sm btn-danger rm-user" form="delete{{ $item->id }}"><i class="far fa-trash-alt"></i>Delete</button> --}}
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
<div class="modal fade" id="editGuru" tabindex="-1" aria-labelledby="modelGuru" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelGuru"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('edit.guru') }}" class="user" method="POST" id="formEditSiswa">
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
        var b = $(this).attr('data-nama')
        $('#modelGuru').text(b)
       $('.formedit').html(`
          <input type="hidden" name="id" value="`+c+`">
          <div class="form-group">
            <input type="number" min="0" name="nip" class="form-control form-control-user" value="`+ a +`" placeholder="NIP" required>
          </div>
        `);

      })

    //   $('.rm-user').on('click', function(e){
    //     e.preventDefault();
    //     var id_user = $(this).attr('data-id');

    //     Swal.fire({
    //       title: 'Konfirmasi Hapus',
    //       text: 'Guru Beserta Relasi (Kelas, Mata Pelajaran, Materi, DLL) Akan Ikut Terhapus, Yakin ?',
    //       icon: 'warning',
    //       showCancelButton: true,
    //       confirmButtonText: "Hapus",
    //       cancelButtonText: "Batal",
    //     }).then((isConfirm) => {
    //       if (isConfirm.isConfirmed == true) {
    //         $('#delete'+id_user).submit();
    //       }
    //     });
    //   })
    })
  </script>
@endpush