<div class="form-group">
    <input type="text" name="judul" class="form-control form-control-user" value="{{ $pengumuman->judul ?? old('judul') }}" placeholder="Judul Pengumuman" required>
</div>
@if ($layout == 'guru')
    <div class="form-group border rounded-pill">
        @include('pages.umum.pengumuman.includes.kelas')
    </div>
@endif
<div class="form-group">
    <input type="file" name="gambar" class="form-control" value="{{ old('gambar') }}" placeholder="Gambar">
    @if (isset($pengumuman) && $pengumuman->gambar !== null)
        <img src="{{ asset('storage/'. $pengumuman->gambar) }}" alt="gambar" class="img-fluid img-thumbnail w-75">
    @endif
</div>
<div class="form-group">
    <textarea name="isi" id="summernote" required>{{ $pengumuman->isi ?? old('isi') }}</textarea>
</div>