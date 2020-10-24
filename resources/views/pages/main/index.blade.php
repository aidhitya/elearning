@extends('layouts.app')

@section('title', 'SMPN 4 Pemalang')

@section('content')
    <main>
        <div class="container">
            <section class="section-pengumuman" id="pengumuman">
                <div class="h5 text-center text-primary"><i class="far fa-newspaper"></i><span class="m-1 text-dark">PENGUMUMAN</span></div>
                <div class="row justify-content-center">
                    <div class="col-md-5 m-2 border border-primary rounded-lg">
                        @foreach ($pengumuman as $key => $item)
                            @if ($key < 5)
                                <div class="h6 m-3">
                                    <a href="{{ route('detail.pengumuman', [$item->id, \Str::slug($item->judul)]) }}">{{ $item->judul }}</a> - <span class="font-weight-light">{{ $item->created_at }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if (count($pengumuman) > 4)
                    <div class="col-md-5 m-2 border border-primary rounded-lg">
                        @foreach ($pengumuman as $key => $item)
                            @if ($key > 4)
                                <div class="h6 m-3">
                                    <a href="{{ route('detail.pengumuman', [$item->id, \Str::slug($item->judul)]) }}">{{ $item->judul }}</a> - <span class="font-weight-light">{{ $item->created_at }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="mx-auto text-center m-3">
                    <a href="{{ route('home.pengumuman') }}" class="text-center btn btn-info btn-sm rounded">View All</a>
                </div>
            </section>
        </div>

        <section class="section-panduan" id="panduan">
            <div class="container">
                <div class="h5 text-center">PANDUAN ELEARNING</div>
                <div class="justify-content-center w-50 mx-auto">
                    <a href="#" class="text-decoration-none text-white text-center m-2">
                        <div class="card bg-info">
                            <span class="m-2">Panduan Murid</span>
                        </div>
                    </a>
                    <a href="#" class="text-decoration-none text-white text-center m-2">
                        <div class="card bg-info">
                            <span class="m-2">Panduan Guru</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <div class="container" id="kontak">
            <section class="section-kontak">
                <h5 class="text-center m-3">KONTAK</h5>
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-3 card-header">
                            <div class="mt-5 ml-5">
                                <span class="text-primary"><i class="far fa-map fa-2x mr-2 mb-1"></i></span>
                                <h6 class="overflow-wrap">Jl. Sumbing No.2, Mulyoharjo Kec. Pemalang, Kabupaten Pemalang</h6>
                                    <br>
                                <span class="text-primary"><i class="far fa-envelope fa-2x mr-2 mb-1"></i></span>
                                <h6 class="overflow-wrap">smppml4@gmail.com</h6>
                                    <br>
                                <span class="text-primary"><i class="fas fa-phone-alt fa-2x mr-2 mb-1"></i></span>
                                <h6 class="overflow-wrap">0284 321520</h6>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9491098620138!2d109.38504541414453!3d-6.89669056940591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fdad08f694391%3A0xa3186162fc143b9a!2sSMP%20Negeri%204%20Pemalang!5e0!3m2!1sid!2sid!4v1602945835572!5m2!1sid!2sid" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
@endpush

@push('addon-script')
    <script>
        $(document).ready(function(){
            function remove_hash_from_url() { 
                var uri = window.location.toString(); 
    
                if (uri.indexOf("#") > 0) { 
                    var clean_uri = uri.substring(0, uri.indexOf("#")); 
                    window.history.replaceState({}, document.title, clean_uri); 
                }
            }

            $('nav ul li a').on('click', function(){
                var hash = this.hash;
                if (hash) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function() {
                        window.location.hash = hash;
                        remove_hash_from_url()
                    });
                }
            })
        })
    </script>
@endpush