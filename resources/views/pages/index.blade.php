{{-- Parent --}}
@extends('templates.dashboard-master')

{{-- Content --}}
@section('title', 'Dashboard')
@section('dashboard-content')
    {{-- Header --}}
    @DashboardHeader
        @slot('title', 'Dashboard')
    @endDashboardHeader
    <div class="container-fluid">

    </div>
@endsection
