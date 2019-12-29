{{-- Parent --}}
@extends('templates.auth-master')

{{-- Content --}}
@section('title', 'Register')
@section('auth-content')
    <div class="main-content bg-default">
        {{-- Header --}}
        @header
            @slot('title')
                Create a New Account!
            @endslot
            Use this awesome form to create a new account for free.
        @endheader
        {{-- Form --}}
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form
                                role="form"
                                action="{{ route('register.user') }}"
                                method="POST"
                            >
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control"
                                            placeholder="Name"
                                            type="text"
                                            name="name"
                                        >
                                    </div>
                                </div>
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
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-camera"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control"
                                            placeholder="Photo"
                                            type="file"
                                            name="cover"
                                        >
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary my-4">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a
                                href="#"
                                class="text-light"
                            >
                                <small>Forgot password?</small>
                            </a>
                        </div>
                        <div class="col-6 text-right">
                            <a
                                href="{{ route('login') }}"
                                class="text-light"
                            >
                                <small>Sign in</small>
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
