@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.driver.driver-list')
    @include('components.back-end.driver.driver-create')
    @include('components.back-end.driver.driver-view')
    @include('components.back-end.driver.driver-update')
    @include('components.back-end.driver.driver-delete')
    {{--    @include('components.back-end.driver.driver-create') --}}
@endsection
