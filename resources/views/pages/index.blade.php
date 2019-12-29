{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Dashboard')
@section('dashboard-content')
    <div class="container-fluid">
        Dashboard
        <a
            href="{{ route('logout') }}"
            title="Logout"
        >
            Logout
        </a>
        <h1 class="text-light">{{ auth()->user()->name }}</h1>
    </div>
@endsection
