@extends('layouts.admin')

@section('title', 'Dashboard Admin - Kelas')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-11 col-lg-10">
      <div class="card shadow mb-4 border-info">
        <div class="card-header bg-info py-3 d-flex bg-info flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-white">List Kelas</h6>
          <a href="{{ route('kelas.create') }}" class="m-0 font-weight-bold btn btn-sm btn-primary">Tambah Kelas</a>
        </div>
        <div class="card-body">
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
                      @foreach ($kelas as $item)
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->kelas }} {{ $item->kode_kelas }}</td>
                            <td>{{ $item->wali_kelas->nama }}</td>
                            <td>
                              <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-md btn-primary"><i class="fas fa-pencil-alt"></i></a>
                              <form id='delete-kelas{{ $item->id }}' action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button data-id="{{ $item->id }}" data-kelas="{{ $item->kelas }} {{ $item->kode_kelas }}" class="btn btn-sm btn-danger rm-kelas"><i class="fa fa-trash"></i></button>
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
      $(document).ready(function(){
        $('.rm-kelas').on('click', function(e){
          e.preventDefault();
          var nama_kelas = $(this).attr('data-kelas');
          var id_kelas = $(this).attr('data-id');

          Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Kelas Yang Mempunyai Relasi Murid/Mapel Tidak Dapat Dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
          }).then((isConfirm) => {
            if (isConfirm.isConfirmed == true) {
              $('#delete-kelas'+id_kelas).submit();
            }
          });
        })
      })
    </script>
@endpush