@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('pages.siswa.includes.list.list-soal')
        </div>
    </div>
@endsection