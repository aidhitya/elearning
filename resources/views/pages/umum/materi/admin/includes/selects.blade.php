<div class="form-group row">
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="kelas" id="" class="form-control" required>
            @empty($materi)
                <option value="">Kelas</option>
            @endempty
            @isset($materi)
                <option value="{{ $materi->kelas }}">Kelas {{ $materi->kelas }}</option>
                <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
            <option value="{{ $item->kelas }}">Kelas {{ $item->kelas }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="mapel" id="" class="form-control" required>
            @empty($materi)
                <option value="">Mata Pelajaran</option>
            @endempty
            @isset($materi)
                <option value="{{ $materi->mapel_id }}">{{ $materi->mapel->nama }}</option>
                <option value="">-</option>
            @endisset
            @foreach ($mapel as $item)
            <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
</div>