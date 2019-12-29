{{-- Parent --}}
@extends('templates.auth-master')

{{-- Content --}}
@section('title', 'Login')
@section('auth-content')
    <div class="main-content bg-default">
        {{-- Header --}}
        @header
            @slot('title', 'Welcome!')
            @slot('content', 'Use this awesome form to sign in for free.')
        @endheader
        {{-- Form --}}
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3">
                                <small>Sign in with</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a href="#" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon">
                                        <img
                                            src="{{ asset('assets/images/facebook.svg') }}"
                                            alt="Facebook"
                                            title="Facebook"
                                        >
                                    </span>
                                    <span class="btn-inner--text">Facebook</span>
                                </a>
                                <a href="#" class="btn btn-neutral btn-icon">
                                    <span class="btn-inner--icon">
                                        <img
                                            src="{{ asset('assets/images/google.svg') }}"
                                            alt="Google"
                                            title="Google"
                                        >
                                    </span>
                                    <span class="btn-inner--text">Google</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Or sign in with credentials</small>
                            </div>
                            <form
                                role="form"
                                action="{{ route('login.do') }}"
                                method="POST"
                            >
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control"
                                            placeholder="Email"
                                            type="email"
                                            name="email"
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-unlock-alt"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control"
                                            placeholder="Password"
                                            type="password"
                                            name="password"
                                        >
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input
                                        class="custom-control-input"
                                        id="rememberCheck"
                                        type="checkbox"
                                        name="remeber"
                                    >
                                    <label class="custom-control-label" for="rememberCheck">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="#" class="text-light">
                                <small>Forgot password?</small>
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('register') }}" class="text-light">
                                <small>Create new account</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer --}}
        @include('includes.footer')
    </div>
@endsection
