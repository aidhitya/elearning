<div class="form-group">
    <div class="mb-3 mb-sm-0">
        <select name="guru_id" id="wali_kelas" class="form-control" required>
            <option value="{{ $kelas->wali_kelas ?? '' }}">{{ $kelas->wali_kelas->nama ?? 'Wali Kelas' }}</option>
            @isset($kelas)
                <option value="">-</option>
            @endisset
            @foreach ($guru as $item)
                <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->guru->pendidikan }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" name="kelas" class="form-control form-control-user" placeholder="Kelas" value="{{ $kelas->kelas ?? old('kelas')}}" required>
    </div>
    <div class="col-sm-6 mb-3 mb-sm-0">
        <input type="text" name="kode_kelas" class="form-control form-control-user" placeholder="Kode Kelas" value="{{ $kelas->kode_kelas ?? old('kode_kelas')}}" required>
    </div>
</div>