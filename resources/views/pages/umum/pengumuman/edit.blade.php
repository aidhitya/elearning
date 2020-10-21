@extends('layouts.' . $layout)

@section('title', 'Edit Pengumuman')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-11 col-lg-10">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pengumuman {{ $pengumuman->judul }}</h6>
          </div>
          <div class="card-body">
            <form class="user pt-2" method="POST" action="{{ route('pengumuman.update', $pengumuman->id) }}" enctype="multipart/form-data">
              @csrf @method('PUT')
              @include('pages.umum.pengumuman.includes.form')
              
              <div class="form-group row">
                <div class="col-md-8"></div>
                <div class="col-md-4 mb-sm-0">
                  <button type="submit" class="btn btn-primary btn-user btn-block">Update Pengumuman</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('addon-style')
  <link rel="stylesheet" href="{{ asset('assets/libraries/summernote/summernote.bs4.css ') }}">
@endpush

@push('addon-script')
  <script src="{{ asset('assets/libraries/summernote/summernote.bs4.js') }}"></script>
  <script>
    $(document).ready(function(){
      $('#summernote').summernote({
          placeholder: 'Isi Pengumuman....',
          height: 200,
          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['fontname', ['fontname', 'fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['view', ['fullscreen']],
          ]
      });
    })
  </script>
@endpush