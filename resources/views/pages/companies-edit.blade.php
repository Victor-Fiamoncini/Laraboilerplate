{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Company Edit')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Companies')
        @slot('route', 'dashboard.companies')
    @endDashboardHeader
    <div class="header pb-8 pt-5 pt-lg-8 align-items-center bg-gradient-green">
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
                    <h1 class="text-white display-2">{{ $company->social_name }}</h1>
                    <p class="text-white mt-0 mb-5">
                        This is your company edit page. Here you can manage the data of {{ $company->social_name }} through the available form.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7 bg-light-outer">
        <div class="row">
            <div class="col-12">
                <a
                    class="btn btn-primary mb-3 mt--3"
                    href="{{ route('dashboard.companies') }}"
                    rel="noopener noreferrer"
                >
                    Go back
                </a>
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Update your company</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form
                            name="company-update"
                            role="form"
                            action="{{ route('dashboard.companies.update', $company->id) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PUT')
                            <h6 class="heading-small text-muted mb-4">Basic information</h6>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="social_name">
                                                Social Name
                                            </label>
                                            <input
                                                type="text"
                                                id="social_name"
                                                class="form-control form-control-alternative"
                                                placeholder="Social Name"
                                                name="social_name"
                                                value="{{ old('social_name') ?? $company->social_name }}"
                                            >
                                            @if ($errors->has('social_name'))
                                                <small class="form-text font-weight-bold">
                                                    {{ $errors->first('social_name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="alias_name">
                                                Alias Name
                                            </label>
                                            <input
                                                type="text"
                                                id="alias_name"
                                                class="form-control form-control-alternative"
                                                placeholder="Alias Name"
                                                name="alias_name"
                                                value="{{ old('alias_name') ?? $company->alias_name }}"
                                            >
                                            @if ($errors->has('alias_name'))
                                                <small class="form-text font-weight-bold">
                                                    {{ $errors->first('alias_name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="document_company">
                                                Document
                                            </label>
                                            <input
                                                type="text"
                                                id="document_company"
                                                class="form-control form-control-alternative"
                                                placeholder="Document"
                                                name="document_company"
                                                value="{{ old('document_company') ?? $company->document_company }}"
                                            >
                                            @if ($errors->has('document_company'))
                                                <small class="form-text font-weight-bold">
                                                    {{ $errors->first('document_company') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="document_company_secondary">
                                                Document Secondary
                                            </label>
                                            <input
                                                type="text"
                                                id="document_company_secondary"
                                                class="form-control form-control-alternative"
                                                placeholder="Document Secondary"
                                                name="document_company_secondary"
                                                value="{{ old('document_company_secondary') ?? $company->document_company_secondary }}"
                                            >
                                            @if ($errors->has('document_company_secondary'))
                                                <small class="form-text font-weight-bold">
                                                    {{ $errors->first('document_company_secondary') }}
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
                                                value="{{ old('zipcode') ?? $company->zipcode }}"
                                            >
                                            <small class="form-text font-weight-bold">
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
                                                value="{{ old('street') ?? $company->street }}"
                                            >
                                            @if ($errors->has('street'))
                                                <small class="form-text font-weight-bold">
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
                                                value="{{ old('number') ?? $company->number }}"
                                            >
                                            @if ($errors->has('number'))
                                                <small class="form-text font-weight-bold">
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
                                                value="{{ old('complement') ?? $company->complement }}"
                                            >
                                            @if ($errors->has('complement'))
                                                <small class="form-text font-weight-bold">
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
                                                value="{{ old('neighborhood') ?? $company->neighborhood }}"
                                            >
                                            @if ($errors->has('neighborhood'))
                                                <small class="form-text font-weight-bold">
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
                                                value="{{ old('city') ?? $company->city }}"
                                            >
                                            @if ($errors->has('city'))
                                                <small class="form-text font-weight-bold">
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
                                                value="{{ old('state') ?? $company->state }}"
                                            >
                                            @if ($errors->has('state'))
                                                <small class="form-text font-weight-bold">
                                                    {{ $errors->first('state') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
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
        <hr class="mb-0">
        @include('includes.footer')
    </div>
@endsection
