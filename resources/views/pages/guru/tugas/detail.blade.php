@extends('layouts.guru')

@section('title', 'Dashboard Tugas')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-lg-11">
        <div class="card shadow mb-4">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Detail Tugas {{ $tugas->judul_tugas }}</h6>
            <a href="{{ route('tugas.nilai.export',[$tugas->id, $tugas->kelas->id]) }}" class="btn btn-md btn-primary m-0 font-weight-bold text-white border-white">Nilai <i class="fas fa-arrow-circle-down"></i></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Mengumpulkan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($tugas->kumpultugas as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->murid->nama }}</td>
                      <td><a href="{{ asset('storage/'. $item->file) }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-alt-circle-down"></i></a></td>
                      <td>{{ $item->created_at }}</td>
                      <td>
                        <div class="btn-group">
                          <button disabled class="font-weight-bold text-white btn btn-sm btn-primary">
                            {{ $item->murid->nilais == NULL ? '-' : $item->murid->nilais->nilai . '/100' }}
                          </button>
                          <button type="button" data-ket="{{ $item->murid->nilais->keterangan ?? '' }}" data-nilai="{{ $item->murid->nilais->nilai ?? '' }}" data-murid="{{ $item->murid->id }}" data-nama="{{ $item->murid->nama }}" class="btn btn-sm btn-info btn-nilai" data-toggle="modal" data-target="#tugasNilai">
                            {{ $item->murid->nilais == NULL ? 'Nilai' : 'Edit' }}
                          </button>
                        </div>
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

  <!-- Modal Nilai -->
<div class="modal fade" id="tugasNilai" tabindex="-1" role="dialog" aria-labelledby="tugasNilaiTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tugasNilaiTitle">Nilai {{ $tugas->judul_tugas }} - <span class="nama-nilai"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('nilai.tugas', $tugas->id) }}" class="user" method="POST" id="nilaiTugas">
          @csrf
          <div class="form-nilai"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="nilaiTugas">Submit</button>
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
          });

          $('.btn-nilai').on('click', function(){
            var b = $(this).attr('data-nama');
            var c = $(this).attr('data-murid');
            var d = $(this).attr('data-nilai');
            var e = $(this).attr('data-ket');
            $('.nama-nilai').html(b);
            $('.form-nilai').html(`
            <input type="hidden" value="`+ c +`" name="murid">
            <div class="form-group">
              <input type="number" min="0" max="100" name="nilai" class="form-control form-control-user" value="`+ d +`" placeholder="Nilai" required>
            </div>
            <div class="form-group">
              <textarea name="keterangan" cols="30" class="form-control" placeholder="Keterangan / Catatan">`+ e +`</textarea>
            </div>
            `);
          })
      });
    </script>
@endpush