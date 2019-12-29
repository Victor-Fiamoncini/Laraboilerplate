{{-- Parent --}}
@extends('templates.master')

{{-- Content --}}
@section('master')
    <div class="dashboard-wrapper">
        {{-- Sidebar --}}
        @include('includes.sidebar')
        {{-- Dashboard content --}}
        <div class="main-content">
            @yield('dashboard-content')
        </div>
    </div>
@endsection
