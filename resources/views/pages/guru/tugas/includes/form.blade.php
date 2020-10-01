<div class="form-group row">
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="kelas_id" class="form-control" id="kelas" required>
            <option value="{{ $tugas->kelas_id ?? '' }}" selected>{{ $tugas->kelas->kelas ?? '' }}{{ $tugas->kelas->kode_kelas ?? '' }} - {{ $tugas->mapel->nama ?? '' }}</option>
            @isset($tugas)
                <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
                <option value="{{ $item->kelas_id }}">{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }} - {{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <input type="text" name="judul_tugas" class="form-control form-control-user" value="{{ $tugas->judul_tugas ?? old('judul_tugas') }}" placeholder="Judul Tugas" required>
</div>
<div class="form-group">
    <textarea name="deskripsi" cols="30" class="form-control" placeholder="Deskripsi Tugas" required>{{ $tugas->deskripsi ?? old('deskripsi') }}</textarea>
</div>
<div class="form-group">
    <label for="file">File</label>
    <input type="file" id="file" name="file" class="form-control form-control-file">
    @isset($tugas)
        @if ($tugas->file !== null)
            <iframe src="{{ asset('storage/'.$tugas->file) }}" width="100%" height="500px"></iframe>
        @endif
    @endisset
</div>
<div class="form-group">
    <label for="mulai">Mulai</label>
    <input type="datetime-local" id="mulai" name="mulai" class="form-control form-control-user" value="{{ isset($tugas) ? date('Y-m-d\TH:i', strtotime($tugas->mulai)) : old('mulai') }}" placeholder="Mulai" required>
</div>
<div class="form-group">
    <label for="selesai">Selesai</label>
    <input type="datetime-local" id="selesai" name="selesai" class="form-control form-control-user" value="{{ isset($tugas) ? date('Y-m-d\TH:i', strtotime($tugas->selesai)) : old('selesai') }}" placeholder="Selesai" required>
</div>