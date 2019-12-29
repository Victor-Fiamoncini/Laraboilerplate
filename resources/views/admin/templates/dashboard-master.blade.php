{{-- Parent --}}
@extends('admin.templates.master')

{{-- Content --}}
@section('master')
    <div class="dashboard-wrapper">
        {{-- Sidebar --}}
        @include('admin.includes.sidebar')
        <div class="main-content">
            {{-- Dashboard content --}}
            @yield('dashboard-content')
        </div>
    </div>
@endsection
