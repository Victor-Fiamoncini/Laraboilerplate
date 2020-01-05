{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Companies')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Companies')
        @slot('route', 'dashboard.companies')
    @endDashboardHeader
    <div class="header pb-8 pt-5 pt-lg-8 align-items-center bg-gradient-info">
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
        </div>
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Companies</h1>
                    <p class="text-white mt-0 mb-5">
                        This is your companies page. Here you can manage the data of your companies as well as your employees through the available form and browsing popups.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7 bg-light-outer">
        <div class="row">
            <div class="col-12">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Your companies</h3>
                            </div>
                            <div class="col text-right">
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    data-toggle="modal"
                                    data-target="#modal-company-create"
                                >
                                    Register a new company

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($companies) !== 0)
                            @forelse ($companies as $company)
                                <div class="card shadow bg-primary">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <strong class="text-white">
                                                    {{ $company->social_name }}
                                                </strong>
                                            </div>
                                            <div class="col-3">
                                                <strong class="text-white">
                                                    {{ $company->document_company }}
                                                </strong>
                                            </div>
                                            <div class="col-2"></div>
                                            <div class="col-2 p-0">
                                                <a
                                                    href="{{ route('dashboard.companies.edit', $company->id) }}"
                                                    class="btn btn-default"
                                                    rel="noopener noreferrer"
                                                >
                                                    <i class="ni ni-settings"></i> Settings
                                                </a>
                                            </div>
                                            <div class="col-2 p-0">
                                                <button
                                                    type="button"
                                                    class="btn btn-default"
                                                    data-toggle="modal"
                                                    data-target="#modal-company-employees"
                                                >
                                                    <i class="fas fa-users"></i> Employees
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>No companies currently registered</h3>
                        @endif
                    </div>
                </div>
                {{-- Modals --}}
                @Modal
                    @slot('name', 'modal-company-create')
                    @slot('title', 'Register a new company')
                    @slot('background', 'gradient-primary')
                    @slot('content')
                        <form
                            name="company-create"
                            role="form"
                            action="{{ route('dashboard.companies.store') }}"
                            method="POST"
                        >
                            @csrf
                            <h6 class="heading-small text-muted mb-4 text-white">Basic information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="social_name">
                                                Social Name
                                            </label>
                                            <input
                                                type="text"
                                                id="social_name"
                                                class="form-control form-control-alternative"
                                                placeholder="Social Name"
                                                name="social_name"
                                                value="{{ old('name') }}"
                                            >
                                            @if ($errors->has('social_name'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('social_name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label text-white" for="alias_name">
                                                Alias Name
                                            </label>
                                            <input
                                                type="text"
                                                id="alias_name"
                                                class="form-control form-control-alternative"
                                                placeholder="Alias Name"
                                                name="alias_name"
                                                value="{{ old('alias_name') }}"
                                            >
                                            @if ($errors->has('alias_name'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('alias_name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="document_company">
                                                Document
                                            </label>
                                            <input
                                                type="text"
                                                id="document_company"
                                                class="form-control form-control-alternative"
                                                placeholder="Document"
                                                name="document_company"
                                            >
                                            @if ($errors->has('document_company'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('document_company') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="document_company_secondary">
                                                Document Secondary
                                            </label>
                                            <input
                                                type="text"
                                                id="document_company_secondary"
                                                class="form-control form-control-alternative"
                                                placeholder="Document Secondary"
                                                name="document_company_secondary"
                                            >
                                            @if ($errors->has('document_company_secondary'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('document_company_secondary') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4 text-white">Address information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="zipcode">
                                                Zipcode
                                            </label>
                                            <input
                                                type="text"
                                                id="zipcode"
                                                class="form-control form-control-alternative"
                                                placeholder="Zipcode"
                                                name="zipcode"
                                                value="{{ old('zipcode') }}"
                                            >
                                            <small class="form-text text-white font-weight-bold">
                                                @if ($errors->has('zipcode'))
                                                    {{ $errors->first('zipcode') }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="street">
                                                Street
                                            </label>
                                            <input
                                                type="text"
                                                id="street"
                                                class="form-control form-control-alternative"
                                                placeholder="Street"
                                                name="street"
                                                value="{{ old('street') }}"
                                            >
                                            @if ($errors->has('street'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('street') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="number">
                                                Number
                                            </label>
                                            <input
                                                type="text"
                                                id="number"
                                                class="form-control form-control-alternative"
                                                placeholder="Number"
                                                name="number"
                                                value="{{ old('number') }}"
                                            >
                                            @if ($errors->has('number'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('number') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="complement">
                                                Complement
                                            </label>
                                            <input
                                                type="text"
                                                id="complement"
                                                class="form-control form-control-alternative"
                                                placeholder="Complement"
                                                name="complement"
                                                value="{{ old('complement') }}"
                                            >
                                            @if ($errors->has('complement'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('complement') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="neighborhood">
                                                Neighborhood
                                            </label>
                                            <input
                                                type="text"
                                                id="neighborhood"
                                                class="form-control form-control-alternative"
                                                placeholder="Neighborhood"
                                                name="neighborhood"
                                                value="{{ old('neighborhood') }}"
                                            >
                                            @if ($errors->has('neighborhood'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('neighborhood') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="city">
                                                City
                                            </label>
                                            <input
                                                type="text"
                                                id="city"
                                                class="form-control form-control-alternative"
                                                placeholder="City"
                                                name="city"
                                                value="{{ old('city') }}"
                                            >
                                            @if ($errors->has('city'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('city') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label text-white" for="state">
                                                State
                                            </label>
                                            <input
                                                type="text"
                                                id="state"
                                                class="form-control form-control-alternative"
                                                placeholder="State"
                                                name="state"
                                                value="{{ old('state') }}"
                                            >
                                            @if ($errors->has('state'))
                                                <small class="form-text text-white font-weight-bold">
                                                    {{ $errors->first('state') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">
                                Register
                            </button>
                        </form>
                    @endslot
                @endModal
            </div>
        </div>
        <hr class="mb-0">
        @include('includes.footer')
    </div>
@endsection

{{-- Scripts --}}
@section('scripts')
    @if ($errors->any())
        <script>
            $('#modal-company-create').modal('show')
        </script>
    @endif
@endsection
