<div class="form-group row">
    <div class="col-sm-4 mb-3 mb-sm-0">
        <label for="parent">Mapel</label>
        <select name="parent" id="parent" class="form-control">
            @empty($edit)
                <option value="">Mapel</option>
            @endempty
            @isset($edit)
                <option value="{{ $edit->parent_id }}">{{ $edit->nama }}</option>
                <option value="">-</option>
            @endisset
            @foreach ($mapel as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4 mb-3 mb-sm-0">
        <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control">
            @empty($edit)
                <option value="">Kelas</option>
            @endempty
            @isset($edit)
                <option value="{{ $edit->kelas->id }}">{{ $edit->kelas->kelas }} {{ $edit->kelas->kode_kelas }}</option>
                <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
            <option value="{{ $item->id }}">{{ $item->kelas }} {{ $item->kode_kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-4 mb-3 mb-sm-0">
        <label for="guru">Guru</label>
            <select name="guru" id="guru" class="form-control">
            @empty($edit)
                <option value="">Guru</option>
            @endempty
            @isset($edit)
                <option value="{{ $edit->guru->id }}">{{ $edit->guru->nama }} {{ $edit->guru->guru->pendidikan }}</option>
                <option value="">-</option>
            @endisset
            @foreach ($guru as $item)
            <option value="{{ $item->id }}">{{ $item->nama }} {{ $item->guru->pendidikan }}</option>
            @endforeach
        </select>
    </div>
</div>