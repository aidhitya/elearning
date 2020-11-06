@foreach ($list->mapels as $item)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2 border-success">
            @include('pages.siswa.includes.route', ['route' => route('murid.mapel', strtolower(\Str::slug($secroute ?? $item->nama)))])
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-info text-uppercase mb-1">
                                <h6 class="font-weight-bold">{{ $item->nama }}</h6>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto w-100">
                                    <p class="m-0 font-weight-bold text-dark">{{ $item->guru->nama }} {{ $item->guru->guru->pendidikan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach