@extends('layouts.app')

@section('title', 'LOGIN')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 col-md-12">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post" class="mt-5">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>

                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    type="text" 
                                    name="email"
                                    placeholder="Email/Nomor Induk" 
                                    value="{{ old('email') }}" 
                                    autofocus 
                                    required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    type="password" 
                                    name="password"
                                    placeholder="Password" 
                                    required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row">
                                @if (session('error'))
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                </div>
                                @endif

                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label ml-0" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link px-0 mt-2" href="{{ route('password.request') }}">
                                            Lupa Password?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card text-white bg-gradient-light py-5">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/images/login.png') }}" alt="login" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
@endpush
