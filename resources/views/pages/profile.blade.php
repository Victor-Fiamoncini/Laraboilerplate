{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Profile')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Profile')
        @slot('route', 'dashboard.profile')
    @endDashboardHeader
    <div class="header pb-9 pt-5 pt-lg-8 align-items-center bg-gradient-primary">
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
                    <h1 class="display-2 text-white">Hello {{ Auth::user()->name }}</h1>
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
                                    data-target="#modal-profile-photo"
                                >
                                    <img
                                        class="rounded-circle shadow"
                                        src="{{ Auth::user()->url_cover }}"
                                        alt="{{ Auth::user()->name }}"
                                        title="{{ Auth::user()->name }}"
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-start">
                            <a
                                href=""
                                rel="noopener noreferrer"
                                role="button"
                                class="btn btn-sm btn-primary"
                                data-toggle="modal"
                                data-target="#modal-profile-photo"
                            >
                                Change
                            </a>
                        </div>
                        {{-- Modal photo form --}}
                        @Modal
                            @slot('name', 'modal-profile-photo')
                            @slot('title', 'Change your photo')
                            @slot('background', 'gradient-primary')
                            @slot('content')
                                <form
                                    class="text-center"
                                    role="form"
                                    action="{{ route('dashboard.user.update.photo') }}"
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
                            <h3>{{ Auth::user()->name }}</h3>
                            <div class="h5 mt-3">
                                @empty(!Auth::user()->occupation)
                                    <i class="ni ni-briefcase-24 mr-1"></i>
                                    {{ Auth::user()->occupation }}
                                @endempty
                            </div>
                            <div class="h5 font-weight-600">
                                @empty(!Auth::user()->age)
                                    {{ Auth::user()->age }} years
                                @endempty
                                @empty(!Auth::user()->city && !Auth::user()->state)
                                    - {{ Auth::user()->city }}, {{ Auth::user()->state }}
                                @endempty
                            </div>
                            <p>
                                @empty(!Auth::user()->description)
                                    <hr>
                                    {{ Auth::user()->description }}
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
                            action="{{ route('dashboard.user.update') }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')
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
                                                value="{{ Auth::user()->name ?? old('name') }}"
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
                                                value="{{ Auth::user()->email ?? old('email') }}"
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
                                                value="{{ Auth::user()->date_of_birth ?? old('date_of_birth') }}"
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
                                                value="{{ Auth::user()->zipcode ?? old('zipcode') }}"
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
                                                value="{{ Auth::user()->street ?? old('street') }}"
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
                                                value="{{ Auth::user()->number ?? old('number') }}"
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
                                                value="{{ Auth::user()->complement ?? old('complement') }}"
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
                                                value="{{ Auth::user()->neighborhood ?? old('neighborhood') }}"
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
                                                value="{{ Auth::user()->city ?? old('city') }}"
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
                                                value="{{ Auth::user()->state ?? old('state') }}"
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
                                                value="{{ Auth::user()->telephone ?? old('telephone') }}"
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
                                                value="{{ Auth::user()->cell ?? old('cell') }}"
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
                                        value="{{ Auth::user()->occupation ?? old('occupation') }}"
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
                                    >{{ Auth::user()->description ?? old('description') }}</textarea>
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
        <hr class="mb-0">
        @include('includes.footer')
    </div>
@endsection
