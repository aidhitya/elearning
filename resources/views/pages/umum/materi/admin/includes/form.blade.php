<div class="form-group row">
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="kelas" id="" class="form-control" required>
            <option value="{{ $materi->kelas ?? '' }}">Kelas {{ $materi->kelas ?? '' }}</option>
            @isset($materi)
            <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
            <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="mapel" id="" class="form-control" required>
            <option value="{{ $materi->mapel_id ?? ''}}">{{ $materi->mapel->nama ?? 'Mata Pelajaran' }}</option>
            @isset($materi)
                <option value="">-</option>
            @endisset
            @foreach ($mapel as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <input type="text" name="judul" class="form-control form-control-user" value="{{ $materi->judul ?? old('judul') }}" placeholder="Judul Materi" required>
</div>
<div class="form-group">
    <input type="file" name="file" class="form-control" value="{{ old('file') }}" placeholder="File Materi (pdf)">
    @isset($materi)
        <iframe src="{{ asset('storage/'.$materi->file) }}" width="100%" height="500px"></iframe>
    @endisset
</div>
<div class="form-group">
    <input type="number" min="0" name="pertemuan" class="form-control form-control-user" value="{{ $materi->pertemuan ?? old('pertemuan') }}" placeholder="Pertemuan">
</div>
<div class="form-group">
    <input type="text" name="keterangan" class="form-control form-control-user" value="{{ $materi->keterangan ?? old('keterangan') }}" placeholder="Keterangan">
</div>