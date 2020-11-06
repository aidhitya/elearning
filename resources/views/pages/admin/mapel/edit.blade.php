@extends('layouts.admin')

@section('title', 'Admin - Tambah Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="card shadow mb-4 border-info">
                    <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-white">Edit Mapel</h6>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if ($edit->parent_id == null)
                                <li class="nav-item">
                                    <a class="nav-link active" id="new-mapel" data-toggle="tab" href="#mapel" role="tab" aria-controls="mapel" aria-selected="true">Mapel Baru</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active" id="mapel-kelas" data-toggle="tab" href="#mapelkelas" role="tab" aria-controls="mapelkelas" aria-selected="false">Mapel - Kelas</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @if ($edit->parent_id == null)

                                <div class="tab-pane fade show active" id="mapel" role="tabpanel" aria-labelledby="new-mapel">
                                    <form class="user pt-2" method="POST" action="{{ route('mapel.update', $edit->id) }}">
                                        @csrf @method('PUT')
                                        @include('pages.admin.mapel.includes.input-parent')
                                        <div class="form-group row">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-4 mb-sm-0">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">Update Mapel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            @else

                                <div class="tab-pane fade show active" id="mapelkelas" role="tabpanel" aria-labelledby="mapel-kelas">
                                    <form class="user pt-2" method="POST" action="{{ route('mapel.update', $edit->id) }}">
                                        @csrf @method('PUT')
                                        @include('pages.admin.mapel.includes.selects')
                                        <div class="form-group row">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-4 mb-sm-0">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">Update Mapel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection