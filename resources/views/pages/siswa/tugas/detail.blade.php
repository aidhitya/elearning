@extends('layouts.siswa')

@section('title', 'Dashboard Siswa - Tugas')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">List Tugas {{ $tugas->nama }}</h6>
            </div>
            <div class="justif-content-center m-3">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-mapel" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Tugas</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Mengumpulkan</th>
                            <th>Nilai & Catatan</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugas->tugas as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->judul_tugas }}</td>
                                    <td class="overflow-hidden">{{ $item->deskripsi }}</td>
                                    <td>
                                        @isset($item->file)
                                            <a href="{{ asset('storage/', $item->file) }}" class="btn btn-md btn-primary"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                        @endisset
                                    </td>
                                    <td>{{ $item->kumpultugas[0]->created_at ?? '-' }}</td>
                                    <td class="text-nowrap"><span class="font-weight-bold text-primary">{{ $item->nilais[0]->nilai . '/100' ?? '-' }}</span>{{ ' - ' . $item->nilais[0]->keterangan ?? ''  }}</td>
                                    <td>
                                    <a href="{{ route('murid.tugas', [$item->id, \Str::slug($item->judul_tugas)]) }}" class="btn btn-sm btn-primary {{ $item->selesai < now() ? 'disabled' : ($item->nilais[0] !== NULL ? 'disabled' : '') }}">{{ isset($item->kumpultugas[0]->created_at) ? 'Update' : 'Submit' }}</a>
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
    $(document).ready( function () {
        $('#table-mapel').DataTable();
    });
  </script>
@endpush