@extends('layouts.admin')

@section('title', 'Dashboard List Kelas')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-12 col-lg-11">
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">List Kelas</h6>
            </div>
            <div class="card-body">
              <div class="row">
                @foreach ($kelas as $item)
                    <div class="col-md-6 col-xl-3 col-lg-4">
                        <div class="card mb-4 rounded-lg border-info">
                            <div class="card-header bg-info py-3 d-flex flew-row align-items-center justify-content-center border-primary">
                                <h6 class="m-0 font-weight-bold text-white">Kelas {{ $item->kelas }}{{ $item->kode_kelas }}</h6>
                            </div>
                            <div class="card-body">
                                <div class="align-items-center justify-content-center text-center">
                                    <h6 class="font-weight-bold text-dark m-0">{{ $item->wali_kelas->nama }} {{ $item->wali_kelas->guru->pendidikan }}</h6><br>
                                    <h6 class="m-0 font-weight-bold text-info">Murid : {{ $item->murids_count }}</h6><br>
                                    <a href="{{ route('nilai.mapel',[$item->id, $item->kelas.'-'.$item->kode_kelas]) }}" class="btn btn-sm btn-primary">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection