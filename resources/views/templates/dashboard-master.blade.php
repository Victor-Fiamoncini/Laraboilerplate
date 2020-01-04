{{-- Parent --}}
@extends('templates.master')

{{-- Content --}}
@section('master')
    <div class="dashboard-wrapper">
        {{-- Sidebar --}}
        @include('includes.sidebar')
        <div class="main-content">
            @yield('dashboard-content')
        </div>
    </div>
@endsection
