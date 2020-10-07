@foreach ($list->mapels as $item)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            @include('pages.siswa.includes.route', ['route' => route('detail.soal', [$item->id, strtolower(\Str::slug($secroute ?? $item->nama))])])
                <div class="card-body" style="margin: -10px; padding: -10px">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <span class="badge badge-warning float-right">{{ $item->soal_sudah }}/{{ ($item->soal_sudah + $item->soal_belum) }} Soal</span>
                            <div class="text-info text-uppercase mb-1">
                                <h6 class="font-weight-bold">{{ $item->nama }}</h6>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto w-100">
                                    <p class="m-0 font-weight-bold text-dark">{{ $item->guru->nama }} {{ $item->guru->guru->pendidikan }}</p>
                                </div>
                            </div>
                            <div class="justify-content-between">
                                @php
                                    $prog = $item->soal_sudah + $item->soal_belum;
                                    $hasil = $prog == 0 ? '0' : $item->soal_sudah/$prog * 100;
                                @endphp
                                <div class="h5 font-weight-bold text-gray-800 float-right" style="margin-top: -7px;">{{ is_float($hasil) ? number_format($hasil, 1) : $hasil }}%</div>
                                <div class="progress progress-sm mt-1" style="width: 80%">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $hasil }}%" aria-valuenow="{{ $hasil }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach