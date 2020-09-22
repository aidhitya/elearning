@extends('layouts.' . $layout)

@section('title', 'Dashboard Soal - Tambah Soal')

@section('content')
    <div class="container-fluid">

          <!-- Content Row -->

          <div class="row">

            <!-- Index Siswa -->
            <div class="col-xl-9 col-lg-8">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Edit Soal</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                   @if (session('berhasil'))
                      <div class="alert alert-success">
                          {{ session('berhasil') }}
                      </div>
                  @endif
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                <form class="user" action="{{ route('soal.update', $soal->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="form-group">
                    <input type="text" name="judul" class="form-control form-control-user" value="{{ $soal->judul }}" placeholder="Judul" required>
                    </div>
                    @if ($layout == 'admin')
                       <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-sm-0">
                                <select name="kelas" class="form-control" id="kelas" required>
                                    <option value="{{ $soal->kelas }}">Kelas {{ $soal->kelas }}</option>
                                    <option value="">-</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 mb-sm-0" id="materi">
                                <select name="mapel_id" class="form-control" id="mapel" required>
                                    <option value="{{ $soal->mapel_id }}">{{ $soal->mapel->nama }}</option>
                                    <option value="">-</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @if ($layout == 'guru')
                        <div class="form-group">
                            <select name="kategori" class="form-control" required>
                                <option value="{{ $soal->kategori }}">{{ $soal->kategori }}</option>
                                <option value="">-</option>
                                <option value="Harian">Harian</option>
                                <option value="Quiz">Quiz</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3 mb-sm-0">
                                <select name="kelas_id" class="form-control" id="kelas" required>
                                    <option value="{{ $soal->kelas_id }}">Kelas {{ $soal->speckelas->kelas }}  {{ $soal->speckelas->kode_kelas }} - {{ $soal->mapel->nama }}</option>
                                    <option value="">-</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->kelas_id }}">{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 mb-sm-0" id="materi">
                                @include('pages.umum.soal.edit-materi')
                            </div>
                        </div>
                    @endif
                    @if ($layout == 'admin')
                        <div class="form-group">
                             <label for="kategori">Kategori Ujian</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="{{ $soal->kategori }}">{{ $soal->kategori }}</option>
                                <option value="0">-</option>
                                <option value="Harian">Harian</option>
                                <option value="UTS">UTS</option>
                                <option value="UAS">UAS</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="mulai">Mulai Ujian</label>
                        <input type="datetime-local" id="mulai" name="mulai" class="form-control form-control-user" value="{{ date('Y-m-d\TH:i', strtotime($soal->mulai)) }}" placeholder="Mulai Ujian" required>
                    </div>
                    <div class="form-group">
                        <label for="selesai">Selesai Ujian</label>
                        <input type="datetime-local" id="selesai" name="selesai" class="form-control form-control-user" value="{{ date('Y-m-d\TH:i', strtotime($soal->selesai)) }}" placeholder="Selesai Ujian" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Edit Soal</button>
                </form>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            {{-- <div class="col-xl-3 col-lg-4">
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

@push('addon-script')
    @if ($layout == 'guru')
        <script>
            $(document).ready(function(){
                $(document).on('change', '#kelas', function(){
                    $('#zonk').hide();
                    var kelas = $(this).val();
                    $.ajax({
                        url:`{{ route('post.edit.soal', $soal->id) }}`,
                        type: 'POST',
                        data: {
                            kelas_id: kelas,
                            _token: '{{ csrf_token() }}'
                        },
                        success:function(data)
                        {$('#materi').html(data)}
                    });
                })
            })
        
        </script>
    @else
        {{-- <script>
            $(document).ready(function(){
                $(document).on('change', '#kelas', function(){
                    $('#zonk').hide();
                    var kelas = $(this).val();
                    $.ajax({
                        url:`{{ route('post.materi.soal') }}`,
                        type: 'POST',
                        data: {
                            kelas_id: kelas,
                            _token: '{{ csrf_token() }}'
                        },
                        success:function(data)
                        {$('#materi').html(data)}
                    });
                })
            })
        
        </script> --}}
    @endif
@endpush