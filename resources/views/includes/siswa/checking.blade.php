<form action="{{ route('soal.selesai', $soal->id) }}" method="POST" id="formUjian">
    @csrf
    <div class="form-group">
        <input type="hidden" name="mulai" id="waktu" value="{{ $soal->selesai }}">
        <input type="hidden" name="soal" value="{{ $soal->id }}">
        <ul class="list-group list-group-flush">
            @foreach ($detail as $key => $item)
                <li class="list-group-item">
                    <div class="m-2">
                        <label for="soal">
                            <input type="hidden" value="{{ $item->id }}" id="soal" name="soal[]" required>
                            <h5 class="text-justify text-dark font-weight-bold">{{ $item->isi }}</h5>
                        </label>
                        @foreach ($item->jawabans as $jwb)
                            <div class="ml-3">
                                <label for="jawaban">
                                    <input type="hidden" name="jawaban[]" id="jawaban" value="{{ $jwb->id }}" required>
                                    <div class="bg-light">
                                        <h6 class="text-justify text-dark m-2">{{ $jwb->jawaban }}</h6>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('murid.soal', [strtolower($soal->kategori), \Str::slug($soal->mapel->nama), $soal->id, 'page' => $key+1, 'checking']) }}" class="btn btn-sm btn-info float-right">EDIT</a>
                </li>
            @endforeach
        </ul>

        <div class="mt-5 d-flex flex-row align-items-center justify-content-center">
            <div class="justify-content-between">
               <button type="submit" class="btn btn-sm btn-primary">SUBMIT</button>
            </div>
        </div>
    </div>
</form>