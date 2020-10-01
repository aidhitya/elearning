<select name="materi_id" class="form-control" required>
    <option value="{{ $soal->materi_id ?? '' }}">{{ $soal->materi->judul ?? 'Materi' }}</option>
    @isset($soal)
        <option value="" id="zonk">-</option>
    @endisset
    @foreach ($materi as $item)
        <option value="{{ $item->id }}">{{ $item->judul }} (@if ($item->guru_id == Auth::id()) {{ 'tambahan' }} @else{{ $item->pertemuan }}@endif)</option>
    @endforeach
</select>