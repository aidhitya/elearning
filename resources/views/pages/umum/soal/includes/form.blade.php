<div class="form-group">
    <input type="text" name="judul" class="form-control form-control-user" value="{{ $soal->judul ?? old('judul') }}" placeholder="Judul" required>
</div>
@if ($layout == 'guru')
    @include('pages.umum.soal.includes.form-guru')
@else
    @include('pages.umum.soal.includes.form-admin')
@endif
<div class="form-group">
    <label for="mulai">Mulai Ujian</label>
    <input type="datetime-local" id="mulai" name="mulai" class="form-control form-control-user" value="{{ isset($soal) ? date('Y-m-d\TH:i', strtotime($soal->mulai)) : old('mulai') }}" placeholder="Mulai Ujian" required>
</div>
<div class="form-group">
    <label for="selesai">Selesai Ujian</label>
    <input type="datetime-local" id="selesai" name="selesai" class="form-control form-control-user" value="{{ isset($soal) ? date('Y-m-d\TH:i', strtotime($soal->selesai)) : old('selesai') }}" placeholder="Selesai Ujian" required>
</div>