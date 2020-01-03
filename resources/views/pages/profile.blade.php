{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Profile')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Profile')
    @endDashboardHeader
    <div class="header pb-8 pt-5 pt-lg-8  align-items-center bg-gradient-warning h-25">
        <span class="mask opacity-8"></span>
        <div class="container-fluid">
            {{-- Messages --}}
            @if (session('status') && session('message'))
                @Message
                    @slot('heading', 'h4')
                    @slot('status', session('status'))
                    @slot('message', session('message'))
                @endMessage
            @endif
            @if ($errors->has('cover'))
                @Message
                    @slot('heading', 'h4')
                    @slot('status', 'danger')
                    @slot('message', $errors->first())
                @endMessage
            @endif
        </div>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello {{ $user->name }}</h1>
                    <p class="text-white mt-0 mb-5">
                        This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7 bg-light-outer">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a
                                    href=""
                                    rel="noopener noreferrer"
                                    data-toggle="modal"
                                    data-target="#modal"
                                >
                                    <img
                                        class="rounded-circle"
                                        src="{{ $user->url_cover }}"
                                        alt="{{ $user->name }}"
                                        title="{{ $user->name }}"
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-start">
                            <a
                                href=""
                                role="button"
                                class="btn btn-sm btn-primary"
                                data-toggle="modal"
                                data-target="#modal"
                            >
                                Change
                            </a>
                        </div>
                        @Modal
                            @slot('title', 'Change your photo')
                            @slot('background', 'gradient-primary')
                            @slot('content')
                                <form
                                    role="form"
                                    action="{{ route('dashboard.user.update.photo', $user->id) }}"
                                    method="POST"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group input-group-alternative mb-3">
                                        <input
                                            id="cover"
                                            class="custom-file-input cursor-pointer"
                                            type="file"
                                            name="cover"
                                        >
                                        <label
                                            class="custom-file-label border-0 font-size-17 d-flex align-items-center"
                                            for="cover"
                                        >
                                            <i class="fas fa-camera mr-2 color-gray"></i>
                                            <small class="color-gray">Profile picture</small>
                                        </label>
                                    </div>
                                    <button class="btn btn-default" type="submit">
                                        Update
                                    </button>
                                </form>
                            @endslot
                        @endModal
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-4"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>{{ $user->name }}</h3>
                            <div class="h5 mt-3">
                                @empty(!$user->occupation)
                                    <i class="ni ni-briefcase-24 mr-1"></i>
                                    {{ $user->occupation }}
                                @endempty
                            </div>
                            <div class="h5 font-weight-600">
                                @empty(!$user->age)
                                    {{ $user->age }} years
                                @endempty
                                @empty(!$user->city && !$user->state)
                                    - {{ $user->city }}, {{ $user->state }}
                                @endempty
                            </div>
                            <p>
                                @empty(!$user->description)
                                    <hr>
                                    {{ $user->description }}
                                @endempty
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1 mb-4">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">My account</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form
                            role="form"
                            action="{{ route('dashboard.user.update', $user->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="name">
                                                Username
                                            </label>
                                            <input
                                                type="text"
                                                id="name"
                                                class="form-control form-control-alternative"
                                                placeholder="Username"
                                                name="name"
                                                value="{{ $user->name ?? old('name') }}"
                                            >
                                            @if ($errors->has('name'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">
                                                Email address
                                            </label>
                                            <input
                                                type="text"
                                                id="email"
                                                class="form-control form-control-alternative"
                                                placeholder="Email"
                                                name="email"
                                                value="{{ $user->email ?? old('email') }}"
                                            >
                                            @if ($errors->has('email'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('email') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="password">
                                                Password
                                            </label>
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control form-control-alternative"
                                                placeholder="Password"
                                                name="password"
                                            >
                                            @if ($errors->has('password'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('password') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="password_confirmation">
                                                Password Confirmation
                                            </label>
                                            <input
                                                type="password"
                                                id="password_confirmation"
                                                class="form-control form-control-alternative"
                                                placeholder="Password confirmation"
                                                name="password_confirmation"
                                            >
                                            @if ($errors->has('password_confirmation'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('password_confirmation') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="date_of_birth">
                                                Date of birth
                                            </label>
                                            <input
                                                type="datetime"
                                                id="date_of_birth"
                                                class="form-control form-control-alternative"
                                                placeholder="Date of birth"
                                                name="date_of_birth"
                                                value="{{ $user->date_of_birth ?? old('date_of_birth') }}"
                                            >
                                            @if ($errors->has('date_of_birth'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('date_of_birth') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Address information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="zipcode">
                                                Zipcode
                                            </label>
                                            <input
                                                type="text"
                                                id="zipcode"
                                                class="form-control form-control-alternative"
                                                placeholder="Zipcode"
                                                name="zipcode"
                                                value="{{ $user->zipcode ?? old('zipcode') }}"
                                            >
                                            <small class="form-text text-danger">
                                                @if ($errors->has('zipcode'))
                                                    {{ $errors->first('zipcode') }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="street">
                                                Street
                                            </label>
                                            <input
                                                type="text"
                                                id="street"
                                                class="form-control form-control-alternative"
                                                placeholder="Street"
                                                name="street"
                                                value="{{ $user->street ?? old('street') }}"
                                            >
                                            @if ($errors->has('street'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('street') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="number">
                                                Number
                                            </label>
                                            <input
                                                type="text"
                                                id="number"
                                                class="form-control form-control-alternative"
                                                placeholder="Number"
                                                name="number"
                                                value="{{ $user->number ?? old('number') }}"
                                            >
                                            @if ($errors->has('number'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('number') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="complement">
                                                Complement
                                            </label>
                                            <input
                                                type="text"
                                                id="complement"
                                                class="form-control form-control-alternative"
                                                placeholder="Complement"
                                                name="complement"
                                                value="{{ $user->complement ?? old('complement') }}"
                                            >
                                            @if ($errors->has('complement'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('complement') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="neighborhood">
                                                Neighborhood
                                            </label>
                                            <input
                                                type="text"
                                                id="neighborhood"
                                                class="form-control form-control-alternative"
                                                placeholder="Neighborhood"
                                                name="neighborhood"
                                                value="{{ $user->neighborhood ?? old('neighborhood') }}"
                                            >
                                            @if ($errors->has('neighborhood'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('neighborhood') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="city">
                                                City
                                            </label>
                                            <input
                                                type="text"
                                                id="city"
                                                class="form-control form-control-alternative"
                                                placeholder="City"
                                                name="city"
                                                value="{{ $user->city ?? old('city') }}"
                                            >
                                            @if ($errors->has('city'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('city') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="state">
                                                State
                                            </label>
                                            <input
                                                type="text"
                                                id="state"
                                                class="form-control form-control-alternative"
                                                placeholder="State"
                                                name="state"
                                                value="{{ $user->state ?? old('state') }}"
                                            >
                                            @if ($errors->has('state'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('state') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Contact information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="telephone">
                                                Telephone
                                            </label>
                                            <input
                                                type="tel"
                                                id="telephone"
                                                class="form-control form-control-alternative"
                                                placeholder="Telephone"
                                                name="telephone"
                                                value="{{ $user->telephone ?? old('telephone') }}"
                                            >
                                            @if ($errors->has('telephone'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('telephone') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="cell">
                                                Cellphone
                                            </label>
                                            <input
                                                type="tel"
                                                id="cell"
                                                class="form-control form-control-alternative"
                                                placeholder="Cellphone"
                                                name="cell"
                                                value="{{ $user->cell ?? old('cell') }}"
                                            >
                                            @if ($errors->has('cell'))
                                                <small class="form-text text-danger">
                                                    {{ $errors->first('cell') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div>
                                <div class="form-group focused">
                                    <label class="form-control-label" for="occupation">
                                        Occupation
                                    </label>
                                    <input
                                        type="text"
                                        id="occupation"
                                        class="form-control form-control-alternative"
                                        placeholder="Occupation"
                                        name="occupation"
                                        value="{{ $user->occupation ?? old('occupation') }}"
                                    >
                                    @if ($errors->has('description'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('description') }}
                                        </small>
                                    @endif
                                </div>
                                <div class="form-group focused">
                                    <label>Description</label>
                                    <textarea
                                        rows="4"
                                        class="form-control form-control-alternative"
                                        placeholder="A brief description about you"
                                        name="description"
                                    >{{ $user->description ?? old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <small class="form-text text-danger">
                                            {{ $errors->first('description') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Scripts --}}
@section('scripts')
    <script src="{{ asset('assets/js/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
    <script>
        $(function() {
            /**
             * Form inputs masks
             */
            $('input[name="date_of_birth"]').mask('00/00/0000')
            $('input[name="zipcode"]').mask('00000-000')
            $('input[name="cell"]').mask('(00) 00000-0000')
            $('input[name="telephone"]').mask('0000-0000')

            /**
             * Autocomplete address infos
             */
            $('input[name="zipcode"]').focusout('mouseleave', function() {
                const input = $(this)
                input.siblings('small').hide()

                $.ajax({
                    url: `https://viacep.com.br/ws/${input.val()}/json/`,
                    type: 'GET',
                    dataType: 'json',
                    success: response => {
                        if (response.erro) {
                            input.siblings('small').fadeIn(300).text('Invalid zipcode')
                            return
                        }
                        input.siblings('small').fadeOut(300).text('')
                        $('input[name="street"]').val(response.logradouro)
                        $('input[name="complement"]').val(response.complemento)
                        $('input[name="neighborhood"]').val(response.bairro)
                        $('input[name="city"]').val(response.localidade)
                        $('input[name="state"]').val(response.uf)
                    }
                })
            })

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
