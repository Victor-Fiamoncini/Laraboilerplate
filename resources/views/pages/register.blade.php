{{-- Parent --}}
@extends('templates.auth-master')

{{-- Content --}}
@section('title', 'Sign up')
@section('auth-content')
    <div class="main-content bg-default h-100">
        {{-- Header --}}
        @AuthHeader
            @slot('title', 'Create a New Account!')
            @slot('content', 'Use this awesome form to create a new account for free.')
        @endAuthHeader
        {{-- Form --}}
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form
                                role="form"
                                action="{{ route('register.user') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf
                                <div
                                    class="
                                        form-group mb-3
                                        {{ $errors->has('name') ? 'placeholder-error ' : '' }}
                                    "
                                >
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
                                            value="{{ old('name') }}"
                                        >
                                    </div>
                                    @if ($errors->has('name'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('name') }}
                                        </small>
                                    @endif
                                </div>
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
                                <div class="input-group input-group-alternative mb-3">
                                    <input
                                        id="cover"
                                        class="custom-file-input cursor-pointer"
                                        type="file"
                                        name="cover"
                                    >
                                    <label
                                        class="custom-file-label border-0 font-size-17"
                                        for="cover"
                                    >
                                        <i class="fas fa-camera mr-1 color-gray"></i>
                                        <small class="color-gray">Profile picture</small>
                                    </label>
                                </div>
                                <div
                                    class="
                                        form-group mb-3
                                        {{ $errors->has('password') ? 'placeholder-error ' : '' }}
                                    "
                                >
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-unlock-alt"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control display-5"
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
                                <div
                                    class="
                                        form-group mb-3
                                        {{ $errors->has('password') ? 'placeholder-error ' : '' }}
                                    "
                                >
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-unlock-alt"></i>
                                            </span>
                                        </div>
                                        <input
                                            class="form-control display-5"
                                            placeholder="Password Confirmation"
                                            type="password"
                                            name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                        >
                                    </div>
                                    @if ($errors->has('password'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('password') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="text-muted font-italic password-strength">
                                    <small>
                                        password strength:
                                        <span class=" font-weight-700"></span>
                                    </small>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">
                                        Sign up
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
                                href="{{ route('login') }}"
                                class="text-light"
                                rel="noopener noreferrer"
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

{{-- Scripts --}}
@section('scripts')
    <script>
        $(function() {
            /**
             * Input file style
             */
            $('input[type="file"]').change(function() {
                $(this)
                    .siblings('.custom-file-label')
                    .addClass('selected')
                    .find('small')
                    .text('File selected')
                    .addClass('text-success')
                    .siblings('i')
                    .addClass('color-success')
            })
        })
    </script>
@endsection
