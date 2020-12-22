<div class="form-group row">
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="kelas" class="form-control" id="kelas" required>
            <option value="{{ $soal->kelas ?? '' }}" id="zonk">Kelas {{ $soal->kelas ?? '' }}</option>
            @isset($soal)
                <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
                <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3 mb-sm-0" id="materi">
        <select name="mapel_id" class="form-control" id="mapel" required>
            <option value="{{ $soal->mapel_id ?? '' }}" id="zonk">{{ $soal->mapel->nama ?? 'Mata Pelajaran' }}</option>
            @isset($soal)
                <option value="">-</option>
            @endisset
            @foreach ($mapel as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label for="kategori">Kategori Ujian</label>
    <select name="kategori" id="kategori" class="form-control" required>
        <option value="{{ $soal->kategori ?? '' }}">{{ $soal->kategori ?? 'Kategori Soal' }}</option>
        @isset($kategori)
            <option value="0">-</option>
        @endisset
        <option value="UTS">UTS</option>
        <option value="UAS">UAS</option>
    </select>
</div>