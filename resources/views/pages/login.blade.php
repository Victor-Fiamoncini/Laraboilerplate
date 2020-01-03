{{-- Parent --}}
@extends('templates.auth-master')

{{-- Content --}}
@section('title', 'Sign in')
@section('auth-content')
    <div class="main-content bg-default h-100">
        {{-- Header --}}
        @AuthHeader
            @slot('title', 'Welcome!')
            @slot('content', 'Use this awesome form to sign in for free.')
        @endAuthHeader
        {{-- Login Form --}}
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    {{-- Messages --}}
                    @Message
                        @slot('heading', 'h4')
                    @endMessage
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-3">
                                <small>Sign in with</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <a
                                    href="{{ route('auth.provider', 'github') }}"
                                    class="btn btn-neutral btn-icon"
                                    rel="noopener noreferrer"
                                >
                                    <span class="btn-inner--icon">
                                        <img
                                            src="{{ asset('assets/images/github.svg') }}"
                                            alt="Github"
                                            title="Github"
                                        >
                                    </span>
                                    <span class="btn-inner--text">Github</span>
                                </a>
                                <a
                                    href="{{ route('auth.provider', 'google') }}"
                                    class="btn btn-neutral btn-icon"
                                    rel="noopener noreferrer"
                                >
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
                                @if ($errors->has('credentials'))
                                    <small class="d-block mt-2 text-danger">
                                        {{ $errors->first('credentials')}}
                                    </small>
                                @endif
                            </div>
                            <form
                                role="form"
                                action="{{ route('login.do') }}"
                                method="POST"
                            >
                                @csrf
                                <div
                                    class="
                                        form-group
                                        {{
                                            $errors->has('email') || $errors->has('credentials')
                                                ? 'placeholder-error '
                                                : ''
                                        }}
                                    "
                                >
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control"
                                            placeholder="Email"
                                            type="text"
                                            name="email"
                                            value="{{ old('email') }}"
                                        >
                                    </div>
                                    @if ($errors->has('email'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('email') }}
                                        </small>
                                    @endif
                                </div>
                                <div
                                    class="
                                        form-group
                                        {{
                                            $errors->has('password') || $errors->has('credentials')
                                                ? 'placeholder-error '
                                                : ''
                                        }}
                                    "
                                >
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
                                            value="{{ old('password') }}"
                                        >
                                    </div>
                                    @if ($errors->has('password'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input
                                        class="custom-control-input"
                                        id="remember_me"
                                        type="checkbox"
                                        name="remeber_me"
                                    >
                                    <label class="custom-control-label" for="remember_me">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a
                                href="{{ route('password.forgot') }}"
                                class="text-light"
                                rel="noopener noreferrer"
                            >
                                <small>Forgot password?</small>
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <a
                                href="{{ route('register') }}"
                                class="text-light"
                                rel="noopener noreferrer"
                            >
                                <small>Sign up</small>
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
