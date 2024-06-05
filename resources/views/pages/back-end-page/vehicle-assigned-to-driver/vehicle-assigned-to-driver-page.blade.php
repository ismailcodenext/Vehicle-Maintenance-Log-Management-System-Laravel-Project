@extends('layout.sidenav-layout')
@section('title', 'Dashboard')
@section('content')
    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-list')
    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-create')
    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-view')
    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-update')
    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-delete')
    {{--    @include('components.back-end.vehicle-assigned-to-driver.vehicle-assigned-to-driver-create') --}}
@endsection
