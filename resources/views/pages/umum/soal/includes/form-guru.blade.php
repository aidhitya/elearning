<div class="form-group">
    <select name="kategori" class="form-control" required>
        <option value="{{ $soal->kategori ?? '' }}">{{ $soal->kategori ?? 'Kategori Soal' }}</option>
        @isset($soal)
            <option value="">-</option>
        @endisset
        <option value="Harian">Harian</option>
        <option value="Quiz">Quiz</option>
    </select>
</div>
<div class="form-group row">
    <div class="col-md-6 mb-3 mb-sm-0">
        <select name="kelas_materi" class="form-control" id="kelas" required>
            <option value="{{ $soal->kelas_id ?? '0' }}" id="zonk">Kelas {{ $soal->speckelas->kelas ?? '' }}  {{ $soal->speckelas->kode_kelas ?? '' }} - {{ $soal->mapel->nama ?? '' }}</option>
            @isset($soal)
                <option value="">-</option>
            @endisset
            @foreach ($kelas as $item)
                <option value="{{ $item->kelas_id }}-{{ $item->parent_id }}">{{ $item->kelas->kelas }} {{ $item->kelas->kode_kelas }} - {{ $item->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3 mb-sm-0" id="materi">
        @include('pages.umum.soal.includes.ajax-materi')
    </div>
</div>

@push('addon-script')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#kelas', function(){
                $('#zonk').hide();
                var kelas = $(this).val();
                console.log(kelas);
                $.ajax({
                    url:`{{ route('post.materi.soal') }}`,
                    type: 'POST',
                    data: {
                        kelas_materi: kelas,
                        _token: '{{ csrf_token() }}'
                    },
                    success:function(data)
                    {$('#materi').html(data)}
                });
            })
        })
    </script>
@endpush