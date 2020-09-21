@extends('layouts.' . $layout)

@section('title', 'Dashboard Soal - Edit Detail Soal')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-10 col-lg-9">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Detail Soal - {{ $detail->soalnya->judul }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                   @if (session('berhasil'))
                      <div class="alert alert-success">
                          {{ session('berhasil') }}
                      </div>
                  @endif
                  @if ($errors->any())
                  @php
                    //   dd($errors);
                  @endphp
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <form class="user" name="detailsoal" action="{{ route('detail.update', $detail->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <input type="text" name="soal" style="width: 95%" class="form-control form-control-user d-inline" value="{{ $detail->soal }}" placeholder="Soal" required>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-5 mb-0 mb-sm-0">
                            <input id="gambar" type="file" class="form-control @error('gambar') is-invalid @enderror mb-2" name="gambar_1" value="" autocomplete="gambar" autofocus>
                            @if (! is_null($detail->gambar))
                                <img src="{{ $detail->gambar }}" alt="soal" class="img-fluid mb-2">
                            @endif
                        </div>
                        <div class="col-md-7 mb-0 mb-sm-0">
                            @foreach ($detail->jawabans as $key => $item)
                                <div class="form-check-inline form-check" style="width: 95%">
                                    <input type="radio" id="kunci" name="kunci" class="form-check-input" value="{{ $key }}" required {{ $item->kunci == 1 ? 'checked' : null }}>
                                    <input id="jawaban" type="text" class="col-md-12 mb-1 form-control form-control-md @error('jawaban') is-invalid @enderror" placeholder="Jawaban A" name="jawaban[]" value="{{ $item->jawaban }}" required autocomplete="jawaban" autofocus>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Proses</button>
                </form>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            {{-- <div class="col-xl-2 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Action Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                   
                </div>
              </div>
            </div> --}}
          </div>
    </div>
@endsection