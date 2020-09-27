@extends('layouts.mengerjakan')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-11">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-dark">{{ $soal->judul }}</h6>
                  <h6 class="m-0 text-dark" id="setTime"></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @php
                        // session()->forget('soal');
                        // session()->forget('jawaban');
                        // session()->forget('sort');
                        // session()->forget('by');
                    @endphp
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="mulai" id="waktu" value="{{ $soal->selesai }}">
                            <input type="hidden" name="soal" value="{{ $soal->id }}">
                            @foreach ($detail as $key => $item)
                            @php
                                $session_soal = Session::get('soal');
                                $session_jawaban = Session::get('jawaban');

                                $set = array_search($item->id, $session_soal);
                            @endphp
                                <div class="m-2">
                                    <label for="soal">
                                        <input type="hidden" value="{{ $item->id }}" id="soal" name="soal">
                                        <h5 class="text-justify text-dark">{{ $item->isi }}</h5>
                                    </label>
                                </div>
                                @if ($item->gambar !== null)
                                    <img src="{{ $item->gambar }}" style="width: 150px" class="rounded mb-2 d-block" alt="...">
                                @endif
                                {{-- <?php echo ; ?> --}}
                                <ul class="list-group list-group-flush">
                                    @foreach ($item->jawabans as $jwb)
                                        <li class="list-group-item">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="jawaban" id="jawaban{{ $jwb->id }}{{ $key }}" value="{{ $jwb->id }}" {{ isset($set) ? $jwb->id == $session_jawaban[$set] ? 'checked' : '' : '' }}> 
                                                <label for="jawaban{{ $jwb->id }}{{ $key }}" class="custom-control-label">{{ $jwb->jawaban }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endforeach

                            <div class="mt-5 d-flex flex-row align-items-center justify-content-center">
                                <div class="justify-content-between">
                                    @if ($detail->previousPageUrl() !== null)
                                        <button type="submit" class="btn btn-sm btn-primary" formaction="{{ $detail->previousPageUrl() }}">prev</button>
                                    @endif
                                    @if ($detail->nextPageUrl() !== null)
                                        <button type="submit" class="btn btn-sm btn-primary" formaction="{{ $detail->nextPageUrl() }}">next</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>

    </div>
@endsection

@push('addon-script')
<script src="{{ asset('assets/libraries/time/countdown.js') }}"></script>
@endpush