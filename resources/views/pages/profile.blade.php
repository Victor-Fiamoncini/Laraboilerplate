{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Profile')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Profile')
    @endDashboardHeader
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center bg-gradient-default">
        <span class="mask opacity-8"></span>
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
                                <img
                                    class="rounded-circle"
                                    src="{{ $user->cover }}"
                                    alt="{{ $user->name }}"
                                    title="{{ $user->name }}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between"></div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>{{ $user->name }}</h3>
                            <div class="h5 font-weight-300">
                                {{ $user->city }}, {{ $user->state }}
                            </div>
                            <div class="h5 mt-4">{{ $user->occupation }}</div>
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
                            action=""
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
                                                value="{{ $user->name ?? old('name') }}"
                                            >
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
                                                value=""
                                            >
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
                                                value=""
                                            >
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
                                </div>
                                <div class="form-group focused">
                                    <label>Description</label>
                                    <textarea
                                        rows="4"
                                        class="form-control form-control-alternative"
                                        placeholder="A brief description about you"
                                        name="description"
                                    >{{ $user->description ?? old('description') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
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
                $.ajax({
                    url: `https://viacep.com.br/ws/${$(this).val()}/json/`,
                    type: 'GET',
                    dataType: 'json',
                    success: response => {
                        if (response.erro) {

                            return
                        }
                        $('input[name="street"]').val(response.logradouro)
                        $('input[name="complement"]').val(response.complemento)
                        $('input[name="neighborhood"]').val(response.bairro)
                        $('input[name="city"]').val(response.localidade)
                        $('input[name="state"]').val(response.uf)
                    }
                })
            })
        })
    </script>
@endsection
