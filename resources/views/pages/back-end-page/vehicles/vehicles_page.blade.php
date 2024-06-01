@extends('layout.sidenav-layout')
@section('title','Vehicles')
@section('content')
    @include('components.back-end.vehicles.vehicles_list')
    @include('components.back-end.vehicles.vehicles_create')
    @include('components.back-end.vehicles.vehicles_update')
    @include('components.back-end.vehicles.vehicles_delete')
@endsection
