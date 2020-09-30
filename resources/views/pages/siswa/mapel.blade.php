@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-7 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark">List Materi - {{ $search->nama }}</h6>
                  <h6 class="m-0 font-weight-bold text-dark">{{ $search->guru->nama }} {{ $search->guru->guru->pendidikan }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Utama</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tambahan</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <ul class="list-group list-group-flush">
                        @foreach ($search->materis as $item)
                          @if ($item->kelas_id == null)
                            <li class="list-group-item list-group-item-action">
                              <h6 class="font-weight-bold text-primary mb-0">{{ $item->judul }}</h6>
                              <br><small class="ml-2 text-muted">{{ $item->keterangan }}</small>
                              <a href="{{ route('murid.materi', [strtolower(\Str::slug($search->nama)), $item->id]) }}" class="btn btn-sm btn-primary float-right">Lihat</a>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <ul class="list-group list-group-flush">
                        @foreach ($search->materis as $item)
                          @if ($item->kelas_id !== null)
                            <li class="list-group-item list-group-item-action">
                              <h6 class="font-weight-bold text-primary mb-0">{{ $item->judul }}</h6>
                              <br><small class="ml-2 text-muted">{{ $item->keterangan }}</small>
                              <a href="{{ route('murid.materi', [strtolower(\Str::slug($search->nama)), $item->id]) }}" class="btn btn-sm btn-primary float-right">Lihat</a>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-5 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Soal</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @foreach ($soal as $item)
                    <li class="list-group-item list-group-item-action">
                      {{ $item->judul }}<small class="ml-2 text-muted">( {{ $item->kategori }} )</small>
                      <a href="{{ route('murid.soal', [strtolower($item->kategori), \Str::slug($item->mapel->nama), $item->id]) }}" class="float-right btn btn-sm btn-primary">Kerjakan</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tugas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    @foreach ($tugas as $item)
                    <li class="list-group-item list-group-item-action">
                      {{ $item->judul_tugas }} <br> <small class="ml-2 text-muted overflow-hidden">{{ $item->deskripsi }}</small>
                      <a href="{{ route('murid.tugas', [$item->id, \Str::slug($item->judul_tugas)]) }}" class="float-right btn btn-sm btn-primary">Kumpulkan</a>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection