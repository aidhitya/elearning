@foreach ($kelas as $item)
    <div class="form-check form-check-inline m-3">
        <input class="form-check-input" name="kelas[]" type="checkbox" id="kelas{{ $item->kelas->id }}" value="{{ $item->kelas->id }}" required
        @isset($pengumuman)
            @foreach ($pengumuman->kelas as $k) 
                {{ $k->id == $item->kelas->id ? 'checked' : '' }}
            @endforeach
        @endisset
        >
        <label class="form-check-label" for="kelas{{ $item->kelas->id }}">Kelas {{ $item->kelas->kelas }}{{ $item->kelas->kode_kelas }}</label>
    </div>
@endforeach