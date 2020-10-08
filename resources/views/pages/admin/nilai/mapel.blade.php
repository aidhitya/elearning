@extends('layouts.admin')

@section('title', 'Dashboard List Mapel')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($mapel->mapels as $item)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <a href="{{ route('nilai.soal',[$mapel->id, $mapel->kelas.'-'.$mapel->kode_kelas, \Str::slug($item->nama), $item->id]) }}" class="text-decoration-none">
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
        </div>
    </div>
@endsection