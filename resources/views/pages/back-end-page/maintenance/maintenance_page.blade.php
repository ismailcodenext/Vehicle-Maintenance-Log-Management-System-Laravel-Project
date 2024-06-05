@extends('layout.sidenav-layout')
@section('title','maintenance')
@section('content')
    @include('components.back-end.maintenance.maintenance_list')
    @include('components.back-end.maintenance.maintenance_create')
    @include('components.back-end.maintenance.maintenance_update')
    @include('components.back-end.maintenance.maintenance_delete')
@endsection
