<form action="{{ route('soal.checking', [strtolower($soal->kategori), Str::slug($soal->mapel->nama), $soal->id]) }}" method="POST" id="formUjian">
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
                    <h5 class="text-justify text-dark">{!! $item->isi !!}</h5>
                </label>
            </div>
            @if ($item->gambar !== null)
            @if (\File::exists('storage/'. $item->gambar))
            <img src="{{ asset('storage/'.$item->gambar) }}" alt="soal" style="width: 250px" class="img-fluid rounded float-right">
            @else
            <img src="{{ url($item->gambar) }}" alt="sda" style="width: 250px" class="img-fluid rounded float-right">
            @endif
            @endif
                    
            <ul class="list-group list-group-flush">
                @foreach ($item->jawabans as $jwb)
                    <li class="list-group-item">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="jawaban" id="jawaban{{ $jwb->id }}{{ $key }}" value="{{ $jwb->id }}" required {{ isset($set) ? $jwb->id == $session_jawaban[$set] ? 'checked' : '' : '' }}> 
                            <label for="jawaban{{ $jwb->id }}{{ $key }}" class="custom-control-label">{{ $jwb->jawaban }}</label>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endforeach

        <div class="d-flex flex-row align-items-center justify-content-center" style="margin-top: 150px;">
            <div class="justify-content-between">
                @if (!\Request::has('checking'))
                    @if ($detail->previousPageUrl() !== null)
                        <button type="submit" class="btn btn-sm btn-primary" formaction="{{ $detail->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></button>
                    @endif
                    @if ($detail->nextPageUrl() !== null)
                        <button type="submit" class="btn btn-sm btn-primary" formaction="{{ $detail->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></button>
                    @endif
                @endif
            </div>
        </div>
        @if ($detail->nextPageUrl() == null || \Request::has('checking'))
            <button type="submit" class="btn btn-sm btn-primary float-right">CHECK</button>
        @endif
    </div>
</form>