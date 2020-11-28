@extends('layouts.app')

@section('title', 'VERIFY')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <h6 class="text-white">{{ __('Verifikasi Email Kamu') }}</h6>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Sebelum Melanjutkan, Check Email Verifikasi Kamu.') }}
                    {{ __('Jika Kamu Tidak Menerima Email Verifikasi') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik Untuk Mendapatkannya') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
@endpush
