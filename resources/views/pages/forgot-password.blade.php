{{-- Parent --}}
@extends('templates.auth-master')

{{-- Content --}}
@section('title', 'Forgot Password')
@section('auth-content')
    <div class="main-content bg-default h-100">
        {{-- Header --}}
        @AuthHeader
            @slot('title', 'Forgot your Password?')
            @slot('content', 'Use this awesome form to send a new authorization to change your credential.')
        @endAuthHeader
        {{-- Form --}}
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form
                                role="form"
                                action="{{ route('password.reset.mail') }}"
                                method="POST"
                            >
                                @csrf
                                <div
                                    class="
                                        form-group mb-3
                                        {{ $errors->has('email') ? 'placeholder-error ' : '' }}
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
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">
                                        Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="{{ route('login') }}" class="text-light">
                                <small>Sign in</small>
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('register') }}" class="text-light">
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
