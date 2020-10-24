@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
    <main>
        <div class="container">
            <section class="section-pengumuman">
                <div class="h5 text-center text-primary"><i class="far fa-newspaper"></i><span class="m-1 text-dark">PENGUMUMAN</span></div>
                <div class="row justify-content-center">
                    <div class="col-md-10 m-2 border border-primary rounded-lg">
                        @if (\Route::currentRouteName() == 'home.pengumuman')
                            @foreach ($pengumuman as $item)
                                <div class="h6 m-3">
                                    <a href="{{ route('detail.pengumuman', [$item->id, \Str::slug($item->judul)]) }}">{{ $item->judul }}</a> - <span class="font-weight-light">{{ $item->created_at }}</span>
                                </div>
                            @endforeach
                        @else
                        <h3 class="m-3 text-center font-weight-bold text-uppercase text-primary">{{ $pengumuman->judul }}</h3>
                        <small>{{ $pengumuman->created_at }}</small>
                        <br>
                        <div class="card m-2">
                            <div class="m-3">
                                @if ($pengumuman->gambar !== null)
                                    <div class="text-center">
                                        <img src="{{ asset('storage/'.$pengumuman->gambar) }}" alt="pengumuman" class="img-fluid rounded">
                                    </div>
                                @endif
                                {!! $pengumuman->isi !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection