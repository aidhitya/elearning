<div class="mb-3 mb-sm-0">
    <select name="guru_id" id="wali_kelas" class="form-control">
        @empty($kelas)
            <option value="">Wali Kelas</option>
        @endempty
        @isset($kelas)
            <option value="{{ $kelas->wali_kelas }}">{{ $kelas->wali_kelas->nama }}</option>
        @endisset
        @foreach ($guru as $item)
        <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->guru->pendidikan }}</option>
        @endforeach
    </select>
</div>