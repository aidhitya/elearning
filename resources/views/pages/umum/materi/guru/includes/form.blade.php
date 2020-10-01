@isset($kelas)
    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
    <input type="hidden" name="mapel" value="{{ $mapel->parent_id }}">
@endisset

<input type="hidden" name="kelas" value="{{ $materi->kelas_spec->id ?? $kelas->kelas }}">
<input type="hidden" name="kode" value="{{ $materi->kelas_spec->kode_kelas ?? $kelas->kode_kelas }}">
<div class="form-group">
    <input type="text" name="judul" class="form-control form-control-user" value="{{ $materi->judul ?? old('judul') }}" placeholder="Judul Materi" required>
</div>
<div class="form-group">
    <input type="text" name="url" class="form-control form-control-user" value="{{ $materi->url ?? old('url') }}" placeholder="URL Materi">
</div>
<div class="form-group">
    <input type="file" name="file" class="form-control mb-2" value="{{ old('file') }}" placeholder="File Materi (pdf)">
   @isset($materi)
        @if (!is_null($materi->file))
            <iframe src="{{ asset('storage/'.$materi->file) }}" width="100%" height="500px"></iframe>
        @endif
   @endisset
</div>
<div class="form-group">
    <input type="text" name="keterangan" class="form-control form-control-user" value="{{ $materi->keterangan ?? old('keterangan') }}" placeholder="Keterangan">
</div>