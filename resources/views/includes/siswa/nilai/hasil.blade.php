<h5 class="mx-auto font-weight-bold text-dark">{{ Auth::user()->nama }}</h5><br>
<h5 class="mx-auto text-dark">{{ $soal->judul }}</h5><br>
<h6 class="mx-auto text-dark">Nilai : <span class="font-weight-bold">{{ $nilai->nilai }}</span></h6><br>
<h6 class="mx-auto text-danger font-weight-bold">{{ $nilai->keterangan }}</h6>