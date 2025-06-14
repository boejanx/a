{{-- resources/views/layouts/app.blade.php --}}
@extends('adminlte::page')

@section('title', config('app.name'))

@section('content_header')
    <h1>@yield('page-title', 'Dashboard')</h1>
@stop

@section('content')
    @yield('content-main')
@stop

