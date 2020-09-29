<h5 class="mx-auto font-weight-bold text-dark">{{ Auth::user()->nama }}</h5><br>
<h6 class="mx-auto text-danger font-weight-bold">SUDAH MENGERJAKAN 2X</h6>
<div class="py-3 d-flex flex-row align-items-center justify-content-center">
    @foreach ($checker as $key => $item)
        <a href="{{ route('get.nilai.pdf', [strtolower($soal->kategori), \Str::slug($soal->mapel->nama), $soal->id, $item->percobaan]) }}" class="m-2 btn btn-sm btn-primary">Nilai {{ $item->percobaan }}</a>
    @endforeach
</div>